<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Report\ReportCityRatio;
use App\Models\Report\ReportRatio;
use App\Repositories\Enums\Reports\IRatioScopeEnum;
use App\Repositories\Enums\Reports\IReportTypeEnum;
use App\Repositories\Enums\Reports\ITradeReportRatioEnum;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class TradeReportSeeder extends Seeder
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
                'id'             => ITradeReportRatioEnum::PhysicalVolumeIndexCommonPercentRetail,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeTrade,
                'name'           => trans(
                    ITradeReportRatioEnum::RatioNames[ ITradeReportRatioEnum::PhysicalVolumeIndexCommonPercentRetail ]
                ),
            ],
            [
                'id'             => ITradeReportRatioEnum::PhysicalVolumeIndexCommonAmountRetail,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeTrade,
                'name'           => trans(
                    ITradeReportRatioEnum::RatioNames[ ITradeReportRatioEnum::PhysicalVolumeIndexCommonAmountRetail ]
                ),
            ],
            [
                'id'             => ITradeReportRatioEnum::PhysicalVolumeIndexCommonPercentWholesale,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeTrade,
                'name'           => trans(
                    ITradeReportRatioEnum::RatioNames[ ITradeReportRatioEnum::PhysicalVolumeIndexCommonPercentWholesale ]
                ),
            ],
            [
                'id'             => ITradeReportRatioEnum::PhysicalVolumeIndexCommonAmountWholesale,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeTrade,
                'name'           => trans(
                    ITradeReportRatioEnum::RatioNames[ ITradeReportRatioEnum::PhysicalVolumeIndexCommonAmountWholesale ]
                ),
            ],
            [
                'id'             => ITradeReportRatioEnum::PhysicalVolumeIndexProductAmountRetail,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeTrade,
                'name'           => trans(
                    ITradeReportRatioEnum::RatioNames[ ITradeReportRatioEnum::PhysicalVolumeIndexProductAmountRetail ]
                ),
            ],
            [
                'id'             => ITradeReportRatioEnum::PhysicalVolumeIndexProductAmountWholesale,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeTrade,
                'name'           => trans(
                    ITradeReportRatioEnum::RatioNames[ ITradeReportRatioEnum::PhysicalVolumeIndexProductAmountWholesale ]
                ),
            ],
            [
                'id'             => ITradeReportRatioEnum::PhysicalVolumeIndexNoProductAmountRetail,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeTrade,
                'name'           => trans(
                    ITradeReportRatioEnum::RatioNames[ ITradeReportRatioEnum::PhysicalVolumeIndexNoProductAmountRetail ]
                ),
            ],
            [
                'id'             => ITradeReportRatioEnum::PhysicalVolumeIndexNoProductAmountWholesale,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeTrade,
                'name'           => trans(
                    ITradeReportRatioEnum::RatioNames[ ITradeReportRatioEnum::PhysicalVolumeIndexNoProductAmountWholesale ]
                ),
            ],
            [
                'id'             => ITradeReportRatioEnum::PhysicalVolumeIndexProductPercentRetail,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeTrade,
                'name'           => trans(
                    ITradeReportRatioEnum::RatioNames[ ITradeReportRatioEnum::PhysicalVolumeIndexProductPercentRetail ]
                ),
            ],
            [
                'id'             => ITradeReportRatioEnum::PhysicalVolumeIndexProductPercentWholesale,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeTrade,
                'name'           => trans(
                    ITradeReportRatioEnum::RatioNames[ ITradeReportRatioEnum::PhysicalVolumeIndexProductPercentWholesale ]
                ),
            ],
            [
                'id'             => ITradeReportRatioEnum::PhysicalVolumeIndexNoProductPercentRetail,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeTrade,
                'name'           => trans(
                    ITradeReportRatioEnum::RatioNames[ ITradeReportRatioEnum::PhysicalVolumeIndexNoProductPercentRetail ]
                ),
            ],
            [
                'id'             => ITradeReportRatioEnum::PhysicalVolumeIndexNoProductPercentWholesale,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeTrade,
                'name'           => trans(
                    ITradeReportRatioEnum::RatioNames[ ITradeReportRatioEnum::PhysicalVolumeIndexNoProductPercentWholesale ]
                ),
            ],
        ];

        ReportRatio::insert($ratios);

        $dateEnd = Carbon::createFromFormat('Y-m-d', '2021-09-01')
                         ->setTime(0, 0, 0)
        ;

        $dateStart = Carbon::createFromFormat('Y-m-d', '2019-01-01')
                           ->setTime(0, 0, 0)
        ;

        $faker = Factory::create();

        $cityRatios = [];
        $cityId = City::query()->first()->id;

        while ($dateStart->timestamp < $dateEnd->timestamp) {
            $dateStart->addMonths(1);
            foreach (ITradeReportRatioEnum::PercentRatios as $ratio) {
                $cityRatios[] = [
                    'id'             => Uuid::uuid4(),
                    'city_id'        => $cityId,
                    'report_type_id' => IReportTypeEnum::ReportTypeTrade,
                    'ratio_id'       => $ratio,
                    'date'           => $dateStart->format('Y-m-d'),
                    'value'          => (float)($faker->numberBetween(1, 99) . '.' . $faker->numberBetween(0, 9)),
                ];
            }
            foreach (ITradeReportRatioEnum::AmountRatios as $ratio) {
                $cityRatios[] = [
                    'id'             => Uuid::uuid4(),
                    'city_id'        => $cityId,
                    'report_type_id' => IReportTypeEnum::ReportTypeTrade,
                    'ratio_id'       => $ratio,
                    'date'           => $dateStart->format('Y-m-d'),
                    'value'          => (float)($faker->numberBetween(500, 2500) . '.' . $faker->numberBetween(0, 9)),
                ];
            }
        }

        ReportCityRatio::insert($cityRatios);

    }
}
