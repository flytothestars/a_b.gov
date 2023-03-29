<?php

namespace App\Http\Controllers\Api\IEManager;

use App\Exports\LoansExport2;
use App\Http\Controllers\Controller;
use App\Http\Requests\AppealEditCategoryRequest;
use App\Http\Requests\AppealRequest;
use App\Http\Requests\AssignCoExecutorRequest;
use App\Http\Requests\AssignCuratorRequest;
use App\Http\Requests\AssignExecutorRequest;
use App\Http\Requests\AttachAppealDocumentRequest;
use App\Http\Requests\CompleteAppealRequest;
use App\Http\Requests\ReAssignAppealDistributor;
use App\Http\Requests\RejectAppealRequest;
use App\Http\Resources\AppealResource;
use App\Http\Resources\AppealShortResource;
use App\Models\Appeal;
use App\Repositories\IAppealForDistributorRepository;
use App\Repositories\IAppealForHeadRepository;
use App\Repositories\IAppealForIEManagerRepository;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use App\Exports\LoansExport;
use App\Exports\AppealsExport;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class IEApplicationsController extends Controller
{
    private $repository;

    public function __construct(IAppealForIEManagerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(AppealRequest $request): JsonResource
    {
        return AppealShortResource::collection($this->repository
            ->allByFilter($request->validated()));
    }

    
    public function access(Request $request, $id) : JsonResource
    {
        return new AppealResource($this->repository
           ->ieAccessAppeals($request, $id));
    }
    
    public function reject(Request $request, $id) : JsonResource
    {
        return new AppealResource($this->repository
           ->ieRejectAppeals($request, $id));
    }

    public function indexByAuthUser(AppealRequest $request)
    {

        return AppealShortResource::collection($this->repository
            ->findAppealsByAuthUser($request->validated()));
    }

    public function exportToExcel(AppealRequest $request)
    {
        ini_set('memory_limit', '-1');
        return Excel::download(new LoansExport(), 'userAppeals.xlsx',\Maatwebsite\Excel\Excel::XLSX);

        //return Excel::download(new AppealsExport($this->repository->allByFilterForExport(Arr::except($request->validated(), ['per_page'])), $request->validated()), 'allAppeals.xlsx');
    }

    public function exportToExcel2(AppealRequest $request)
    {
        ini_set('memory_limit', '-1');
        return Excel::download(new LoansExport2($request->validated()), 'userAppeals.xlsx',\Maatwebsite\Excel\Excel::XLSX);

        //return Excel::download(new AppealsExport($this->repository->allByFilterForExport(Arr::except($request->validated(), ['per_page'])), $request->validated()), 'allAppeals.xlsx');
    }

    public function exportToExcelByAuthUser(AppealRequest $request)
    {
        ini_set('memory_limit', '-1');
        return Excel::download(new AppealsExport($this->repository->findAppealsByAuthUser(Arr::except($request->validated(), ['per_page'])), $request->validated()), 'userAppeals.xlsx');
    }

    public function show(Appeal $appeal) : JsonResource
    {
        return new AppealResource($this->repository
            ->find($appeal->id));
    }

    public function reassignDistributor($id, ReAssignAppealDistributor $request) : JsonResource
    {

        $attributes = $request->validated();

        $this->repository->update($id, $attributes);
        return new AppealResource($this->repository->find($id));
    }

    public function reassignDistributorMultiple(ReAssignAppealDistributor $request) : \Illuminate\Http\JsonResponse
    {
        $ids = $request->input('id');
        $attributes = $request->except('id');

        foreach($ids as $id) {
            $this->repository->update($id, $attributes);
        }

        return response()->json(null, 200);
    }
}
