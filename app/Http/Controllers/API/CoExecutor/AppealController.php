<?php

namespace App\Http\Controllers\API\CoExecutor;

use App\Http\Controllers\Controller;
use App\Http\Requests\AppealRequest;
use App\Http\Requests\AttachAppealDocumentRequest;
use App\Http\Requests\CompleteAppealRequest;
use App\Http\Requests\ConfirmAppealRequest;
use App\Http\Requests\RejectAppealRequest;
use App\Http\Resources\AppealResource;
use App\Models\Appeal;
use App\Repositories\IAppealForDistributorRepository;
use App\Repositories\IAppealForCoExecutorRepository;
use Illuminate\Http\Resources\Json\JsonResource;

use App\Exports\AppealsExport;
use Illuminate\Support\Arr;
use Maatwebsite\Excel\Facades\Excel;

class AppealController extends Controller
{
    private $repository;

    public function __construct(IAppealForCoExecutorRepository $repository)
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
        return Excel::download(new AppealsExport($this->repository->allByFilterForExport(Arr::except($request->validated(), ['per_page'])), $request->validated()), 'allAppeals.xlsx');
    }

    public function exportToExcelByAuthUser(AppealRequest $request)
    {
        ini_set('memory_limit', '-1');
        return Excel::download(new AppealsExport($this->repository->findAppealsByAuthUser($request->validated()), $request), 'userAppeals.xlsx');
    }

    public function show(Appeal $appeal) : JsonResource
    {
        return new AppealResource($this->repository
            ->find($appeal->id));
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
}
