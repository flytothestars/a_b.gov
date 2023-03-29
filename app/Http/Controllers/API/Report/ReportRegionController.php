<?php

namespace App\Http\Controllers\API\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\Report\DistrictReportRatiosRequest;
use App\Http\Requests\Report\UpdateDistrictRatiosRequest;
use App\Http\Resources\RegionResource;
use App\Http\Resources\Report\ReportRatioResource;
use App\Repositories\IDistrictRepository;
use App\Repositories\Report\IReportDistrictRatioRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportRegionController extends Controller
{
    private IReportDistrictRatioRepository $reportDistrictRatioRepository;
    public IDistrictRepository             $districtRepository;

    /**
     * ReportTypeController constructor.
     *
     */
    public function __construct(
        IReportDistrictRatioRepository $reportDistrictRatioRepository,
        IDistrictRepository $districtRepository
    )
    {
        $this->reportDistrictRatioRepository = $reportDistrictRatioRepository;
        $this->districtRepository            = $districtRepository;
    }

    public function getDistrictsListByCity(string $city_id)
    {
        return RegionResource::collection($this->districtRepository->getListByCityId($city_id));
    }

    public function fetchReportRatioList(DistrictReportRatiosRequest $request)
    {
        $attributes = $request->validated();

        return ReportRatioResource::collection($this->reportDistrictRatioRepository->fetchReportRatioList($attributes));

    }

    public function updateDistrictRatios(UpdateDistrictRatiosRequest $request)
    {
        $attributes = $request->validated();

        DB::beginTransaction();

        $dateRatio = Carbon::createFromFormat('Y-m-d', $attributes[ 'date' ])
                           ->day(1)
                           ->format('Y-m-d')
        ;

        foreach ($attributes[ 'ratios' ] as $ratio) {
            $ratioFields = [
                'city_id'        => $attributes[ 'city_id' ],
                'report_type_id' => $attributes[ 'report_type_id' ],
                'district_id'      => $attributes[ 'district_id' ],
                'ratio_id'       => $ratio[ 'id' ],
                'value'          => (float)$ratio[ 'value' ],
                'date'           => $dateRatio,
            ];
            if ($ratio[ 'ratio_id' ]) {
                $this->reportDistrictRatioRepository->update($ratio[ 'ratio_id' ], $ratioFields);
            } else {
                $this->reportDistrictRatioRepository->create($ratioFields);
            }
        }

        DB::commit();

        return ReportRatioResource::collection($this->reportDistrictRatioRepository->fetchReportRatioList($attributes));
    }
}
