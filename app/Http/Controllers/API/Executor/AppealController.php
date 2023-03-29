<?php

namespace App\Http\Controllers\API\Executor;

use App\Exports\LoansExport2;
use App\Exports\ContactsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\AppealEditCategoryRequest;
use App\Http\Requests\AppealRequest;
use App\Http\Requests\AssignCoExecutorRequest;
use App\Http\Requests\AttachAppealDocumentRequest;
use App\Http\Requests\CompleteAppealRequest;
use App\Http\Requests\ConfirmAppealRequest;
use App\Http\Requests\RejectAppealRequest;
use App\Http\Resources\AppealResource;
use App\Models\Appeal;
use App\Repositories\IAppealForDistributorRepository;
use App\Repositories\IAppealForCoExecutorRepository;
use App\Repositories\IAppealForExecutorRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Exports\LoansExport;
use App\Exports\AppealsExport;
use Illuminate\Support\Arr;
use Maatwebsite\Excel\Facades\Excel;

class AppealController extends Controller
{
    private $repository;

    public function __construct(IAppealForExecutorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(AppealRequest $request): JsonResource
    {
        return AppealResource::collection($this->repository
            ->allByFilter($request->validated()));
    }

    public function indexByAuthUser(AppealRequest $request): JsonResource
    {
        return AppealResource::collection($this->repository
            ->findAppealsByAuthUser($request->validated()));
    }

    public function exportToExcel(AppealRequest $request)
    {
        ini_set('memory_limit', '-1');
        return Excel::download(new LoansExport($request->validated()), 'userAppeals.xlsx',\Maatwebsite\Excel\Excel::XLSX);

        //return Excel::download(new AppealsExport($this->repository->allByFilterForExport(Arr::except($request->validated(), ['per_page'])), $request->validated()), 'allAppeals.xlsx');
    }

    public function exportToExcel2(AppealRequest $request)
    {
        ini_set('memory_limit', '-1');
        return Excel::download(new LoansExport2($request->validated()), 'userAppeals.xlsx',\Maatwebsite\Excel\Excel::XLSX);

        //return Excel::download(new AppealsExport($this->repository->allByFilterForExport(Arr::except($request->validated(), ['per_page'])), $request->validated()), 'allAppeals.xlsx');
    }

    public function exportToExcelContact(Request $request)
    {
        ini_set('memory_limit', '-1');
        return Excel::download(new ContactsExport($request->all()), 'contacts.xlsx',\Maatwebsite\Excel\Excel::XLSX);
    }

    public function exportToExcelByAuthUser(AppealRequest $request)
    {
        ini_set('memory_limit', '-1');

        return Excel::download(new LoansExport(), 'userAppeals.xlsx',\Maatwebsite\Excel\Excel::XLSX);
        //return Excel::download(new AppealsExport($this->repository->findAppealsByAuthUser($request->validated())), 'userAppeals.xlsx');
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

    public function assignCoExecutor($id, AssignCoExecutorRequest $request) : JsonResource
    {
        return new AppealResource($this->repository
            ->assignCoExecutor($id, $request->validated()));
    }

    public function complete($id, ConfirmAppealRequest $request) : JsonResource
    {
        return new AppealResource($this->repository
            ->complete($id, $request->validated()));
    }

    public function reject($id, RejectAppealRequest $request) : JsonResource
    {
        return new AppealResource($this->repository
            ->reject($id, $request->validated()));
    }

    public function attachDocuments($id, AttachAppealDocumentRequest $request) : JsonResource
    {
        $this->repository->attachManagerDocuments($id, $request->validated());
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

    public function editCategory($id, AppealEditCategoryRequest $request) : JsonResource
    {
        $fields = $request->validated();

        $fields['change_category'] = true;

        $appeal = $this->repository->update($id, Arr::only($fields,['category_id', 'change_category']));

        return new AppealResource($appeal);
    }
}
