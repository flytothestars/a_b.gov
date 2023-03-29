<?php

namespace App\Http\Controllers\API\Report;

use App\Http\Controllers\Controller;
use App\Http\Resources\DictResource;
use App\Repositories\ICityRepository;
use App\Repositories\Report\IReportTypesRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReportTypeController extends Controller
{
    private IReportTypesRepository $reportTypesRepository;
    private ICityRepository        $cityRepository;

    /**
     * ReportTypeController constructor.
     *
     * @param IReportTypesRepository $reportTypesRepository
     * @param ICityRepository        $cityRepository
     */
    public function __construct(
        IReportTypesRepository $reportTypesRepository,
        ICityRepository $cityRepository
    )
    {
        $this->reportTypesRepository = $reportTypesRepository;
        $this->cityRepository        = $cityRepository;
    }


    final public function getReportTypes(): JsonResource
    {
        return DictResource::collection($this->reportTypesRepository->all());
    }

    final public function citiesList(): JsonResource
    {
        return DictResource::collection($this->cityRepository->all());
    }

}
