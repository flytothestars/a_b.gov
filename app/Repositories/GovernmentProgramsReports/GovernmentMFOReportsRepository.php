<?php

namespace App\Repositories\GovernmentProgramsReports;

use App\Contracts\GovernmentProgramsReports\IReportDKBSubsidiesSimpleThings;
use App\Contracts\GovernmentProgramsReports\IReportAlmatyBusinessMFO;
use App\Contracts\GovernmentProgramsReports\IReportFieldsTypes;
use App\Contracts\GovernmentProgramsReports\IReportStatuses;
use App\Models\District;
use App\Models\GovernmentReportCommonRatio;
use App\Models\Report\GovernmentProgram\GovernmentBusinessMFOReport;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GovernmentMFOReportsRepository extends BaseReportRepository
    implements IGovernmentMFOReportsRepositoryContract
{
    public function __construct(
        GovernmentBusinessMFOReport $model
    )
    {
        parent::__construct($model);
    }

    final public function getReportRecords(string $id): Collection
    {
        return $this
            ->query()
            ->where(IReportAlmatyBusinessMFO::ReportId, $id)
            ->get()
            ;
    }

    final public function getReportRecordsFailed(string $id): array
    {
        return $this
            ->query()
            ->with([ 'district' ])
            ->where(IReportAlmatyBusinessMFO::ReportId, $id)
            ->where(IReportAlmatyBusinessMFO::Status, IReportStatuses::ImportFailed)
            ->get()
            ->map(
                function ($item)
                {
                    $record                                       = $item
                        ->only(IReportAlmatyBusinessMFO::ReportTableFields);
                    $record[ IReportAlmatyBusinessMFO::Id ]       = $item->id;
                    $record[ IReportAlmatyBusinessMFO::ReportId ] = $item->report_id;
                    $record[ IReportAlmatyBusinessMFO::Place ]    = optional($item->district)->name;

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
            ->with([ 'district' ])
            ->where(IReportAlmatyBusinessMFO::ReportId, $id)
            ->where(IReportAlmatyBusinessMFO::Status, '!=', IReportStatuses::ImportFailed)
            ->get()
            ->map(
                function ($item)
                {
                    $record                                       = $item
                        ->only(IReportAlmatyBusinessMFO::ReportTableFields);
                    $record[ IReportAlmatyBusinessMFO::Id ]       = $item->id;
                    $record[ IReportAlmatyBusinessMFO::ReportId ] = $item->report_id;
                    $record[ IReportAlmatyBusinessMFO::Place ]    = optional($item->district)->name;

                    return $record;
                }
            )
            ->toArray()
            ;
    }

    final public function getReportHeaders(): array
    {
        $headers = [];

        foreach (IReportAlmatyBusinessMFO::ReportTableFields as $field) {
            $headers[] = [
                'text'     => trans(IReportAlmatyBusinessMFO::ReportFileFieldsNames[ $field ]),
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
                'field'    => IReportAlmatyBusinessMFO::Id,
                'visible'  => false,
                'editable' => false,
                'type'     => IReportFieldsTypes::TypeInfo,
            ],
            [
                'field'    => IReportAlmatyBusinessMFO::ReportId,
                'visible'  => false,
                'editable' => false,
                'type'     => IReportFieldsTypes::TypeInfo,
            ],
            [
                'field'    => IReportAlmatyBusinessMFO::CompanyUserId,
                'editable' => false,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeInfo,
                'title'    => trans('messages.reports.user'),
            ],
            [
                'field'    => IReportAlmatyBusinessMFO::IsEdited,
                'editable' => false,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeInfo,
                'title'    => trans('messages.reports.isEdited'),
            ],
            [
                'field'    => IReportAlmatyBusinessMFO::LastEditorId,
                'editable' => false,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeInfo,
                'title'    => trans('messages.reports.editor'),
            ],
            [
                'field'    => IReportAlmatyBusinessMFO::Number,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.MFO.Number'),
            ],
            [
                'field'    => IReportAlmatyBusinessMFO::Name,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.MFO.Name'),
            ],
            [
                'field'    => IReportAlmatyBusinessMFO::CompanyBinIin,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.MFO.CompanyBinIin'),
            ],
            [
                'field'    => IReportAlmatyBusinessMFO::CurrentActivity,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.MFO.CurrentActivity'),
            ],
            [
                'field'    => IReportAlmatyBusinessMFO::PlannedTypeOfActivity,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.MFO.PlannedTypeOfActivity'),
            ],
            [
                'field'    => IReportAlmatyBusinessMFO::ProgramDistrictId,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeSelect,
                'title'    => trans('messages.reports.government.fields.MFO.Place'),
                'options'  => District
                    ::all()
                    ->map(
                        function ($item)
                        {
                            return [
                                'id'   => $item->name,
                                'name' => $item->name,
                            ];
                        }
                    ),
            ],
            [
                'field'    => IReportAlmatyBusinessMFO::LimitAmount,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeFloat,
                'title'    => trans('messages.reports.government.fields.MFO.LimitAmount'),
            ],
            [
                'field'    => IReportAlmatyBusinessMFO::WorkPlace,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeInteger,
                'title'    => trans('messages.reports.government.fields.MFO.WorkPlace'),
            ],
            [
                'field'    => IReportAlmatyBusinessMFO::Tax,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeFloat,
                'title'    => trans('messages.reports.government.fields.MFO.tax'),
            ],
        ];
    }

    final public function getReportRowData(int $id): array
    {
        $record = GovernmentBusinessMFOReport::find($id);

        $data = $record->toArray();

        $data[ IReportAlmatyBusinessMFO::CompanyUserId ] = optional($record->client)->name ?? 'Не определен';
        $data[ IReportAlmatyBusinessMFO::LastEditorId ]  = optional($record->editor)->name ?? 'Нет';
        $data[ IReportAlmatyBusinessMFO::IsEdited ]      = $record->is_edited
            ? 'Да'
            : 'Нет';

        return $data;
    }

    final public function updateReportRow(array $data): Model
    {
        $editData = Arr::except(
            $data,
            [
                IReportAlmatyBusinessMFO::CompanyUserId,
                IReportAlmatyBusinessMFO::LastEditorId,
                IReportAlmatyBusinessMFO::IsEdited,
                IReportAlmatyBusinessMFO::Id,
            ]
        );

        $editData[ IReportAlmatyBusinessMFO::LastEditorId ] = optional(Auth::user())->id;
        $editData[ IReportAlmatyBusinessMFO::IsEdited ]     = true;

        return $this
            ->update(
                $data[ IReportAlmatyBusinessMFO::Id ],
                $editData
            );
    }

    final public function hasFailedRecords(string $report_id): bool
    {
        return GovernmentBusinessMFOReport
                   ::where(IReportAlmatyBusinessMFO::ReportId, $report_id)
                   ->whereNotNull(IReportAlmatyBusinessMFO::LastFailComment)
                   ->count() > 0;
    }

    final public function getByParent(string $report_id): array
    {
        $records = GovernmentBusinessMFOReport
            ::where(IReportAlmatyBusinessMFO::ReportId, $report_id)
            ->get()
        ;

        $report = $records
            ->map(
                function ($item)
                {
                    $item = $item
                        ->only(
                            [
                                IReportAlmatyBusinessMFO::LimitAmount,
                                IReportAlmatyBusinessMFO::Place,
                                IReportAlmatyBusinessMFO::WorkPlace,
                                IReportAlmatyBusinessMFO::CurrentActivity,
                                IReportAlmatyBusinessMFO::PlannedTypeOfActivity,
                            ]
                        );

                    return $item;
                }
            )
            ->toArray()
        ;

        $commonRatiosRow = [];
        $commonRatios = GovernmentReportCommonRatio::where('report_id', $report_id)->get();
        foreach ($commonRatios as $ratio)
        {
            $commonRatiosRow[$ratio->report_ratio] = $ratio->value;
        }
        if(count($commonRatiosRow) && count($report))
        {
            $lastRowKey = array_key_last($report);
            $lastRow = array_merge($commonRatiosRow, $report[$lastRowKey]);
            $report[$lastRowKey] = $lastRow;
        }

        return $report;
    }

    final public function getFileInfo(): array
    {
        return [
            'file'   => '/reports/government-programs/AlmatyBusinessMFO.mrt',
            'source' => 'Almaty_Business_MFO',
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
                if ($field === IReportAlmatyBusinessMFO::ProgramDistrictId) {
                    $fieldName = trans(
                        IReportAlmatyBusinessMFO::ReportFileFieldsNames[ IReportAlmatyBusinessMFO::Place ]
                    );
                } elseif (array_key_exists($field, IReportAlmatyBusinessMFO::ReportFileFieldsNames)) {
                    $fieldName = trans(IReportAlmatyBusinessMFO::ReportFileFieldsNames[ $field ]);
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
            IReportAlmatyBusinessMFO::LimitAmount           => 'required|numeric',
            IReportAlmatyBusinessMFO::ProgramDistrictId     => 'required|uuid|exists:districts,id',
            IReportAlmatyBusinessMFO::WorkPlace             => 'nullable|numeric',
            IReportAlmatyBusinessMFO::CurrentActivity       => 'required|string',
            IReportAlmatyBusinessMFO::PlannedTypeOfActivity => 'required|string',
        ];

        return Validator::make(
            $data,
            $validations,
            [
                IReportDKBSubsidiesSimpleThings::ProgramDistrictId . '.required' => 'Поле введено не корректно.',
                IReportDKBSubsidiesSimpleThings::ProgramDistrictId . '.uuid'     => 'Не определен район.',
            ]
        );
    }


}
