<?php

namespace App\Http\Controllers\API\DivisionCurator;

use App\Exports\AppealsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\AppealRequest;
use App\Http\Requests\AssignCoExecutorRequest;
use App\Http\Requests\AssignCuratorRequest;
use App\Http\Requests\AssignExecutorRequest;
use App\Http\Requests\CompleteAppealRequest;
use App\Http\Requests\RejectAppealRequest;
use App\Http\Resources\AppealResource;
use App\Models\Appeal;
use App\Repositories\IAppealForDistributorRepository;
use App\Repositories\IAppealForDivisionCuratorRepository;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class AppealController extends Controller
{
    private $repository;

    public function __construct(IAppealForDivisionCuratorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(AppealRequest $request): JsonResource
    {
        return AppealResource::collection($this->repository
            ->allByFilter($request->validated()));
    }

    public function indexByAuthUser(AppealRequest $request)
    {
        return AppealResource::collection($this->repository
            ->findAppealsByAuthUser($request->validated()));
    }

    public function show(Appeal $appeal) : JsonResource
    {
        return new AppealResource($this->repository
            ->find($appeal->id));
    }

    public function backToWork($id) : JsonResource
    {
        return new AppealResource($this->repository
            ->backToWork($id));
    }


    public function complete($id, CompleteAppealRequest $request) : JsonResource
    {
        return new AppealResource($this->repository
            ->complete($id, $request->validated()));
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
}
