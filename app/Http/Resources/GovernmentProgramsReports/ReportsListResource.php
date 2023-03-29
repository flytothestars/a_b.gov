<?php

namespace App\Http\Resources\GovernmentProgramsReports;

use App\Contracts\GovernmentProgramsReports\IReportsHeaders;
use App\Contracts\GovernmentProgramsReports\IReportStatuses;
use App\Contracts\GovernmentProgramsReports\IReportTypes;
use Illuminate\Http\Resources\Json\JsonResource;

class ReportsListResource extends JsonResource
{
    final public function toArray($request): array
    {
        $data = $this->resource;

        $response = [];

        foreach (IReportTypes::ReportTypesList as $type) {
            $name = trans(IReportTypes::ReportTypesNames[ $type ]);

            $report = $data->where(IReportsHeaders::ReportType, $type)
                           ->first()
            ;

            $statusName = trans('messages.reports.government.statuses.none');

            if (optional($report)->status) {
                $statusName = trans(IReportStatuses::StatusNamesList[ optional($report)->status ]);
            }

            $reportRow = [
                'type'       => $type,
                'name'       => $name,
                'exists'     => !is_null($report),
                'id'         => optional($report)->id,
                'status'     => optional($report)->status,
                'lastError'  => optional($report)->last_fail_comment ?? 'Нет',
                'statusName' => $statusName,
            ];

            if($type === IReportTypes::TypeQolday && $report)
            {
                $reportRow [ 'childId' ] = optional($report->qoldayReport)->id;
            }

            $response[] = $reportRow;
        }

        return $response;
    }

}
