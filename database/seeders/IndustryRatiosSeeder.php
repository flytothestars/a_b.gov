<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\District;
use App\Models\Report\ReportCityRatio;
use App\Models\Report\ReportDistrictRatio;
use App\Models\Report\ReportRatio;
use App\Repositories\Enums\Reports\IIndustryReportRatioEnum;
use App\Repositories\Enums\Reports\IRatioScopeEnum;
use App\Repositories\Enums\Reports\IReportTypeEnum;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

// TODO remove seeder
class IndustryRatiosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ratios = [
            [
                'id'             => IIndustryReportRatioEnum::InvestmentsInManufacturingIndustry,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeIndustry,
                'name'           => trans(IIndustryReportRatioEnum::InvestmentsInManufacturingIndustryName),
            ],
            [
                'id'             => IIndustryReportRatioEnum::Performance,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeIndustry,
                'name'           => trans(IIndustryReportRatioEnum::PerformanceName),
            ],
            [
                'id'             => IIndustryReportRatioEnum::PhysicalVolumeIndexByDistricts,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_REGION,
                'report_type_id' => IReportTypeEnum::ReportTypeIndustry,
                'name'           => trans(IIndustryReportRatioEnum::PhysicalVolumeIndexByDistrictsName),
            ],
            [
                'id'             => IIndustryReportRatioEnum::ProductionVolumeByDistricts,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_REGION,
                'report_type_id' => IReportTypeEnum::ReportTypeIndustry,
                'name'           => trans(IIndustryReportRatioEnum::ProductionVolumeByDistrictsName),
            ],
            [
                'id'             => IIndustryReportRatioEnum::InvestmentsInManufacturingIndustryByDistricts,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_REGION,
                'report_type_id' => IReportTypeEnum::ReportTypeIndustry,
                'name'           => trans(IIndustryReportRatioEnum::InvestmentsInManufacturingIndustryByDistrictsName),
            ],
            [
                'id'             => IIndustryReportRatioEnum::DynamicsOfProductionGrowthYearFirst,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeIndustry,
                'name'           => trans(IIndustryReportRatioEnum::DynamicsOfProductionGrowthYearFirstName),
            ],
            [
                'id'             => IIndustryReportRatioEnum::DynamicsOfProductionGrowthValueFirst,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeIndustry,
                'name'           => trans(IIndustryReportRatioEnum::DynamicsOfProductionGrowthValueFirstName),
            ],
            [
                'id'             => IIndustryReportRatioEnum::DynamicsOfProductionGrowthYearSecond,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeIndustry,
                'name'           => trans(IIndustryReportRatioEnum::DynamicsOfProductionGrowthYearSecondName),
            ],
            [
                'id'             => IIndustryReportRatioEnum::DynamicsOfProductionGrowthValueSecond,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeIndustry,
                'name'           => trans(IIndustryReportRatioEnum::DynamicsOfProductionGrowthValueSecondName),
            ],
            [
                'id'             => IIndustryReportRatioEnum::DynamicsOfProductionGrowthYearThird,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeIndustry,
                'name'           => trans(IIndustryReportRatioEnum::DynamicsOfProductionGrowthYearThirdName),
            ],
            [
                'id'             => IIndustryReportRatioEnum::DynamicsOfProductionGrowthValueThird,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeIndustry,
                'name'           => trans(IIndustryReportRatioEnum::DynamicsOfProductionGrowthValueThirdName),
            ],
        ];

        foreach (IIndustryReportRatioEnum::Top5IndustriesList as $ratio) {
            $ratios[] = [
                'id'             => $ratio,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeIndustry,
                'name'           => trans(IIndustryReportRatioEnum::Top5IndustriesName)
                                    . ' - '
                                    . trans(IIndustryReportRatioEnum::IndustriesNamesList[ $ratio ]),
            ];
        }
        foreach (IIndustryReportRatioEnum::ProductionByIndustriesList as $ratio) {
            $ratios[] = [
                'id'             => $ratio,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeIndustry,
                'name'           => trans(IIndustryReportRatioEnum::ProductionByIndustriesName)
                                    . ' - '
                                    . trans(IIndustryReportRatioEnum::IndustriesNamesList[ $ratio ]),
            ];
        }
        foreach (IIndustryReportRatioEnum::FixedCapitalInvestmentsByTypeOfProductionList as $ratio) {
            $ratios[] = [
                'id'             => $ratio,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeIndustry,
                'name'           => trans(IIndustryReportRatioEnum::FixedCapitalInvestmentsByTypeOfProductionName)
                                    . ' - '
                                    . trans(IIndustryReportRatioEnum::IndustriesNamesList[ $ratio ]),
            ];
        }
        foreach (IIndustryReportRatioEnum::ProductivityByTypeOfProductionList as $ratio) {
            $ratios[] = [
                'id'             => $ratio,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeIndustry,
                'name'           => trans(IIndustryReportRatioEnum::ProductivityByTypeOfProductionNameShort)
                                    . ' - '
                                    . trans(IIndustryReportRatioEnum::IndustriesNamesList[ $ratio ]),
            ];
        }

        ReportRatio::insert($ratios);

        $date = Carbon::now()
                      ->day(1)
                      ->format('Y-m-d')
        ;

        $cityId = City::query()->first()->id;

        $cityRatios = [
            [
                'id'             => Uuid::uuid4(),
                'city_id'        => $cityId,
                'report_type_id' => IReportTypeEnum::ReportTypeIndustry,
                'ratio_id'       => IIndustryReportRatioEnum::InvestmentsInManufacturingIndustry,
                'date'           => $date,
                'value'          => 61,
            ],
            [
                'id'             => Uuid::uuid4(),
                'city_id'        => $cityId,
                'report_type_id' => IReportTypeEnum::ReportTypeIndustry,
                'ratio_id'       => IIndustryReportRatioEnum::Performance,
                'date'           => $date,
                'value'          => 4.9,
            ],
            [
                'id'             => Uuid::uuid4(),
                'city_id'        => $cityId,
                'report_type_id' => IReportTypeEnum::ReportTypeIndustry,
                'ratio_id'       => IIndustryReportRatioEnum::DynamicsOfProductionGrowthValueFirst,
                'date'           => $date,
                'value'          => 4.5,
            ],
            [
                'id'             => Uuid::uuid4(),
                'city_id'        => $cityId,
                'report_type_id' => IReportTypeEnum::ReportTypeIndustry,
                'ratio_id'       => IIndustryReportRatioEnum::DynamicsOfProductionGrowthYearFirst,
                'date'           => $date,
                'value'          => 2019,
            ],
            [
                'id'             => Uuid::uuid4(),
                'city_id'        => $cityId,
                'report_type_id' => IReportTypeEnum::ReportTypeIndustry,
                'ratio_id'       => IIndustryReportRatioEnum::DynamicsOfProductionGrowthValueSecond,
                'date'           => $date,
                'value'          => 4.2,
            ],
            [
                'id'             => Uuid::uuid4(),
                'city_id'        => $cityId,
                'report_type_id' => IReportTypeEnum::ReportTypeIndustry,
                'ratio_id'       => IIndustryReportRatioEnum::DynamicsOfProductionGrowthValueThird,
                'date'           => $date,
                'value'          => 4.3,
            ],
            [
                'id'             => Uuid::uuid4(),
                'city_id'        => $cityId,
                'report_type_id' => IReportTypeEnum::ReportTypeIndustry,
                'ratio_id'       => IIndustryReportRatioEnum::DynamicsOfProductionGrowthYearSecond,
                'date'           => $date,
                'value'          => 2020,
            ],
            [
                'id'             => Uuid::uuid4(),
                'city_id'        => $cityId,
                'report_type_id' => IReportTypeEnum::ReportTypeIndustry,
                'ratio_id'       => IIndustryReportRatioEnum::DynamicsOfProductionGrowthYearThird,
                'date'           => $date,
                'value'          => 2021,
            ],
        ];

        $faker = Factory::create();

        foreach (IIndustryReportRatioEnum::Top5IndustriesList as $ratio) {
            $cityRatios[] = [
                'id'             => Uuid::uuid4(),
                'city_id'        => $cityId,
                'report_type_id' => IReportTypeEnum::ReportTypeIndustry,
                'ratio_id'       => $ratio,
                'date'           => $date,
                'value'          => (float)($faker->numberBetween(-1, 1) . '.' . $faker->numberBetween(0, 5)),
            ];
        }

        foreach (IIndustryReportRatioEnum::ProductionByIndustriesList as $ratio) {
            $cityRatios[] = [
                'id'             => Uuid::uuid4(),
                'city_id'        => $cityId,
                'report_type_id' => IReportTypeEnum::ReportTypeIndustry,
                'ratio_id'       => $ratio,
                'date'           => $date,
                'value'          => $faker->numberBetween(10, 35),
            ];
        }

        foreach (IIndustryReportRatioEnum::FixedCapitalInvestmentsByTypeOfProductionList as $ratio) {
            $cityRatios[] = [
                'id'             => Uuid::uuid4(),
                'city_id'        => $cityId,
                'report_type_id' => IReportTypeEnum::ReportTypeIndustry,
                'ratio_id'       => $ratio,
                'date'           => $date,
                'value'          => $faker->numberBetween(10, 35),
            ];
        }
        foreach (IIndustryReportRatioEnum::ProductivityByTypeOfProductionList as $ratio) {
            $cityRatios[] = [
                'id'             => Uuid::uuid4(),
                'city_id'        => $cityId,
                'report_type_id' => IReportTypeEnum::ReportTypeIndustry,
                'ratio_id'       => $ratio,
                'date'           => $date,
                'value'          => $faker->numberBetween(10, 35),
            ];
        }

        ReportCityRatio::insert($cityRatios);

        $regionRatios = [];

        $districts = District::all();

        foreach ($districts as $district) {
            $regionRatios[] = [
                'id'             => Uuid::uuid4(),
                'city_id'        => $cityId,
                'district_id'      => $district->id,
                'report_type_id' => IReportTypeEnum::ReportTypeIndustry,
                'ratio_id'       => IIndustryReportRatioEnum::PhysicalVolumeIndexByDistricts,
                'date'           => $date,
                'value'          => $faker->numberBetween(50, 100),
            ];
            $regionRatios[] = [
                'id'             => Uuid::uuid4(),
                'city_id'        => $cityId,
                'district_id'      => $district->id,
                'report_type_id' => IReportTypeEnum::ReportTypeIndustry,
                'ratio_id'       => IIndustryReportRatioEnum::ProductionVolumeByDistricts,
                'date'           => $date,
                'value'          => $faker->numberBetween(1, 30),
            ];
            $regionRatios[] = [
                'id'             => Uuid::uuid4(),
                'city_id'        => $cityId,
                'district_id'      => $district->id,
                'report_type_id' => IReportTypeEnum::ReportTypeIndustry,
                'ratio_id'       => IIndustryReportRatioEnum::InvestmentsInManufacturingIndustryByDistricts,
                'date'           => $date,
                'value'          => $faker->numberBetween(1, 30),
            ];
        }

        ReportDistrictRatio::insert($regionRatios);

    }
}
