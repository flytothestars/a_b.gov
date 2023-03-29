<?php

namespace App\Repositories\GovernmentProgramsReports;

use App\Contracts\GovernmentProgramsReports\IReportEnbek;
use App\Contracts\GovernmentProgramsReports\IReportFieldsTypes;
use App\Contracts\GovernmentProgramsReports\IReportStatuses;
use App\Models\City;
use App\Models\District;
use App\Models\GovernmentReportCommonRatio;
use App\Models\Report\GovernmentProgram\GovernmentEnbekReport;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class GovernmentEnbekReportsRepository extends BaseReportRepository
    implements IGovernmentEnbekReportsRepositoryContract
{
    public function __construct(
        GovernmentEnbekReport $model
    )
    {
        parent::__construct($model);
    }

    final public function getReportRecords(string $id): Collection
    {
        return $this
            ->query()
            ->where(IReportEnbek::ReportId, $id)
            ->get()
            ;
    }

    final public function getReportRecordsFailed(string $id): array
    {
        return $this
            ->query()
            ->with([ 'district' ])
            ->where(IReportEnbek::ReportId, $id)
            ->where(IReportEnbek::Status, IReportStatuses::ImportFailed)
            ->get()
            ->map(
                function ($item)
                {
                    $record                                    = $item
                        ->only(IReportEnbek::ReportTableFields);
                    $record[ IReportEnbek::Id ]                = $item->id;
                    $record[ IReportEnbek::ReportId ]          = $item->report_id;
                    $record[ IReportEnbek::ProgramDistrictId ] = optional($item->district)[ 'name' ] ?? null;

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
            ->where(IReportEnbek::ReportId, $id)
            ->where(IReportEnbek::Status, '!=', IReportStatuses::ImportFailed)
            ->get()
            ->map(
                function ($item)
                {
                    $record                                    = $item
                        ->only(IReportEnbek::ReportTableFields);
                    $record[ IReportEnbek::Id ]                = $item->id;
                    $record[ IReportEnbek::ReportId ]          = $item->report_id;
                    $record[ IReportEnbek::ProgramDistrictId ] = optional($item->district)[ 'name' ] ?? null;

                    return $record;
                }
            )
            ->toArray()
            ;
    }

    final public function getReportHeaders(): array
    {
        $headers = [];

        foreach (IReportEnbek::ReportTableFields as $field) {
            $headers[] = [
                'text'     => trans(IReportEnbek::ReportFileFieldsNames[ $field ]),
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
                'field'    => IReportEnbek::Id,
                'visible'  => false,
                'editable' => false,
                'type'     => IReportFieldsTypes::TypeInfo,
            ],
            [
                'field'    => IReportEnbek::ReportId,
                'visible'  => false,
                'editable' => false,
                'type'     => IReportFieldsTypes::TypeInfo,
            ],
            [
                'field'    => IReportEnbek::CompanyUserId,
                'editable' => false,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeInfo,
                'title'    => trans('messages.reports.user'),
            ],
            [
                'field'    => IReportEnbek::IsEdited,
                'editable' => false,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeInfo,
                'title'    => trans('messages.reports.isEdited'),
            ],
            [
                'field'    => IReportEnbek::LastEditorId,
                'editable' => false,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeInfo,
                'title'    => trans('messages.reports.editor'),
            ],
            [
                'field'    => IReportEnbek::Number,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.Enbek.Number'),
            ],
            [
                'field'    => IReportEnbek::STB,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.Enbek.STB'),
            ],
            [
                'field'    => IReportEnbek::Source,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.Enbek.Source'),
            ],
            [
                'field'    => IReportEnbek::CompanyBinIin,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.Enbek.CompanyBinIin'),
            ],
            [
                'field'    => IReportEnbek::Borrower,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.Enbek.Borrower'),
            ],
            [
                'field'    => IReportEnbek::Amount,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeFloat,
                'title'    => trans('messages.reports.government.fields.Enbek.Amount'),
            ],
            [
                'field'    => IReportEnbek::Target,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.Enbek.Target'),
            ],
            [
                'field'    => IReportEnbek::TypeOfActivityIndustry,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.Enbek.TypeOfActivityIndustry'),
            ],
            [
                'field'    => IReportEnbek::ProgramDistrictId,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeSelect,
                'title'    => trans('messages.reports.government.fields.Enbek.ADistrictOfTheCity'),
                'options'  => District
                    ::all()
                    ->map(
                        function ($item)
                        {
                            return [
                                'id'   => $item->id,
                                'name' => $item->name,
                            ];
                        }
                    ),
            ],
            [
                'field'    => IReportEnbek::WorkplacesActual,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeInteger,
                'title'    => trans('messages.reports.government.fields.Enbek.WorkplacesActual'),
            ],
            [
                'field'    => IReportEnbek::JobsCreated,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeInteger,
                'title'    => trans('messages.reports.government.fields.Enbek.JobsCreated'),
            ],
            [
                'field'    => IReportEnbek::StartUp,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.Enbek.StartUp'),
            ],
            [
                'field'    => IReportEnbek::ProjectStatus,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeSelect,
                'title'    => trans(
                    'messages.reports.government.fields.Enbek.ProjectStatus'
                ),
                'options'  => [
                    [
                        'id'   => 'выдан',
                        'name' => 'выдан',
                    ],
                    [
                        'id'   => 'одобрен',
                        'name' => 'одобрен',
                    ],
                    [
                        'id'   => 'утвержден',
                        'name' => 'утвержден',
                    ],
                    [
                        'id'   => 'на рассмотрении',
                        'name' => 'на рассмотрении',
                    ],
                    [
                        'id'   => 'сбор документов',
                        'name' => 'сбор документов',
                    ],
                ],
            ],
            [
                'field'    => IReportEnbek::Guarantees,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeFloat,
                'title'    => trans('messages.reports.government.fields.Enbek.Guarantees'),
            ],
            [
                'field'    => IReportEnbek::Tax,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeFloat,
                'title'    => trans('messages.reports.government.fields.Enbek.tax'),
            ],
        ];
    }

    final public function getReportRowData(int $id): array
    {
        $record = GovernmentEnbekReport::find($id);

        $data = $record->toArray();

        $data[ IReportEnbek::CompanyUserId ] = optional($record->client)->name ?? 'Не определен';
        $data[ IReportEnbek::LastEditorId ]  = optional($record->editor)->name ?? 'Нет';
        $data[ IReportEnbek::IsEdited ]      = $record->is_edited
            ? 'Да'
            : 'Нет';

        return $data;
    }

    final public function updateReportRow(array $data): Model
    {
        $editData = Arr::except(
            $data,
            [
                IReportEnbek::CompanyUserId,
                IReportEnbek::LastEditorId,
                IReportEnbek::IsEdited,
                IReportEnbek::Id,
            ]
        );

        $editData[ IReportEnbek::LastEditorId ] = optional(Auth::user())->id;
        $editData[ IReportEnbek::IsEdited ]     = true;

        return $this
            ->update(
                $data[ IReportEnbek::Id ],
                $editData
            );
    }

    final public function hasFailedRecords(string $report_id): bool
    {
        return GovernmentEnbekReport
                   ::where(IReportEnbek::ReportId, $report_id)
                   ->whereNotNull(IReportEnbek::LastFailComment)
                   ->count() > 0;
    }

    private function formatTarget(string $target): string
    {
        $targetStr = Str::lower($target);

        if (strpos($targetStr, 'покупка') !== false) {
            return 'Покупка';
        }

        return 'ПОС';
    }

    final public function getByParent(string $report_id): array
    {
        $records = GovernmentEnbekReport
            ::where(IReportEnbek::ReportId, $report_id)
            ->get()
        ;

        $report = $records
            ->map(
                function ($item)
                {
                    $item = $item
                        ->only(
                            [
                                IReportEnbek::Amount,
                                IReportEnbek::ADistrictOfTheCity,
                                IReportEnbek::JobsCreated,
                                IReportEnbek::WorkplacesActual,
                                IReportEnbek::Target,
                                IReportEnbek::TypeOfActivityIndustry,
                                IReportEnbek::StartUp,
                            ]
                        );

                    $item[ IReportEnbek::Target ] = $this->formatTarget($item[ IReportEnbek::Target ]);

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
            'file'   => '/reports/government-programs/GosProgramsEnbek.mrt',
            'source' => 'Almaty_Enbek',
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
                if ($field === IReportEnbek::ProgramDistrictId) {
                    $fieldName = trans(
                        IReportEnbek::ReportFileFieldsNames[ IReportEnbek::ADistrictOfTheCity ]
                    );
                } elseif (array_key_exists($field, IReportEnbek::ReportFileFieldsNames)) {
                    $fieldName = trans(IReportEnbek::ReportFileFieldsNames[ $field ]);
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
            IReportEnbek::Amount                 => 'required|numeric',
            IReportEnbek::ProgramDistrictId      => 'required|uuid|exists:districts,id',
            IReportEnbek::JobsCreated            => 'nullable|integer',
            IReportEnbek::WorkplacesActual       => 'nullable|integer',
            IReportEnbek::Target                 => 'required|string',
            IReportEnbek::TypeOfActivityIndustry => 'required|string',
            IReportEnbek::StartUp                => 'required|string',
        ];

        return Validator::make(
            $data,
            $validations,
            [
                IReportEnbek::ProgramDistrictId . '.required_unless' => 'Поле введено не корректно.',
                IReportEnbek::ProgramDistrictId . '.required'        => 'Поле введено не корректно.',
                IReportEnbek::ProgramDistrictId . '.uuid'            => 'Не определен район.',
            ]
        );
    }


}
