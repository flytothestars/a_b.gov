<?php

namespace App\Http\Controllers\API\UPIHead;

use App\Http\Controllers\Controller;
use App\Http\Requests\AppealRequest;
use App\Http\Resources\AppealResource;
use App\Http\Resources\AppealShortResource;
use App\Models\Appeal;
use App\Repositories\IAppealForUPIHeadRepository;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;


use App\Exports\AppealsExport;
use Maatwebsite\Excel\Facades\Excel;

class AppealController extends Controller
{
    private $repository;

    public function __construct(IAppealForUPIHeadRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(AppealRequest $request): JsonResource
    {
        return AppealShortResource::collection($this->repository
            ->allByFilter($request->validated()));
    }

    public function exportToExcel(AppealRequest $request)
    {
        ini_set('memory_limit', '-1');
        return Excel::download(new AppealsExport($this->repository->allByFilterForExport(Arr::except($request->validated(), ['per_page'])), $request->validated()), 'allAppeals.xlsx');
    }

    public function show(Appeal $appeal) : JsonResource
    {
        return new AppealResource($this->repository
            ->find($appeal->id));
    }

    public function indexByAuthUser(AppealRequest $request)
    {
        return AppealShortResource::collection($this->repository
            ->findAppealsByAuthUser($request->validated()));
    }
}
