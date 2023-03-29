<?php

namespace App\Repositories\GovernmentProgramsReports;

use App\Contracts\GovernmentProgramsReports\IReportDKBSubsidies;
use App\Contracts\GovernmentProgramsReports\IReportFieldsTypes;
use App\Contracts\GovernmentProgramsReports\IReportStatuses;
use App\Models\District;
use App\Models\GovernmentReportCommonRatio;
use App\Models\Report\GovernmentProgram\GovernmentGuaranteeReport;
use App\Models\Report\GovernmentProgram\GovernmentSubsidiesReport;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class GovernmentSubsidiesReportsRepository extends BaseReportRepository
    implements IGovernmentSubsidiesReportsRepositoryContract
{
    public function __construct(
        GovernmentSubsidiesReport $model
    )
    {
        parent::__construct($model);
    }

    final public function getReportRecords(string $id): Collection
    {
        return $this
            ->query()
            ->where(IReportDKBSubsidies::ReportId, $id)
            ->get()
            ;
    }

    final public function getReportRecordsFailed(string $id): array
    {
        return $this
            ->query()
            ->with([ 'district' ])
            ->where(IReportDKBSubsidies::ReportId, $id)
            ->where(IReportDKBSubsidies::Status, IReportStatuses::ImportFailed)
            ->get()
            ->map(
                function ($item)
                {
                    $record                                  = $item
                        ->only(IReportDKBSubsidies::ReportTableFields);
                    $record[ IReportDKBSubsidies::District ] = optional($item->district)[ 'name' ] ?? null;
                    $record[ IReportDKBSubsidies::Id ]       = $item->id;
                    $record[ IReportDKBSubsidies::ReportId ] = $item->report_id;
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
            ->where(IReportDKBSubsidies::ReportId, $id)
            ->where(IReportDKBSubsidies::Status, '!=', IReportStatuses::ImportFailed)
            ->get()
            ->map(
                function ($item)
                {
                    $record                                  = $item
                        ->only(IReportDKBSubsidies::ReportTableFields);
                    $record[ IReportDKBSubsidies::District ] = optional($item->district)[ 'name' ] ?? null;
                    $record[ IReportDKBSubsidies::Id ]       = $item->id;
                    $record[ IReportDKBSubsidies::ReportId ] = $item->report_id;
                    return $record;
                }
            )
            ->toArray()
            ;
    }

    final public function getReportHeaders(): array
    {
        $headers = [];

        foreach (IReportDKBSubsidies::ReportTableFields as $field) {
            $headers[] = [
                'text'     => trans(IReportDKBSubsidies::ReportFileFieldsNames[ $field ]),
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
                'field'    => IReportDKBSubsidies::Id,
                'visible'  => false,
                'editable' => false,
                'type'     => IReportFieldsTypes::TypeInfo,
            ],
            [
                'field'    => IReportDKBSubsidies::ReportId,
                'visible'  => false,
                'editable' => false,
                'type'     => IReportFieldsTypes::TypeInfo,
            ],
            [
                'field'    => IReportDKBSubsidies::CompanyUserId,
                'editable' => false,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeInfo,
                'title'    => trans('messages.reports.user'),
            ],
            [
                'field'    => IReportDKBSubsidies::IsEdited,
                'editable' => false,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeInfo,
                'title'    => trans('messages.reports.isEdited'),
            ],
            [
                'field'    => IReportDKBSubsidies::LastEditorId,
                'editable' => false,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeInfo,
                'title'    => trans('messages.reports.editor'),
            ],
            [
                'field'    => IReportDKBSubsidies::Number,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.Subsidies.Number'),
            ],
            [
                'field'    => IReportDKBSubsidies::STBName,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.Subsidies.STBName'),
            ],
            [
                'field'    => IReportDKBSubsidies::EntrepreneurSName,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.Subsidies.EntrepreneurSName'),
            ],
            [
                'field'    => IReportDKBSubsidies::CompanyBinIin,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.Subsidies.CompanyBinIin'),
            ],
            [
                'field'    => IReportDKBSubsidies::SubjectSize,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.Subsidies.SubjectSize'),
            ],
            [
                'field'    => IReportDKBSubsidies::ProgramDistrictId,
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
                'field'    => IReportDKBSubsidies::CreditAmount,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeFloat,
                'title'    => trans('messages.reports.government.fields.Subsidies.CreditAmount'),
            ],
            [
                'field'    => IReportDKBSubsidies::LoanRate,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeFloat,
                'title'    => trans('messages.reports.government.fields.Subsidies.LoanRate'),
            ],
            [
                'field'    => IReportDKBSubsidies::Subsidies,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeFloat,
                'title'    => trans('messages.reports.government.fields.Subsidies.Subsidies'),
            ],
            [
                'field'    => IReportDKBSubsidies::TheAmountOfThePlannedSubsidyUntil,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeFloat,
                'title'    => trans('messages.reports.government.fields.Subsidies.TheAmountOfThePlannedSubsidyUntil'),
            ],
            [
                'field'    => IReportDKBSubsidies::CurrentNumberOfWorkPlaces,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeInteger,
                'title'    => trans('messages.reports.government.fields.Subsidies.CurrentNumberOfWorkPlaces'),
            ],
            [
                'field'    => IReportDKBSubsidies::NumberOfCreatedWorkplaces,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeInteger,
                'title'    => trans('messages.reports.government.fields.Subsidies.NumberOfCreatedWorkplaces'),
            ],
            [
                'field'    => IReportDKBSubsidies::IndustryOfActivity,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.Subsidies.IndustryOfActivity'),
            ],
            [
                'field'    => IReportDKBSubsidies::OKED,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.Subsidies.OKED'),
            ],
            [
                'field'    => IReportDKBSubsidies::PurposeOfTheLoan,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.Subsidies.PurposeOfTheLoan'),
            ],
            [
                'field'    => IReportDKBSubsidies::DirectionByProgram,
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
                'field'    => IReportDKBSubsidies::TheEssenceOfTheQuestionIsNewProlongation,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans(
                    'messages.reports.government.fields.Subsidies.TheEssenceOfTheQuestionIsNewProlongation'
                ),
            ],
            [
                'field'    => IReportDKBSubsidies::dateOfRegistrationOfTheApplication,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeDate,
                'title'    => trans('messages.reports.government.fields.Subsidies.dateOfRegistrationOfTheApplication'),
            ],
            [
                'field'    => IReportDKBSubsidies::ProtocolNumberOfTheFundMAPM,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.Subsidies.ProtocolNumberOfTheFundMAPM'),
            ],
            [
                'field'    => IReportDKBSubsidies::dateOfTheMinutesOfTheFundMAPM,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeDate,
                'title'    => trans('messages.reports.government.fields.Subsidies.dateOfTheMinutesOfTheFundMAPM'),
            ],
            [
                'field'    => IReportDKBSubsidies::ExpirationDateOfRKSFund,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeDate,
                'title'    => trans('messages.reports.government.fields.Subsidies.ExpirationDateOfRKSFund'),
            ],
            [
                'field'    => IReportDKBSubsidies::DateOfSendingTheLetterToSTB,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeDate,
                'title'    => trans('messages.reports.government.fields.Subsidies.DateOfSendingTheLetterToSTB'),
            ],
            [
                'field'    => IReportDKBSubsidies::YurCompanyAddress,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.Subsidies.YurCompanyAddress'),
            ],
            [
                'field'    => IReportDKBSubsidies::FullNameOfTheHead,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.Subsidies.FullNameOfTheHead'),
            ],
            [
                'field'    => IReportDKBSubsidies::Contacts,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.Subsidies.Contacts'),
            ],
            [
                'field'    => IReportDKBSubsidies::Tax,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeFloat,
                'title'    => trans('messages.reports.government.fields.Subsidies.tax'),
            ],
        ];
    }

    final public function getReportRowData(int $id): array
    {
        $record = GovernmentSubsidiesReport::find($id);

        $data = $record->toArray();

        $data[ IReportDKBSubsidies::CompanyUserId ] = optional($record->client)->name ?? 'Не определен';
        $data[ IReportDKBSubsidies::LastEditorId ]  = optional($record->editor)->name ?? 'Нет';
        $data[ IReportDKBSubsidies::IsEdited ]      = $record->is_edited
            ? 'Да'
            : 'Нет';

        return $data;
    }

    final public function updateReportRow(array $data): Model
    {
        $editData = Arr::except(
            $data,
            [
                IReportDKBSubsidies::CompanyUserId,
                IReportDKBSubsidies::LastEditorId,
                IReportDKBSubsidies::IsEdited,
                IReportDKBSubsidies::Id,
            ]
        );

        $editData[ IReportDKBSubsidies::LastEditorId ] = optional(Auth::user())->id;
        $editData[ IReportDKBSubsidies::IsEdited ]     = true;

        return $this
            ->update(
                $data[ IReportDKBSubsidies::Id ],
                $editData
            );
    }

    final public function hasFailedRecords(string $report_id): bool
    {
        return GovernmentSubsidiesReport
                   ::where(IReportDKBSubsidies::ReportId, $report_id)
                   ->whereNotNull(IReportDKBSubsidies::LastFailComment)
                   ->count() > 0;
    }

    final public function getByParent(string $report_id): array
    {
        $records = GovernmentSubsidiesReport
            ::where(IReportDKBSubsidies::ReportId, $report_id)
            ->get()
        ;

        $report = $records
            ->map(
                function ($item)
                {
                    $row                                  = $item
                        ->only(
                            [
                                IReportDKBSubsidies::PurposeOfTheLoan,
                                IReportDKBSubsidies::IndustryOfActivity,
                                IReportDKBSubsidies::STBName,
                                IReportDKBSubsidies::CreditAmount,
                                IReportDKBSubsidies::CurrentNumberOfWorkPlaces,
                                IReportDKBSubsidies::NumberOfCreatedWorkplaces,
                                IReportDKBSubsidies::DirectionByProgram,
                            ]
                        );
                    $row[ IReportDKBSubsidies::District ] = $item->district;
                    $row[ IReportDKBSubsidies::PurposeOfTheLoan ] = $this->formatTarget($row[ IReportDKBSubsidies::PurposeOfTheLoan ]);

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
            'file'   => '/reports/government-programs/GosProgramsSubsidies.mrt',
            'source' => 'GosProgrammi_subsidies',
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
                if ($field === IReportDKBSubsidies::ProgramDistrictId) {
                    $fieldName = trans(
                        IReportDKBSubsidies::ReportFileFieldsNames[ IReportDKBSubsidies::District ]
                    );
                } elseif (array_key_exists($field, IReportDKBSubsidies::ReportFileFieldsNames)) {
                    $fieldName = trans(IReportDKBSubsidies::ReportFileFieldsNames[ $field ]);
                } else {
                    $fieldName = $field;
                }

                $failMessage .= "<li>$fieldName: ";
                $failMessage .= implode(' | ', $fails);
                $failMessage .= '</li>';
            }
            $failMessage .= '</ul>';
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
            IReportDKBSubsidies::PurposeOfTheLoan          => 'required|string',
            IReportDKBSubsidies::IndustryOfActivity        => 'required|string',
            IReportDKBSubsidies::STBName                   => 'required|string',
            IReportDKBSubsidies::CreditAmount              => 'required|numeric',
            IReportDKBSubsidies::CurrentNumberOfWorkPlaces => 'required|numeric',
            IReportDKBSubsidies::NumberOfCreatedWorkplaces => 'required|numeric',
            IReportDKBSubsidies::ProgramDistrictId         => 'required|uuid|exists:districts,id',
            IReportDKBSubsidies::DirectionByProgram        => ['required', Rule::in(['1','2','3','Механизм'])],
        ];

        return Validator::make(
            $data,
            $validations,
            [
                IReportDKBSubsidies::ProgramDistrictId . '.required' => 'Поле введено не корректно.',
                IReportDKBSubsidies::ProgramDistrictId . '.uuid'     => 'Не определен район.',
            ]
        );
    }

    private function formatTarget(string $target = null): ?string
    {
        if(!$target){
            return $target;
        }
        $targetStr = Str::lower($target);


        if (strpos($targetStr, 'инвестиции') !== false && strpos($targetStr, 'пос') === false) {
            return 'Инвестиции';
        }

        return 'ПОС';
    }


}
