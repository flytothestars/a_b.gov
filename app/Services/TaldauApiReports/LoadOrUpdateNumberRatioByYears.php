<?php

namespace App\Services\TaldauApiReports;

use App\Contracts\Taldau\ITaldauApiUrlContract;
use App\Exceptions\Report\InvalidTaldauUrlException;
use App\Models\Report\ReportCityRatio;
use App\Models\Report\ReportDistrictRatio;
use App\Models\Taldau\TaldauApiUrl;
use App\Repositories\Enums\Reports\Ser\IIndustryRatioReport;
use phpDocumentor\Reflection\Types\Self_;

class LoadOrUpdateNumberRatioByYears
{

    private IReportRatioClient                        $client;
    private SearchByFieldReportTransformer            $searchByFieldReportTransformer;
    private GroupByFieldDistrictTransformer           $groupByFieldDistrictTransformer;
    private RowToYearsRatioValuesTransformer          $rowToYearsRatioValuesTransformer;
    private RowToYearsRatioValuesSecondaryTransformer $rowToYearsRatioValuesSecondaryTransformer;
    private YearRatioValuesToRatioTransformer         $ratioValuesToRatioTransformer;

    private const SecondaryRatioList = [
    ];

    /**
     * LoadOrUpdateNumberRatioByYears constructor.
     *
     * @param IReportRatioClient                        $client
     * @param SearchByFieldReportTransformer            $searchByFieldReportTransformer
     * @param GroupByFieldDistrictTransformer           $groupByFieldDistrictTransformer
     * @param RowToYearsRatioValuesTransformer          $rowToYearsRatioValuesTransformer
     * @param RowToYearsRatioValuesSecondaryTransformer $rowToYearsRatioValuesSecondaryTransformer
     * @param YearRatioValuesToRatioTransformer         $ratioValuesToRatioTransformer
     */
    public function __construct(
        IReportRatioClient $client,
        SearchByFieldReportTransformer $searchByFieldReportTransformer,
        GroupByFieldDistrictTransformer $groupByFieldDistrictTransformer,
        RowToYearsRatioValuesTransformer $rowToYearsRatioValuesTransformer,
        RowToYearsRatioValuesSecondaryTransformer $rowToYearsRatioValuesSecondaryTransformer,
        YearRatioValuesToRatioTransformer $ratioValuesToRatioTransformer
    )
    {
        $this->client                                    = $client;
        $this->searchByFieldReportTransformer            = $searchByFieldReportTransformer;
        $this->groupByFieldDistrictTransformer           = $groupByFieldDistrictTransformer;
        $this->rowToYearsRatioValuesTransformer          = $rowToYearsRatioValuesTransformer;
        $this->rowToYearsRatioValuesSecondaryTransformer = $rowToYearsRatioValuesSecondaryTransformer;
        $this->ratioValuesToRatioTransformer             = $ratioValuesToRatioTransformer;
    }

    final public function loadOrUpdateCityRatio(string $city_id, int $report_type_id, string $report_ratio_id): void
    {
        $urlRecord = TaldauApiUrl
            ::where(ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID, $report_type_id)
            ->where(ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID, $report_ratio_id)
            ->first()
        ;

        if (!$urlRecord) {
            throw new InvalidTaldauUrlException(
                "api url for report type id '$report_type_id' ratio id '$report_ratio_id' not exists"
            );
        }

        $response = $this->client->fetchReportRatio($urlRecord->url);

        $row = $this->searchByFieldReportTransformer->transform($response);

        if (in_array($report_ratio_id, self::SecondaryRatioList, true)) {
            $rowRatios = $this->rowToYearsRatioValuesSecondaryTransformer->transform($row);
        } else {
            $rowRatios = $this->rowToYearsRatioValuesTransformer->transform($row);
        }

        $ratios = $this->ratioValuesToRatioTransformer->transform(
            $city_id,
            $urlRecord->report_type_id,
            $urlRecord->report_ratio_id,
            $rowRatios
        );

        foreach ($ratios as $ratio) {
            $query = ReportCityRatio
                ::where('city_id', $city_id)
                ->where('report_type_id', $urlRecord->report_type_id)
                ->where('ratio_id', $urlRecord->report_ratio_id)
                ->where('date', $ratio[ 'date' ])
            ;

            if ($query->exists()) {
                $query->update($ratio);
            } else {
                ReportCityRatio::create($ratio);
            }

        }
    }

