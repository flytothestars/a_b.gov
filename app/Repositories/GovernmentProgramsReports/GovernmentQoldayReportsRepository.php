<?php

namespace App\Repositories\GovernmentProgramsReports;

use App\Contracts\GovernmentProgramsReports\IReportQolday;
use App\Contracts\GovernmentProgramsReports\IReportFieldsTypes;
use App\Contracts\GovernmentProgramsReports\IReportStatuses;
use App\Models\Report\GovernmentProgram\GovernmentQoldayReport;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GovernmentQoldayReportsRepository extends BaseReportRepository
    implements IGovernmentQoldayReportsRepositoryContract
{
    public function __construct(
        GovernmentQoldayReport $model
    )
    {
        parent::__construct($model);
    }

    final public function getReportRecords(string $id): Collection
    {
        return $this
            ->query()
            ->where(IReportQolday::ReportId, $id)
            ->get()
            ;
    }

    final public function getReportRecordsFailed(string $id): array
    {
        return $this
            ->query()
            ->where(IReportQolday::ReportId, $id)
            ->where(IReportQolday::Status, IReportStatuses::ImportFailed)
            ->get()
            ->map(
                function ($item)
                {
                    $record                            = $item
                        ->only(IReportQolday::ReportTableFields);
                    $record[ IReportQolday::Id ]       = $item->id;
                    $record[ IReportQolday::ReportId ] = $item->report_id;

                    return $record;
                }
            )
            ->toArray()
            ;

    }

    final public function getReportRecordsProcessed(string $id): array
    {
        return $this
            ->query()
            ->where(IReportQolday::ReportId, $id)
            ->where(IReportQolday::Status, '!=', IReportStatuses::ImportFailed)
            ->get()
            ->map(
                function ($item)
                {
                    $record                            = $item
                        ->only(IReportQolday::ReportTableFields);
                    $record[ IReportQolday::Id ]       = $item->id;
                    $record[ IReportQolday::ReportId ] = $item->report_id;

                    return $record;
                }
            )
            ->toArray()
            ;
    }

    final public function getReportHeaders(): array
    {
        $headers = [];

        foreach (IReportQolday::ReportTableFields as $field) {
            $headers[] = [
                'text'     => trans(IReportQolday::ReportFileFieldsNames[ $field ]),
                'align'    => 'start',
                'sortable' => true,
                'value'    => $field,
            ];
        }

        $headers[] = [
            'text'     => trans('messages.reports.actions'),
            'align'    => 'start',
            'sortable' => false,
            'value'    => 'actions',
        ];

        return $headers;
    }

    final public function getReportRowFields(): array
    {
        return [
            [
                'field'    => IReportQolday::Id,
                'visible'  => false,
                'editable' => false,
                'type'     => IReportFieldsTypes::TypeInfo,
            ],
            [
                'field'    => IReportQolday::ReportId,
                'visible'  => false,
                'editable' => false,
                'type'     => IReportFieldsTypes::TypeInfo,
            ],
            [
                'field'    => IReportQolday::IsEdited,
                'editable' => false,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeInfo,
                'title'    => trans('messages.reports.isEdited'),
            ],
            [
                'field'    => IReportQolday::LastEditorId,
                'editable' => false,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeInfo,
                'title'    => trans('messages.reports.editor'),
            ],
            [
                'field'    => IReportQolday::NumberOfConsultations,
                'editable' => false,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeInteger,
                'title'    => trans('messages.reports.government.fields.Qolday.NumberOfConsultations'),
            ],
            [
                'field'    => IReportQolday::DevelopedPlans,
                'editable' => false,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeInteger,
                'title'    => trans('messages.reports.government.fields.Qolday.DevelopedPlans'),
            ],
            [
                'field'    => IReportQolday::AccompaniedProjects,
                'editable' => false,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeInteger,
                'title'    => trans('messages.reports.government.fields.Qolday.AccompaniedProjects'),
            ],
            [
                'field'    => IReportQolday::SumOfProjects,
                'editable' => false,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeInteger,
                'title'    => trans('messages.reports.government.fields.Qolday.SumOfProjects'),
            ],
            [
                'field'    => IReportQolday::PermitsReceived,
                'editable' => false,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeInteger,
                'title'    => trans('messages.reports.government.fields.Qolday.PermitsReceived'),
            ],
            [
                'field'    => IReportQolday::NumberOfListeners,
                'editable' => false,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeInteger,
                'title'    => trans('messages.reports.government.fields.Qolday.NumberOfListeners'),
            ],
        ];
    }

    final public function getReportRowData(int $id): array
    {
        $record = GovernmentQoldayReport::find($id);

        $data = $record->toArray();

        $data[ IReportQolday::LastEditorId ] = optional($record->editor)->name ?? 'Нет';
        $data[ IReportQolday::IsEdited ]     = $record->is_edited
            ? 'Да'
            : 'Нет';

        return $data;
    }

    final public function updateReportRow(array $data): Model
    {
        $editData = Arr::except(
            $data,
            [
                IReportQolday::LastEditorId,
                IReportQolday::IsEdited,
                IReportQolday::Id,
            ]
        );

        $editData[ IReportQolday::LastEditorId ] = optional(Auth::user())->id;
        $editData[ IReportQolday::IsEdited ]     = true;

        return $this
            ->update(
                $data[ IReportQolday::Id ],
                $editData
            );
    }

    final public function hasFailedRecords(string $report_id): bool
    {
        return GovernmentQoldayReport
                   ::where(IReportQolday::ReportId, $report_id)
                   ->whereNotNull(IReportQolday::LastFailComment)
                   ->count() > 0;
    }

    final public function getByParent(string $report_id): array
    {
        $records = GovernmentQoldayReport
            ::where(IReportQolday::ReportId, $report_id)
            ->first()
        ;

        $reportRow = $records
            ->only(
                [
                    IReportQolday::NumberOfConsultations,
                    IReportQolday::DevelopedPlans,
                    IReportQolday::AccompaniedProjects,
                    IReportQolday::SumOfProjects,
                    IReportQolday::PermitsReceived,
                    IReportQolday::NumberOfListeners,
                ]
            );

        return [
            'consultation_count'  => $reportRow[ IReportQolday::NumberOfConsultations ],
            'plans_developed'     => $reportRow[ IReportQolday::DevelopedPlans ],
            'plans_accompanied'   => $reportRow[ IReportQolday::AccompaniedProjects ],
            'sum'                 => $reportRow[ IReportQolday::SumOfProjects ],
            'documents_taked'     => $reportRow[ IReportQolday::PermitsReceived ],
            'number_of_listeners' => $reportRow[ IReportQolday::NumberOfListeners ],
        ];
    }

    final public function getFileInfo(): array
    {
        return [
            'file'   => '/reports/government-programs/Qoldau.mrt',
            'source' => 'Qoldau',
        ];
    }

    final public function validateReportRecord(
        Model $record
    ): \Illuminate\Contracts\Validation\Validator
    {
        $data = $record->toArray();

        $validator = $this->makeReportRecordValidator($data);

        if ($validator->fails()) {
            $failMessage = '<ul>';
            $messages    = $validator->errors()
                                     ->getMessages()
            ;
            foreach ($messages as $field => $fails) {
                if (array_key_exists($field, IReportQolday::ReportFileFieldsNames)) {
                    $fieldName = trans(IReportQolday::ReportFileFieldsNames[ $field ]);
                } else {
                    $fieldName = $field;
                }

                $failMessage .= "<li>$fieldName: ";
                $failMessage .= implode(' | ', $fails);
                $failMessage .= '</li>';
            }
            $failMessage               .= '</ul>';
            $record->status            = IReportStatuses::ImportFailed;
            $record->last_fail_comment = $failMessage;
            $record->save();
        } else {
            $record->status            = IReportStatuses::Finished;
            $record->last_fail_comment = null;
            $record->save();
        }

        return $validator;
    }

    final public function makeReportRecordValidator(array $data): \Illuminate\Contracts\Validation\Validator
    {
        $validations = [
            IReportQolday::NumberOfConsultations => 'required|numeric',
            IReportQolday::DevelopedPlans        => 'required|numeric',
            IReportQolday::AccompaniedProjects   => 'required|numeric',
            IReportQolday::SumOfProjects         => 'required|numeric',
            IReportQolday::PermitsReceived       => 'required|numeric',
            IReportQolday::NumberOfListeners     => 'required|numeric',
        ];

        return Validator::make(
            $data,
            $validations,
        );
    }


}
