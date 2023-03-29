<?php

namespace App\Http\Controllers\API\Distributor;

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
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Exports\TransactionsExport;
use App\Exports\AppealsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LoansExport;
use Illuminate\Support\Facades\Storage;


class AppealController extends Controller
{
    private $repository;

    public function __construct(IAppealForDistributorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(AppealRequest $request): JsonResource
    {

        return AppealShortResource::collection($this->repository
            ->allByFilter($request->validated()));
    }

    public function indexByAuthUser(AppealRequest $request)
    {

        return AppealShortResource::collection($this->repository
            ->findAppealsByAuthUser($request->validated()));
    }

    public function exportToExcel(AppealRequest $request)
    {
        ini_set('memory_limit', '-1');
        // Local 
        //$allExportsLoans = Storage::disk('local')->files('export');
        //$lastExportsLoans = $allExportsLoans[array_key_last($allExportsLoans)] ?? null;

        // Local all data table
        //return Storage::download($lastExportsLoans, basename($lastExportsLoans));
        //$fileName = 'admin-loans-'.date('Y-m-d').'.xlsx';

        return Excel::download(new LoansExport($request), 'userAppeals.xlsx',\Maatwebsite\Excel\Excel::XLSX);
        //return Excel::download(new TransactionsExport($this->repository->allByFilterForExport(Arr::except($request->validated(), ['per_page'])), $request->validated()), 'allAppeals.xlsx');
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

    public function getToWork($id) : JsonResource
    {
        return new AppealResource($this->repository
            ->getToWork($id));
    }

    public function backToWork($id) : JsonResource
    {
        return new AppealResource($this->repository
            ->backToWork($id));
    }

    public function assignExecutor($id, AssignExecutorRequest $request) : JsonResource
    {
        return new AppealResource($this->repository
            ->assignExecutor($id, $request->validated()));
    }

    public function assignCoExecutor($id, AssignCoExecutorRequest $request) : JsonResource
    {
        return new AppealResource($this->repository
            ->assignCoExecutor($id, $request->validated()));
    }

    public function complete($id, CompleteAppealRequest $request) : JsonResource
    {
        return new AppealResource($this->repository
            ->complete($id, $request->validated()));
    }

    public function reject($id, RejectAppealRequest $request) : JsonResource
    {
        return new AppealResource($this->repository
            ->reject($id, $request->validated()));
    }

    public function update(AppealRequest $request, Appeal $appeal) : JsonResource
    {
        return new AppealResource($this->repository->update(
            $appeal->id,
            $request->validated()
        ));
    }

    public function assignCurator($id, AssignCuratorRequest $request) : JsonResource
    {
        return new AppealResource($this->repository
            ->assignCurator($id, $request->validated()));
    }

    public function editCategory($id, AppealEditCategoryRequest $request) : JsonResource
    {
        $fields = $request->validated();

        $fields['change_category'] = true;

        $appeal = $this->repository->update($id, Arr::only($fields,['category_id', 'change_category']));

        return new AppealResource($appeal);
    }

    public function attachDocuments($id, AttachAppealDocumentRequest $request) : JsonResource
    {
        $attributes = $request->validated()
            + ['file' => $request->file];

        $this->repository->attachManagerDocuments($id, $attributes);
        return new AppealResource($this->repository->find($id));
    }

    public function cantContact($id) : JsonResource
    {
        return new AppealResource($this->repository
            ->cantContact($id));
    }

    public function byProduct(Request $request, $id) : JsonResource
    {
        return new AppealResource($this->repository
           ->byProduct($request, $id));
    }

    public function notByProduct(Request $request, $id) : JsonResource
    {
        return new AppealResource($this->repository
            ->notByProduct($request, $id));
    }

    public function requiresClarification(Request $request, $id) : JsonResource
    {
        return new AppealResource($this->repository
            ->requiresClarification($request, $id));
    }
}