    final public function loadOrUpdateDistrictRatio(string $city_id, int $report_type_id, string $report_ratio_id): void
    {
        $urlRecord = TaldauApiUrl
            ::where(ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID, $report_type_id)
            ->where(ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID, $report_ratio_id)
            ->first()
        ;

        if (!$urlRecord) {
            throw new InvalidTaldauUrlException(
                "api url for report type id '$report_type_id' ratio id '$report_ratio_id' not exists"
            );
        }

        $response = $this->client->fetchReportRatio($urlRecord->url);

        $rows = $this->groupByFieldDistrictTransformer->transform($response);

        $ratios = [];

        foreach ($rows as $row)
        {
            if (in_array($report_ratio_id, self::SecondaryRatioList, true)) {
                $rowRatios = $this->rowToYearsRatioValuesSecondaryTransformer->transform($row);
            } else {
                $rowRatios = $this->rowToYearsRatioValuesTransformer->transform($row);
            }

            $districtRatios = $this->ratioValuesToRatioTransformer->transform(
                $city_id,
                $urlRecord->report_type_id,
                $urlRecord->report_ratio_id,
                $rowRatios,
                $row['district_id']
            );

            /** @noinspection SlowArrayOperationsInLoopInspection */
            $ratios = array_merge($ratios, $districtRatios);
        }

        foreach ($ratios as $ratio) {
            $query = ReportDistrictRatio
                ::where('city_id', $city_id)
                ->where('report_type_id', $urlRecord->report_type_id)
                ->where('district_id', $ratio['district_id'])
                ->where('ratio_id', $urlRecord->report_ratio_id)
                ->where('date', $ratio[ 'date' ])
            ;

            if ($query->exists()) {
                $query->update($ratio);
            } else {
                ReportDistrictRatio::create($ratio);
            }

        }
    }

    final public function loadOrUpdateIndustryRatio(string $city_id, int $report_type_id, string $report_ratio_id, int $industryId): void
    {
        $urlRecord = TaldauApiUrl
            ::where(ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID, $report_type_id)
            ->where(ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID, $report_ratio_id)
            ->first()
        ;

        if (!$urlRecord) {
            throw new InvalidTaldauUrlException(
                "api url for report type id '$report_type_id' ratio id '$report_ratio_id' not exists"
            );
        }

        $response = $this->client->fetchReportRatio($urlRecord->url);

        $row = $this->searchByFieldReportTransformer->transform($response, $industryId, 'id');

        if (in_array($report_ratio_id, self::SecondaryRatioList, true)) {
            $rowRatios = $this->rowToYearsRatioValuesSecondaryTransformer->transform($row);
        } else {
            $rowRatios = $this->rowToYearsRatioValuesTransformer->transform($row);
        }

        $ratios = $this->ratioValuesToRatioTransformer->transform(
            $city_id,
            $urlRecord->report_type_id,
            $urlRecord->report_ratio_id,
            $rowRatios
        );

        foreach ($ratios as $ratio) {
            $query = ReportCityRatio
                ::where('city_id', $city_id)
                ->where('report_type_id', $urlRecord->report_type_id)
                ->where('ratio_id', $urlRecord->report_ratio_id)
                ->where('date', $ratio[ 'date' ])
            ;

            if ($query->exists()) {
                $query->update($ratio);
            } else {
                ReportCityRatio::create($ratio);
            }

        }
    }

}
