<?php

namespace App\Repositories\GovernmentProgramsReports;

use App\Contracts\GovernmentProgramsReports\IReportDKBSubsidiesSimpleThings;
use App\Contracts\GovernmentProgramsReports\IReportTypeAlmatyFinance;
use App\Contracts\GovernmentProgramsReports\IReportFieldsTypes;
use App\Contracts\GovernmentProgramsReports\IReportStatuses;
use App\Models\District;
use App\Models\GovernmentReportCommonRatio;
use App\Models\Report\GovernmentProgram\GovernmentAlmatyFinanceReport;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GovernmentAlmatyFinanceReportsRepository extends BaseReportRepository
    implements IGovernmentAlmatyFinanceReportsRepositoryContract
{
    public function __construct(
        GovernmentAlmatyFinanceReport $model
    )
    {
        parent::__construct($model);
    }

    final public function getReportRecords(string $id): Collection
    {
        return $this
            ->query()
            ->where(IReportTypeAlmatyFinance::ReportId, $id)
            ->get()
            ;
    }

    final public function getReportRecordsFailed(string $id): array
    {
        return $this
            ->query()
            ->with([ 'district' ])
            ->where(IReportTypeAlmatyFinance::ReportId, $id)
            ->where(IReportTypeAlmatyFinance::Status, IReportStatuses::ImportFailed)
            ->get()
            ->map(
                function ($item)
                {
                    $record                                                    = $item
                        ->only(IReportTypeAlmatyFinance::ReportTableFields);
                    $record[ IReportTypeAlmatyFinance::Id ]                    = $item->id;
                    $record[ IReportTypeAlmatyFinance::ReportId ]              = $item->report_id;
                    $record[ IReportTypeAlmatyFinance::PlaceOfImplementation ] = optional($item->district)->name;

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
            ->where(IReportTypeAlmatyFinance::ReportId, $id)
            ->where(IReportTypeAlmatyFinance::Status, '!=', IReportStatuses::ImportFailed)
            ->get()
            ->map(
                function ($item)
                {
                    $record                                                    = $item
                        ->only(IReportTypeAlmatyFinance::ReportTableFields);
                    $record[ IReportTypeAlmatyFinance::Id ]                    = $item->id;
                    $record[ IReportTypeAlmatyFinance::ReportId ]              = $item->report_id;
                    $record[ IReportTypeAlmatyFinance::PlaceOfImplementation ] = optional($item->district)->name;

                    return $record;
                }
            )
            ->toArray()
            ;
    }

    final public function getReportHeaders(): array
    {
        $headers = [];

        foreach (IReportTypeAlmatyFinance::ReportTableFields as $field) {
            $headers[] = [
                'text'     => trans(IReportTypeAlmatyFinance::ReportFileFieldsNames[ $field ]),
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
                'field'    => IReportTypeAlmatyFinance::Id,
                'visible'  => false,
                'editable' => false,
                'type'     => IReportFieldsTypes::TypeInfo,
            ],
            [
                'field'    => IReportTypeAlmatyFinance::ReportId,
                'visible'  => false,
                'editable' => false,
                'type'     => IReportFieldsTypes::TypeInfo,
            ],
            [
                'field'    => IReportTypeAlmatyFinance::CompanyUserId,
                'editable' => false,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeInfo,
                'title'    => trans('messages.reports.user'),
            ],
            [
                'field'    => IReportTypeAlmatyFinance::IsEdited,
                'editable' => false,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeInfo,
                'title'    => trans('messages.reports.isEdited'),
            ],
            [
                'field'    => IReportTypeAlmatyFinance::LastEditorId,
                'editable' => false,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeInfo,
                'title'    => trans('messages.reports.editor'),
            ],
            [
                'field'    => IReportTypeAlmatyFinance::Number,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.AlmatyFinance.Number'),
            ],
            [
                'field'    => IReportTypeAlmatyFinance::EntrepreneurName,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.AlmatyFinance.EntrepreneurName'),
            ],
            [
                'field'    => IReportTypeAlmatyFinance::CompanyBinIin,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.AlmatyFinance.CompanyBinIin'),
            ],
            [
                'field'    => IReportTypeAlmatyFinance::SubjectSize,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.AlmatyFinance.SubjectSize'),
            ],
            [
                'field'    => IReportTypeAlmatyFinance::ProgramDistrictId,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeSelect,
                'title'    => trans('messages.reports.government.fields.AlmatyFinance.PlaceOfImplementation'),
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
                'field'    => IReportTypeAlmatyFinance::CreditAmount,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeFloat,
                'title'    => trans('messages.reports.government.fields.AlmatyFinance.CreditAmount'),
            ],
            [
                'field'    => IReportTypeAlmatyFinance::LoanRate,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeFloat,
                'title'    => trans('messages.reports.government.fields.AlmatyFinance.LoanRate'),
            ],
            [
                'field'    => IReportTypeAlmatyFinance::CurrentWorkPlace,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeInteger,
                'title'    => trans('messages.reports.government.fields.AlmatyFinance.CurrentWorkPlace'),
            ],
            [
                'field'    => IReportTypeAlmatyFinance::CreatedWorkPlace,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeInteger,
                'title'    => trans('messages.reports.government.fields.AlmatyFinance.CreatedWorkPlace'),
            ],
            [
                'field'    => IReportTypeAlmatyFinance::BranchOfActivity,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.AlmatyFinance.BranchOfActivity'),
            ],
            [
                'field'    => IReportTypeAlmatyFinance::OKED,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.AlmatyFinance.OKED'),
            ],
            [
                'field'    => IReportTypeAlmatyFinance::BusinessOfImplementation,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.AlmatyFinance.BusinessOfImplementation'),
            ],
            [
                'field'    => IReportTypeAlmatyFinance::PurposeOfTheLoan,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.AlmatyFinance.PurposeOfTheLoan'),
            ],
            [
                'field'    => IReportTypeAlmatyFinance::ProjectStatus,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeSelect,
                'title'    => trans(
                    'messages.reports.government.fields.AlmatyFinance.ProjectStatus'
                ),
                'options'  => [
                    [
                        'id'   => 'выдано',
                        'name' => 'выдано',
                    ],
                    [
                        'id'   => 'одобрено',
                        'name' => 'одобрено',
                    ],
                    [
                        'id'   => 'утверждено',
                        'name' => 'утверждено',
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
                'field'    => IReportTypeAlmatyFinance::DateOfIssue,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeDate,
                'title'    => trans('messages.reports.government.fields.AlmatyFinance.DateOfIssue'),
            ],
            [
                'field'    => IReportTypeAlmatyFinance::LegalAddressOfTheCompany,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.AlmatyFinance.LegalAddressOfTheCompany'),
            ],
            [
                'field'    => IReportTypeAlmatyFinance::FullNameOfTheHead,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.AlmatyFinance.FullNameOfTheHead'),
            ],
            [
                'field'    => IReportTypeAlmatyFinance::Contacts,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.AlmatyFinance.Contacts'),
            ],
            [
                'field'    => IReportTypeAlmatyFinance::Tax,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeFloat,
                'title'    => trans('messages.reports.government.fields.AlmatyFinance.tax'),
            ],
        ];
    }

    final public function getReportRowData(int $id): array
    {
        $record = GovernmentAlmatyFinanceReport::find($id);

        $data = $record->toArray();

        $data[ IReportTypeAlmatyFinance::CompanyUserId ] = optional($record->client)->name ?? 'Не определен';
        $data[ IReportTypeAlmatyFinance::LastEditorId ]  = optional($record->editor)->name ?? 'Нет';
        $data[ IReportTypeAlmatyFinance::IsEdited ]      = $record->is_edited
            ? 'Да'
            : 'Нет';

        return $data;
    }

    final public function updateReportRow(array $data): Model
    {
        $editData = Arr::except(
            $data,
            [
                IReportTypeAlmatyFinance::CompanyUserId,
                IReportTypeAlmatyFinance::LastEditorId,
                IReportTypeAlmatyFinance::IsEdited,
                IReportTypeAlmatyFinance::Id,
            ]
        );

        $editData[ IReportTypeAlmatyFinance::LastEditorId ] = optional(Auth::user())->id;
        $editData[ IReportTypeAlmatyFinance::IsEdited ]     = true;

        return $this
            ->update(
                $data[ IReportTypeAlmatyFinance::Id ],
                $editData
            );
    }

    final public function hasFailedRecords(string $report_id): bool
    {
        return GovernmentAlmatyFinanceReport
                   ::where(IReportTypeAlmatyFinance::ReportId, $report_id)
                   ->whereNotNull(IReportTypeAlmatyFinance::LastFailComment)
                   ->count() > 0;
    }

    final public function getByParent(string $report_id): array
    {
        $records = GovernmentAlmatyFinanceReport
            ::where(IReportTypeAlmatyFinance::ReportId, $report_id)
            ->get()
        ;

        $report = $records
            ->map(
                function ($item)
                {
                    $item = $item
                        ->only(
                            [
                                IReportTypeAlmatyFinance::CreditAmount,
                                IReportTypeAlmatyFinance::PlaceOfImplementation,
                                IReportTypeAlmatyFinance::CreatedWorkPlace,
                                IReportTypeAlmatyFinance::CurrentWorkPlace,
                                IReportTypeAlmatyFinance::PurposeOfTheLoan,
                                IReportTypeAlmatyFinance::BranchOfActivity,
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
            'file'   => '/reports/government-programs/GosProgramsAlmatyFinance.mrt',
            'source' => 'Almaty_Finance',
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
                if ($field === IReportTypeAlmatyFinance::ProgramDistrictId) {
                    $fieldName = trans(
                        IReportTypeAlmatyFinance::ReportFileFieldsNames[ IReportTypeAlmatyFinance::PlaceOfImplementation ]
                    );
                } elseif (array_key_exists($field, IReportTypeAlmatyFinance::ReportFileFieldsNames)) {
                    $fieldName = trans(IReportTypeAlmatyFinance::ReportFileFieldsNames[ $field ]);
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
            IReportTypeAlmatyFinance::CreditAmount      => 'required|numeric',
            IReportTypeAlmatyFinance::ProgramDistrictId => 'required|uuid|exists:districts,id',
            IReportTypeAlmatyFinance::CreatedWorkPlace  => 'nullable|numeric',
            IReportTypeAlmatyFinance::CurrentWorkPlace  => 'nullable|numeric',
            IReportTypeAlmatyFinance::PurposeOfTheLoan  => 'required|string',
            IReportTypeAlmatyFinance::BranchOfActivity  => 'required|string',
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
