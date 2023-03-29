<?php

namespace App\Http\Controllers\API\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\Report\CityReportRatiosRequest;
use App\Http\Requests\Report\UpdateCityRatiosRequest;
use App\Http\Resources\DictResource;
use App\Http\Resources\Report\ReportRatioResource;
use App\Models\Report\ReportCityRatio;
use App\Models\Report\ReportRatio;
use App\Repositories\ICityRepository;
use App\Repositories\Report\IReportCityRatioRepository;
use App\Repositories\Report\IReportTypesRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class ReportCityController extends Controller
{
    private IReportCityRatioRepository $reportCityRatioRepository;

    /**
     * ReportTypeController constructor.
     *
     */
    public function __construct(
        IReportCityRatioRepository $reportCityRatioRepository
    )
    {
        $this->reportCityRatioRepository = $reportCityRatioRepository;
    }


    final public function fetchReportTypeRatioList(CityReportRatiosRequest $request): JsonResponse
    {
        $attributes = $request->validated();

        return response()->json(
            $this->reportCityRatioRepository->fetchReportTypeRatioList($attributes)
        );
    }

    final public function updateCityRatios(UpdateCityRatiosRequest $request): JsonResponse
    {
        $attributes = $request->validated();

        DB::beginTransaction();

        $dateRatio = Carbon::createFromFormat('Y-m-d', $attributes[ 'date' ])
                           ->day(1)
                           ->format('Y-m-d')
        ;

        $ratioGroups = $attributes[ 'ratios' ];
        $ratios = [];
        foreach ($ratioGroups as $list)
        {
            /** @noinspection SlowArrayOperationsInLoopInspection */
            $ratios = array_merge($ratios, $list);
        }

        foreach ($ratios as $ratio) {
            if (
                $ratio[ 'value' ] !== ''
                && $ratio[ 'value' ] !== null
            ) {
                $ratioFields = [
                    'city_id'        => $attributes[ 'city_id' ],
                    'report_type_id' => $attributes[ 'report_type_id' ],
                    'ratio_id'       => $ratio[ 'id' ],
                    'value'          => (float)$ratio[ 'value' ],
                    'date'           => $dateRatio,
                ];
                $exists = ReportCityRatio
                    ::where('ratio_id',  $ratio['id'])
                    ->where('date', $dateRatio)
                    ->where('city_id', $attributes[ 'city_id' ])
                    ->get()
                    ->last();
                if ($exists) {
                    $this->reportCityRatioRepository->update($exists[ 'id' ], $ratioFields);
                } else {
                    $this->reportCityRatioRepository->create($ratioFields);
                }
            }else{
                $this->reportCityRatioRepository->delete($ratio[ 'ratio_id' ]);
            }
        }

        if(isset($attributes[ 'ratiosMonth' ]))
        {
            foreach ($attributes[ 'ratiosMonth' ] as $ratioId => $dates) {
                foreach ($dates as $date => $ratio) {
                    if ($ratio[ 'value' ] !== '') {
                        $ratioFields = [
                            'city_id'        => $attributes[ 'city_id' ],
                            'report_type_id' => $attributes[ 'report_type_id' ],
                            'ratio_id'       => $ratioId,
                            'value'          => (float)($ratio[ 'value' ] ?? 0),
                            'date'           => $date,
                        ];
                        $exists      = ReportCityRatio
                            ::where('ratio_id', $ratioId)
                            ->where('report_type_id', $attributes[ 'report_type_id' ])
                            ->where('city_id', $attributes[ 'city_id' ])
                            ->where('date', $date)
                            ->exists()
                        ;
                        if ($exists) {
                            $ratioModel        = ReportCityRatio
                                ::where('ratio_id', $ratioId)
                                ->where('report_type_id', $attributes[ 'report_type_id' ])
                                ->where('city_id', $attributes[ 'city_id' ])
                                ->where('date', $date)
                                ->get()
                                ->last()
                            ;
                            $ratioModel->value = $ratio[ 'value' ];
                        } else {
                            $ratioModel = new ReportCityRatio(
                                $ratioFields
                            );
                        }

                        $ratioModel->save();
                    }else{
                        ReportCityRatio
                            ::where('ratio_id', $ratioId)
                            ->where('report_type_id', $attributes[ 'report_type_id' ])
                            ->where('city_id', $attributes[ 'city_id' ])
                            ->where('date', $date)
                            ->delete()
                        ;
                    }
                }
            }
        }
        if(isset($attributes[ 'ratiosQuarter' ])) {
            foreach ($attributes[ 'ratiosQuarter' ] as $ratioId => $dates) {
                foreach ($dates as $date => $ratio) {
                    if ($ratio[ 'value' ] !== '') {
                        $ratioFields = [
                            'city_id'        => $attributes[ 'city_id' ],
                            'report_type_id' => $attributes[ 'report_type_id' ],
                            'ratio_id'       => $ratioId,
                            'value'          => (float)($ratio[ 'value' ] ?? 0),
                            'date'           => $date,
                        ];
                        $exists      = ReportCityRatio
                            ::where('ratio_id', $ratioId)
                            ->where('report_type_id', $attributes[ 'report_type_id' ])
                            ->where('city_id', $attributes[ 'city_id' ])
                            ->where('date', $date)
                            ->exists()
                        ;
                        if ($exists) {
                            $ratioModel = ReportCityRatio
                                ::where('ratio_id', $ratioId)
                                ->where('report_type_id', $attributes[ 'report_type_id' ])
                                ->where('city_id', $attributes[ 'city_id' ])
                                ->where('date', $date)
                                ->get()
                                ->last()
                            ;

                            $ratioModel->value = $ratio[ 'value' ];
                        } else {
                            $ratioModel = new ReportCityRatio(
                                $ratioFields
                            );
                        }

                        $ratioModel->save();
                    }else{
                        ReportCityRatio
                            ::where('ratio_id', $ratioId)
                            ->where('report_type_id', $attributes[ 'report_type_id' ])
                            ->where('city_id', $attributes[ 'city_id' ])
                            ->where('date', $date)
                            ->delete()
                        ;
                    }
                }
            }
        }

        DB::commit();

        return response()->json($this->reportCityRatioRepository->fetchReportTypeRatioList($attributes));
    }


}
