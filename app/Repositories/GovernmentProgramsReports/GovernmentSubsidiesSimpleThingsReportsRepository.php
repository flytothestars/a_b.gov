<?php

namespace App\Repositories\GovernmentProgramsReports;

use App\Contracts\GovernmentProgramsReports\IReportDKBSubsidiesSimpleThings;
use App\Contracts\GovernmentProgramsReports\IReportFieldsTypes;
use App\Contracts\GovernmentProgramsReports\IReportStatuses;
use App\Models\District;
use App\Models\GovernmentReportCommonRatio;
use App\Models\Report\GovernmentProgram\GovernmentSimpleThingsReports;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class GovernmentSubsidiesSimpleThingsReportsRepository extends BaseReportRepository
    implements IGovernmentSubsidiesSimpleThingsReportsRepositoryContract
{
    public function __construct(
        GovernmentSimpleThingsReports $model
    )
    {
        parent::__construct($model);
    }

    final public function getReportRecords(string $id): Collection
    {
        return $this
            ->query()
            ->where(IReportDKBSubsidiesSimpleThings::ReportId, $id)
            ->get()
            ;
    }

    final public function getReportRecordsFailed(string $id): array
    {
        return $this
            ->query()
            ->with([ 'district' ])
            ->where(IReportDKBSubsidiesSimpleThings::ReportId, $id)
            ->where(IReportDKBSubsidiesSimpleThings::Status, IReportStatuses::ImportFailed)
            ->get()
            ->map(
                function ($item)
                {
                    $record                                              = $item
                        ->only(IReportDKBSubsidiesSimpleThings::ReportTableFields);
                    $record[ IReportDKBSubsidiesSimpleThings::District ] = optional($item->district)[ 'name' ] ?? null;
                    $record[ IReportDKBSubsidiesSimpleThings::Id ]       = $item->id;
                    $record[ IReportDKBSubsidiesSimpleThings::ReportId ] = $item->report_id;
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
            ->where(IReportDKBSubsidiesSimpleThings::ReportId, $id)
            ->where(IReportDKBSubsidiesSimpleThings::Status, '!=', IReportStatuses::ImportFailed)
            ->get()
            ->map(
                function ($item)
                {
                    $record                                              = $item
                        ->only(IReportDKBSubsidiesSimpleThings::ReportTableFields);
                    $record[ IReportDKBSubsidiesSimpleThings::District ] = optional($item->district)[ 'name' ] ?? null;
                    $record[ IReportDKBSubsidiesSimpleThings::Id ]       = $item->id;
                    $record[ IReportDKBSubsidiesSimpleThings::ReportId ] = $item->report_id;
                    return $record;
                }
            )
            ->toArray()
            ;
    }

    final public function getReportHeaders(): array
    {
        $headers = [];

        foreach (IReportDKBSubsidiesSimpleThings::ReportTableFields as $field) {
            $headers[] = [
                'text'     => trans(IReportDKBSubsidiesSimpleThings::ReportFileFieldsNames[ $field ]),
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
                'field'    => IReportDKBSubsidiesSimpleThings::Id,
                'visible'  => false,
                'editable' => false,
                'type'     => IReportFieldsTypes::TypeInfo,
            ],
            [
                'field'    => IReportDKBSubsidiesSimpleThings::ReportId,
                'visible'  => false,
                'editable' => false,
                'type'     => IReportFieldsTypes::TypeInfo,
            ],
            [
                'field'    => IReportDKBSubsidiesSimpleThings::CompanyUserId,
                'editable' => false,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeInfo,
                'title'    => trans('messages.reports.user'),
            ],
            [
                'field'    => IReportDKBSubsidiesSimpleThings::IsEdited,
                'editable' => false,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeInfo,
                'title'    => trans('messages.reports.isEdited'),
            ],
            [
                'field'    => IReportDKBSubsidiesSimpleThings::LastEditorId,
                'editable' => false,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeInfo,
                'title'    => trans('messages.reports.editor'),
            ],
            [
                'field'    => IReportDKBSubsidiesSimpleThings::Number,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.Subsidies.Number'),
            ],
            [
                'field'    => IReportDKBSubsidiesSimpleThings::STBName,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.Subsidies.STBName'),
            ],
            [
                'field'    => IReportDKBSubsidiesSimpleThings::EntrepreneurSName,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.Subsidies.EntrepreneurSName'),
            ],
            [
                'field'    => IReportDKBSubsidiesSimpleThings::CompanyBinIin,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.Subsidies.CompanyBinIin'),
            ],
            [
                'field'    => IReportDKBSubsidiesSimpleThings::SubjectSize,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.Subsidies.SubjectSize'),
            ],
            [
                'field'    => IReportDKBSubsidiesSimpleThings::ProgramDistrictId,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeSelect,
                'title'    => trans('messages.reports.government.fields.Subsidies.District'),
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
                'field'    => IReportDKBSubsidiesSimpleThings::CreditAmount,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeFloat,
                'title'    => trans('messages.reports.government.fields.Subsidies.CreditAmount'),
            ],
            [
                'field'    => IReportDKBSubsidiesSimpleThings::LoanRate,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeFloat,
                'title'    => trans('messages.reports.government.fields.Subsidies.LoanRate'),
            ],
            [
                'field'    => IReportDKBSubsidiesSimpleThings::Subsidies,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeFloat,
                'title'    => trans('messages.reports.government.fields.Subsidies.Subsidies'),
            ],
            [
                'field'    => IReportDKBSubsidiesSimpleThings::TheAmountOfThePlannedSubsidyUntil,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeFloat,
                'title'    => trans('messages.reports.government.fields.Subsidies.TheAmountOfThePlannedSubsidyUntil'),
            ],
            [
                'field'    => IReportDKBSubsidiesSimpleThings::CurrentNumberOfWorkPlaces,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeInteger,
                'title'    => trans('messages.reports.government.fields.Subsidies.CurrentNumberOfWorkPlaces'),
            ],
            [
                'field'    => IReportDKBSubsidiesSimpleThings::NumberOfCreatedWorkplaces,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeInteger,
                'title'    => trans('messages.reports.government.fields.Subsidies.NumberOfCreatedWorkplaces'),
            ],
            [
                'field'    => IReportDKBSubsidiesSimpleThings::IndustryOfActivity,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.Subsidies.IndustryOfActivity'),
            ],
            [
                'field'    => IReportDKBSubsidiesSimpleThings::OKED,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.Subsidies.OKED'),
            ],
            [
                'field'    => IReportDKBSubsidiesSimpleThings::PurposeOfTheLoan,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.Subsidies.PurposeOfTheLoan'),
            ],
            [
                'field'    => IReportDKBSubsidiesSimpleThings::DirectionByProgram,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeSelect,
                'title'    => trans(
                    'messages.reports.government.fields.Subsidies.DirectionByProgram'
                ),
                'options'  => [
                    [
                        'id'   => '1',
                        'name' => '1',
                    ],
                    [
                        'id'   => '2',
                        'name' => '2',
                    ],
                    [
                        'id'   => '3',
                        'name' => '4',
                    ],
                    [
                        'id'   => 'Механизм',
                        'name' => 'Механизм',
                    ],
                ],
            ],
            [
                'field'    => IReportDKBSubsidiesSimpleThings::TheEssenceOfTheQuestionIsNewProlongation,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans(
                    'messages.reports.government.fields.Subsidies.TheEssenceOfTheQuestionIsNewProlongation'
                ),
            ],
            [
                'field'    => IReportDKBSubsidiesSimpleThings::dateOfRegistrationOfTheApplication,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeDate,
                'title'    => trans('messages.reports.government.fields.Subsidies.dateOfRegistrationOfTheApplication'),
            ],
            [
                'field'    => IReportDKBSubsidiesSimpleThings::ProtocolNumberOfTheFundMAPM,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.Subsidies.ProtocolNumberOfTheFundMAPM'),
            ],
            [
                'field'    => IReportDKBSubsidiesSimpleThings::dateOfTheMinutesOfTheFundMAPM,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeDate,
                'title'    => trans('messages.reports.government.fields.Subsidies.dateOfTheMinutesOfTheFundMAPM'),
            ],
            [
                'field'    => IReportDKBSubsidiesSimpleThings::ExpirationDateOfRKSFund,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeDate,
                'title'    => trans('messages.reports.government.fields.Subsidies.ExpirationDateOfRKSFund'),
            ],
            [
                'field'    => IReportDKBSubsidiesSimpleThings::DateOfSendingTheLetterToSTB,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeDate,
                'title'    => trans('messages.reports.government.fields.Subsidies.DateOfSendingTheLetterToSTB'),
            ],
            [
                'field'    => IReportDKBSubsidiesSimpleThings::YurCompanyAddress,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.Subsidies.YurCompanyAddress'),
            ],
            [
                'field'    => IReportDKBSubsidiesSimpleThings::FullNameOfTheHead,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.Subsidies.FullNameOfTheHead'),
            ],
            [
                'field'    => IReportDKBSubsidiesSimpleThings::Contacts,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.Subsidies.Contacts'),
            ],
            [
                'field'    => IReportDKBSubsidiesSimpleThings::Tax,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.Subsidies.tax'),
            ],
        ];
    }

    final public function getReportRowData(int $id): array
    {
        $record = GovernmentSimpleThingsReports::find($id);

        $data = $record->toArray();

        $data[ IReportDKBSubsidiesSimpleThings::CompanyUserId ] = optional($record->client)->name ?? 'Не определен';
        $data[ IReportDKBSubsidiesSimpleThings::LastEditorId ]  = optional($record->editor)->name ?? 'Нет';
        $data[ IReportDKBSubsidiesSimpleThings::IsEdited ]      = $record->is_edited
            ? 'Да'
            : 'Нет';

        return $data;
    }

    final public function updateReportRow(array $data): Model
    {
        $editData = Arr::except(
            $data,
            [
                IReportDKBSubsidiesSimpleThings::CompanyUserId,
                IReportDKBSubsidiesSimpleThings::LastEditorId,
                IReportDKBSubsidiesSimpleThings::IsEdited,
                IReportDKBSubsidiesSimpleThings::Id,
            ]
        );

        $editData[ IReportDKBSubsidiesSimpleThings::LastEditorId ] = optional(Auth::user())->id;
        $editData[ IReportDKBSubsidiesSimpleThings::IsEdited ]     = true;

        return $this
            ->update(
                $data[ IReportDKBSubsidiesSimpleThings::Id ],
                $editData
            );
    }

    final public function hasFailedRecords(string $report_id): bool
    {
        return GovernmentSimpleThingsReports
                   ::where(IReportDKBSubsidiesSimpleThings::ReportId, $report_id)
                   ->whereNotNull(IReportDKBSubsidiesSimpleThings::LastFailComment)
                   ->count() > 0;
    }

    final public function getByParent(string $report_id): array
    {
        $records = GovernmentSimpleThingsReports
            ::where(IReportDKBSubsidiesSimpleThings::ReportId, $report_id)
            ->get()
        ;

        $report = $records
            ->map(
                function ($item)
                {
                    $row = $item
                        ->only(
                            [
                                IReportDKBSubsidiesSimpleThings::PurposeOfTheLoan,
                                IReportDKBSubsidiesSimpleThings::IndustryOfActivity,
                                IReportDKBSubsidiesSimpleThings::STBName,
                                IReportDKBSubsidiesSimpleThings::CreditAmount,
                                IReportDKBSubsidiesSimpleThings::CurrentNumberOfWorkPlaces,
                                IReportDKBSubsidiesSimpleThings::NumberOfCreatedWorkplaces,
                                IReportDKBSubsidiesSimpleThings::DirectionByProgram,
                            ]
                        );

                    $row[ IReportDKBSubsidiesSimpleThings::District ]         = $item->district;
                    $row[ IReportDKBSubsidiesSimpleThings::PurposeOfTheLoan ] = $this->formatTarget(
                        $row[ IReportDKBSubsidiesSimpleThings::PurposeOfTheLoan ]
                    );

                    return $row;
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
            'file'   => '/reports/government-programs/GosProgramsSubsidiesSimple.mrt',
            'source' => 'GosProgrammi_subsidies_simple',
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
                if ($field === IReportDKBSubsidiesSimpleThings::ProgramDistrictId) {
                    $fieldName = trans(
                        IReportDKBSubsidiesSimpleThings::ReportFileFieldsNames[ IReportDKBSubsidiesSimpleThings::District ]
                    );
                } elseif (array_key_exists($field, IReportDKBSubsidiesSimpleThings::ReportFileFieldsNames)) {
                    $fieldName = trans(IReportDKBSubsidiesSimpleThings::ReportFileFieldsNames[ $field ]);
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
            IReportDKBSubsidiesSimpleThings::PurposeOfTheLoan          => 'required|string',
            IReportDKBSubsidiesSimpleThings::IndustryOfActivity        => 'required|string',
            IReportDKBSubsidiesSimpleThings::STBName                   => 'required|string',
            IReportDKBSubsidiesSimpleThings::CreditAmount              => 'required|numeric',
            IReportDKBSubsidiesSimpleThings::CurrentNumberOfWorkPlaces => 'required|numeric',
            IReportDKBSubsidiesSimpleThings::NumberOfCreatedWorkplaces => 'required|numeric',
            IReportDKBSubsidiesSimpleThings::ProgramDistrictId         => 'required|uuid|exists:districts,id',
            IReportDKBSubsidiesSimpleThings::DirectionByProgram        => [
                'required',
                Rule::in([ '1', '2', '3', 'Механизм' ]),
            ],
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

    private function formatTarget(string $target = null): ?string
    {
        if (!$target) {
            return $target;
        }
        $targetStr = Str::lower($target);

        if (strpos($targetStr, 'инвестиции') !== false && strpos($targetStr, 'пос') === false) {
            return 'Инвестиции';
        }

        return 'ПОС';
    }

}
