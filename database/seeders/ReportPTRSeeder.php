<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\District;
use App\Models\Report\ReportCityRatio;
use App\Models\Report\ReportDistrictRatio;
use App\Models\Report\ReportRatio;
use App\Models\Report\ReportType;
use App\Repositories\Enums\Reports\IPTRReportRatiosEnum;
use App\Repositories\Enums\Reports\IRatioScopeEnum;
use App\Repositories\Enums\Reports\IReportTypeEnum;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class ReportPTRSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ReportType::create(
            [
                'id'   => IReportTypeEnum::ReportTypePTR,
                'name' => 'ПРТ',
            ]
        );

        $ratios = [
            [
                'id'             => IPTRReportRatiosEnum::PhysicalVolumeIndexManufactureByDistricts,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_REGION,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    'report.PTR.' .
                    IPTRReportRatiosEnum::CITY_RATIOS_LIST_NAMES[ IPTRReportRatiosEnum::PhysicalVolumeIndexManufactureByDistricts ]
                ),
            ],
            [
                'id'             => IPTRReportRatiosEnum::PhysicalVolumeIndexIndustriesFood,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    'report.PTR.' .
                    IPTRReportRatiosEnum::CITY_RATIOS_LIST_NAMES[ IPTRReportRatiosEnum::PhysicalVolumeIndexIndustriesFood ]
                ),
            ],
            [
                'id'             => IPTRReportRatiosEnum::PhysicalVolumeIndexIndustriesPharma,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    'report.PTR.' .
                    IPTRReportRatiosEnum::CITY_RATIOS_LIST_NAMES[ IPTRReportRatiosEnum::PhysicalVolumeIndexIndustriesPharma ]
                ),
            ],
            [
                'id'             => IPTRReportRatiosEnum::PhysicalVolumeIndexIndustriesFurniture,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    'report.PTR.' .
                    IPTRReportRatiosEnum::CITY_RATIOS_LIST_NAMES[ IPTRReportRatiosEnum::PhysicalVolumeIndexIndustriesFurniture ]
                ),
            ],
            [
                'id'             => IPTRReportRatiosEnum::PhysicalVolumeIndexIndustriesLight,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    'report.PTR.' .
                    IPTRReportRatiosEnum::CITY_RATIOS_LIST_NAMES[ IPTRReportRatiosEnum::PhysicalVolumeIndexIndustriesLight ]
                ),
            ],
            [
                'id'             => IPTRReportRatiosEnum::PhysicalVolumeIndexIndustriesChemical,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    'report.PTR.' .
                    IPTRReportRatiosEnum::CITY_RATIOS_LIST_NAMES[ IPTRReportRatiosEnum::PhysicalVolumeIndexIndustriesChemical ]
                ),
            ],
            [
                'id'             => IPTRReportRatiosEnum::PhysicalVolumeIndexManufactureVolumeAmountPlan,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                                        'report.PTR.' .
                                        IPTRReportRatiosEnum::CITY_RATIOS_LIST_NAMES[ IPTRReportRatiosEnum::PhysicalVolumeIndexManufactureVolumeAmount ]
                                    )
                                    . ' - ' .
                                    trans(
                                        'report.PTR.' .
                                        IPTRReportRatiosEnum::CITY_RATIOS_LIST_NAMES[ IPTRReportRatiosEnum::PhysicalVolumeIndexManufactureVolumeAmountPlan ]
                                    ),
            ],
            [
                'id'             => IPTRReportRatiosEnum::PhysicalVolumeIndexManufactureVolumeAmountFact,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                                        'report.PTR.' .
                                        IPTRReportRatiosEnum::CITY_RATIOS_LIST_NAMES[ IPTRReportRatiosEnum::PhysicalVolumeIndexManufactureVolumeAmount ]
                                    )
                                    . ' - ' .
                                    trans(
                                        'report.PTR.' .
                                        IPTRReportRatiosEnum::CITY_RATIOS_LIST_NAMES[ IPTRReportRatiosEnum::PhysicalVolumeIndexManufactureVolumeAmountFact ]
                                    ),
            ],
            [
                'id'             => IPTRReportRatiosEnum::PhysicalVolumeIndexManufactureAgriculturePlan,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                                        'report.PTR.' .
                                        IPTRReportRatiosEnum::CITY_RATIOS_LIST_NAMES[ IPTRReportRatiosEnum::PhysicalVolumeIndexManufactureAgriculture ]
                                    )
                                    . ' - ' .
                                    trans(
                                        'report.PTR.' .
                                        IPTRReportRatiosEnum::CITY_RATIOS_LIST_NAMES[ IPTRReportRatiosEnum::PhysicalVolumeIndexManufactureAgriculturePlan ]
                                    ),
            ],
            [
                'id'             => IPTRReportRatiosEnum::PhysicalVolumeIndexManufactureAgricultureFact,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                                        'report.PTR.' .
                                        IPTRReportRatiosEnum::CITY_RATIOS_LIST_NAMES[ IPTRReportRatiosEnum::PhysicalVolumeIndexManufactureAgriculture ]
                                    )
                                    . ' - ' .
                                    trans(
                                        'report.PTR.' .
                                        IPTRReportRatiosEnum::CITY_RATIOS_LIST_NAMES[ IPTRReportRatiosEnum::PhysicalVolumeIndexManufactureAgricultureFact ]
                                    ),
            ],
            [
                'id'             => IPTRReportRatiosEnum::PhysicalVolumeIndexManufacturePlan,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                                        'report.PTR.' .
                                        IPTRReportRatiosEnum::CITY_RATIOS_LIST_NAMES[ IPTRReportRatiosEnum::PhysicalVolumeIndexManufacture ]
                                    )
                                    . ' - ' .
                                    trans(
                                        'report.PTR.' .
                                        IPTRReportRatiosEnum::CITY_RATIOS_LIST_NAMES[ IPTRReportRatiosEnum::PhysicalVolumeIndexManufacturePlan ]
                                    ),
            ],
            [
                'id'             => IPTRReportRatiosEnum::PhysicalVolumeIndexManufactureFact,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                                        'report.PTR.' .
                                        IPTRReportRatiosEnum::CITY_RATIOS_LIST_NAMES[ IPTRReportRatiosEnum::PhysicalVolumeIndexManufacture ]
                                    )
                                    . ' - ' .
                                    trans(
                                        'report.PTR.' .
                                        IPTRReportRatiosEnum::CITY_RATIOS_LIST_NAMES[ IPTRReportRatiosEnum::PhysicalVolumeIndexManufactureFact ]
                                    ),
            ],
            [
                'id'             => IPTRReportRatiosEnum::ExportNonResourceVolumeGrowthPlan,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                                        'report.PTR.' .
                                        IPTRReportRatiosEnum::CITY_RATIOS_LIST_NAMES[ IPTRReportRatiosEnum::ExportNonResourceVolumeGrowth ]
                                    )
                                    . ' - ' .
                                    trans(
                                        'report.PTR.' .
                                        IPTRReportRatiosEnum::CITY_RATIOS_LIST_NAMES[ IPTRReportRatiosEnum::ExportNonResourceVolumeGrowthPlan ]
                                    ),
            ],
            [
                'id'             => IPTRReportRatiosEnum::ExportNonResourceVolumeGrowthFact,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                                        'report.PTR.' .
                                        IPTRReportRatiosEnum::CITY_RATIOS_LIST_NAMES[ IPTRReportRatiosEnum::ExportNonResourceVolumeGrowth ]
                                    )
                                    . ' - ' .
                                    trans(
                                        'report.PTR.' .
                                        IPTRReportRatiosEnum::CITY_RATIOS_LIST_NAMES[ IPTRReportRatiosEnum::ExportNonResourceVolumeGrowthFact ]
                                    ),
            ],
            [
                'id'             => IPTRReportRatiosEnum::PhysicalVolumeIndexManufactureInvestmentsPlan,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                                        'report.PTR.' .
                                        IPTRReportRatiosEnum::CITY_RATIOS_LIST_NAMES[ IPTRReportRatiosEnum::PhysicalVolumeIndexManufactureInvestments ]
                                    )
                                    . ' - ' .
                                    trans(
                                        'report.PTR.' .
                                        IPTRReportRatiosEnum::CITY_RATIOS_LIST_NAMES[ IPTRReportRatiosEnum::PhysicalVolumeIndexManufactureInvestmentsPlan ]
                                    ),
            ],
            [
                'id'             => IPTRReportRatiosEnum::PhysicalVolumeIndexManufactureInvestmentsFact,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                                        'report.PTR.' .
                                        IPTRReportRatiosEnum::CITY_RATIOS_LIST_NAMES[ IPTRReportRatiosEnum::PhysicalVolumeIndexManufactureInvestments ]
                                    )
                                    . ' - ' .
                                    trans(
                                        'report.PTR.' .
                                        IPTRReportRatiosEnum::CITY_RATIOS_LIST_NAMES[ IPTRReportRatiosEnum::PhysicalVolumeIndexManufactureInvestmentsFact ]
                                    ),
            ],
            [
                'id'             => IPTRReportRatiosEnum::VPR_MSB_VolumePlan,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                                        'report.PTR.' .
                                        IPTRReportRatiosEnum::CITY_RATIOS_LIST_NAMES[ IPTRReportRatiosEnum::VPR_MSB_Volume ]
                                    )
                                    . ' - ' .
                                    trans(
                                        'report.PTR.' .
                                        IPTRReportRatiosEnum::CITY_RATIOS_LIST_NAMES[ IPTRReportRatiosEnum::VPR_MSB_VolumePlan ]
                                    ),
            ],
            [
                'id'             => IPTRReportRatiosEnum::VPR_MSB_VolumeFact,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                                        'report.PTR.' .
                                        IPTRReportRatiosEnum::CITY_RATIOS_LIST_NAMES[ IPTRReportRatiosEnum::VPR_MSB_Volume ]
                                    )
                                    . ' - ' .
                                    trans(
                                        'report.PTR.' .
                                        IPTRReportRatiosEnum::CITY_RATIOS_LIST_NAMES[ IPTRReportRatiosEnum::VPR_MSB_VolumeFact ]
                                    ),
            ],
        ];

        ReportRatio::insert($ratios);

        $faker        = Factory::create();
        $regionRatios = [];

        $districts = District::all();
        $cityId    = City::query()
                         ->first()->id
        ;
        $date      = Carbon::now()
                           ->day(1)
                           ->format('Y-m-d')
        ;

        foreach ($districts as $district) {
            $regionRatios[] = [
                'id'             => Uuid::uuid4(),
                'city_id'        => $cityId,
                'district_id'    => $district->id,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'ratio_id'       => IPTRReportRatiosEnum::PhysicalVolumeIndexManufactureByDistricts,
                'date'           => $date,
                'value'          => $faker->numberBetween(80, 120),
            ];
        }

        ReportDistrictRatio::insert($regionRatios);

        $cityRatios = [
          [
              'id'             => Uuid::uuid4(),
              'city_id'        => $cityId,
              'report_type_id' => IReportTypeEnum::ReportTypePTR,
              'ratio_id'       => IPTRReportRatiosEnum::PhysicalVolumeIndexIndustriesFood,
              'date'           => $date,
              'value'          => 35,
          ],
          [
              'id'             => Uuid::uuid4(),
              'city_id'        => $cityId,
              'report_type_id' => IReportTypeEnum::ReportTypePTR,
              'ratio_id'       => IPTRReportRatiosEnum::PhysicalVolumeIndexIndustriesPharma,
              'date'           => $date,
              'value'          => 12,
          ],
          [
              'id'             => Uuid::uuid4(),
              'city_id'        => $cityId,
              'report_type_id' => IReportTypeEnum::ReportTypePTR,
              'ratio_id'       => IPTRReportRatiosEnum::PhysicalVolumeIndexIndustriesFurniture,
              'date'           => $date,
              'value'          => 15,
          ],
          [
              'id'             => Uuid::uuid4(),
              'city_id'        => $cityId,
              'report_type_id' => IReportTypeEnum::ReportTypePTR,
              'ratio_id'       => IPTRReportRatiosEnum::PhysicalVolumeIndexIndustriesLight,
              'date'           => $date,
              'value'          => 12,
          ],
          [
              'id'             => Uuid::uuid4(),
              'city_id'        => $cityId,
              'report_type_id' => IReportTypeEnum::ReportTypePTR,
              'ratio_id'       => IPTRReportRatiosEnum::PhysicalVolumeIndexIndustriesChemical,
              'date'           => $date,
              'value'          => 10,
          ],
          [
              'id'             => Uuid::uuid4(),
              'city_id'        => $cityId,
              'report_type_id' => IReportTypeEnum::ReportTypePTR,
              'ratio_id'       => IPTRReportRatiosEnum::PhysicalVolumeIndexManufacturePlan,
              'date'           => $date,
              'value'          => 103.0,
          ],
          [
              'id'             => Uuid::uuid4(),
              'city_id'        => $cityId,
              'report_type_id' => IReportTypeEnum::ReportTypePTR,
              'ratio_id'       => IPTRReportRatiosEnum::PhysicalVolumeIndexManufactureFact,
              'date'           => $date,
              'value'          => 101.9,
          ],
          [
              'id'             => Uuid::uuid4(),
              'city_id'        => $cityId,
              'report_type_id' => IReportTypeEnum::ReportTypePTR,
              'ratio_id'       => IPTRReportRatiosEnum::ExportNonResourceVolumeGrowthPlan,
              'date'           => $date,
              'value'          => 106.0,
          ],
          [
              'id'             => Uuid::uuid4(),
              'city_id'        => $cityId,
              'report_type_id' => IReportTypeEnum::ReportTypePTR,
              'ratio_id'       => IPTRReportRatiosEnum::ExportNonResourceVolumeGrowthFact,
              'date'           => $date,
              'value'          => 113.3,
          ],
          [
              'id'             => Uuid::uuid4(),
              'city_id'        => $cityId,
              'report_type_id' => IReportTypeEnum::ReportTypePTR,
              'ratio_id'       => IPTRReportRatiosEnum::PhysicalVolumeIndexManufactureAgriculturePlan,
              'date'           => $date,
              'value'          => 101.0,
          ],
          [
              'id'             => Uuid::uuid4(),
              'city_id'        => $cityId,
              'report_type_id' => IReportTypeEnum::ReportTypePTR,
              'ratio_id'       => IPTRReportRatiosEnum::PhysicalVolumeIndexManufactureAgricultureFact,
              'date'           => $date,
              'value'          => 124.9,
          ],
          [
              'id'             => Uuid::uuid4(),
              'city_id'        => $cityId,
              'report_type_id' => IReportTypeEnum::ReportTypePTR,
              'ratio_id'       => IPTRReportRatiosEnum::PhysicalVolumeIndexManufactureVolumeAmountPlan,
              'date'           => $date,
              'value'          => 104.6,
          ],
          [
              'id'             => Uuid::uuid4(),
              'city_id'        => $cityId,
              'report_type_id' => IReportTypeEnum::ReportTypePTR,
              'ratio_id'       => IPTRReportRatiosEnum::PhysicalVolumeIndexManufactureVolumeAmountFact,
              'date'           => $date,
              'value'          => 124.9,
          ],
          [
              'id'             => Uuid::uuid4(),
              'city_id'        => $cityId,
              'report_type_id' => IReportTypeEnum::ReportTypePTR,
              'ratio_id'       => IPTRReportRatiosEnum::VPR_MSB_VolumePlan,
              'date'           => $date,
              'value'          => 40.0,
          ],
          [
              'id'             => Uuid::uuid4(),
              'city_id'        => $cityId,
              'report_type_id' => IReportTypeEnum::ReportTypePTR,
              'ratio_id'       => IPTRReportRatiosEnum::VPR_MSB_VolumeFact,
              'date'           => $date,
              'value'          => 41.2,
          ],
          [
              'id'             => Uuid::uuid4(),
              'city_id'        => $cityId,
              'report_type_id' => IReportTypeEnum::ReportTypePTR,
              'ratio_id'       => IPTRReportRatiosEnum::PhysicalVolumeIndexManufactureInvestmentsPlan,
              'date'           => $date,
              'value'          => 61.0,
          ],
          [
              'id'             => Uuid::uuid4(),
              'city_id'        => $cityId,
              'report_type_id' => IReportTypeEnum::ReportTypePTR,
              'ratio_id'       => IPTRReportRatiosEnum::PhysicalVolumeIndexManufactureInvestmentsFact,
              'date'           => $date,
              'value'          => 9.2,
          ],
        ];

        ReportCityRatio::insert($cityRatios);

    }
}
