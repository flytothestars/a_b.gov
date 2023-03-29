<?php

namespace App\Repositories\GovernmentProgramsReports;

use App\Contracts\GovernmentProgramsReports\IReportAlmatyBusinessZhibekZholy;
use App\Contracts\GovernmentProgramsReports\IReportFieldsTypes;
use App\Contracts\GovernmentProgramsReports\IReportStatuses;
use App\Models\City;
use App\Models\GovernmentReportCommonRatio;
use App\Models\Report\GovernmentProgram\GovernmentZhibekZholyReport;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GovernmentZhibekZholyReportsRepository extends BaseReportRepository
    implements IGovernmentZhibekZholyReportsRepositoryContract
{
    public function __construct(
        GovernmentZhibekZholyReport $model
    )
    {
        parent::__construct($model);
    }

    final public function getReportRecords(string $id): Collection
    {
        return $this
            ->query()
            ->where(IReportAlmatyBusinessZhibekZholy::ReportId, $id)
            ->get()
            ;
    }

    final public function getReportRecordsFailed(string $id): array
    {
        return $this
            ->query()
            ->with([ 'city' ])
            ->where(IReportAlmatyBusinessZhibekZholy::ReportId, $id)
            ->where(IReportAlmatyBusinessZhibekZholy::Status, IReportStatuses::ImportFailed)
            ->get()
            ->map(
                function ($item)
                {
                    $record                                               = $item
                        ->only(IReportAlmatyBusinessZhibekZholy::ReportTableFields);
                    $record[ IReportAlmatyBusinessZhibekZholy::Region ]   = optional($item->city)[ 'name' ] ?? null;
                    $record[ IReportAlmatyBusinessZhibekZholy::Id ]       = $item->id;
                    $record[ IReportAlmatyBusinessZhibekZholy::ReportId ] = $item->report_id;
                    if ($item[ IReportAlmatyBusinessZhibekZholy::IsRegionProject ]) {
                        $record[ IReportAlmatyBusinessZhibekZholy::PlaceOfImplementation ] = optional(
                                                                                                 $item->city
                                                                                             )[ 'name' ] ?? null;
                    } else {
                        $record[ IReportAlmatyBusinessZhibekZholy::PlaceOfImplementation ] = $item->place_of_implementation
                                                                                             ??
                                                                                             null;
                    }
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
            ->with([ 'city' ])
            ->where(IReportAlmatyBusinessZhibekZholy::ReportId, $id)
            ->where(IReportAlmatyBusinessZhibekZholy::Status, '!=', IReportStatuses::ImportFailed)
            ->get()
            ->map(
                function ($item)
                {
                    $record                                               = $item
                        ->only(IReportAlmatyBusinessZhibekZholy::ReportTableFields);
                    $record[ IReportAlmatyBusinessZhibekZholy::Region ]   = optional($item->city)[ 'name' ] ?? null;
                    $record[ IReportAlmatyBusinessZhibekZholy::Id ]       = $item->id;
                    $record[ IReportAlmatyBusinessZhibekZholy::ReportId ] = $item->report_id;
                    if ($item[ IReportAlmatyBusinessZhibekZholy::IsRegionProject ]) {
                        $record[ IReportAlmatyBusinessZhibekZholy::PlaceOfImplementation ] = optional(
                                                                                                 $item->city
                                                                                             )[ 'name' ] ?? null;
                    } else {
                        $record[ IReportAlmatyBusinessZhibekZholy::PlaceOfImplementation ] = $item->place_of_implementation
                                                                                             ??
                                                                                             null;
                    }
                    return $record;
                }
            )
            ->toArray()
            ;
    }

    final public function getReportHeaders(): array
    {
        $headers = [];

        foreach (IReportAlmatyBusinessZhibekZholy::ReportTableFields as $field) {
            $headers[] = [
                'text'     => trans(IReportAlmatyBusinessZhibekZholy::ReportFileFieldsNames[ $field ]),
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
                'field'    => IReportAlmatyBusinessZhibekZholy::Id,
                'visible'  => false,
                'editable' => false,
                'type'     => IReportFieldsTypes::TypeInfo,
            ],
            [
                'field'    => IReportAlmatyBusinessZhibekZholy::ReportId,
                'visible'  => false,
                'editable' => false,
                'type'     => IReportFieldsTypes::TypeInfo,
            ],
            [
                'field'    => IReportAlmatyBusinessZhibekZholy::CompanyUserId,
                'editable' => false,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeInfo,
                'title'    => trans('messages.reports.user'),
            ],
            [
                'field'    => IReportAlmatyBusinessZhibekZholy::IsEdited,
                'editable' => false,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeInfo,
                'title'    => trans('messages.reports.isEdited'),
            ],
            [
                'field'    => IReportAlmatyBusinessZhibekZholy::LastEditorId,
                'editable' => false,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeInfo,
                'title'    => trans('messages.reports.editor'),
            ],
            [
                'field'    => IReportAlmatyBusinessZhibekZholy::Number,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.ZhibekZholy.Number'),
            ],
            [
                'field'    => IReportAlmatyBusinessZhibekZholy::Program,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.ZhibekZholy.Program'),
            ],
            [
                'field'    => IReportAlmatyBusinessZhibekZholy::NameOfTheBank,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.ZhibekZholy.NameOfTheBank'),
            ],
            [
                'field'    => IReportAlmatyBusinessZhibekZholy::ProgramCityId,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeSelect,
                'title'    => trans('messages.reports.government.fields.ZhibekZholy.Region'),
                'options'  => City
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
                'field'    => IReportAlmatyBusinessZhibekZholy::BorrowerName,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.ZhibekZholy.BorrowerName'),
            ],
            [
                'field'    => IReportAlmatyBusinessZhibekZholy::LegalStatus,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.ZhibekZholy.LegalStatus'),
            ],
            [
                'field'    => IReportAlmatyBusinessZhibekZholy::LoanIssueDate,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeDate,
                'title'    => trans('messages.reports.government.fields.ZhibekZholy.LoanIssueDate'),
            ],
            [
                'field'    => IReportAlmatyBusinessZhibekZholy::LoanTerm,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeInteger,
                'title'    => trans('messages.reports.government.fields.ZhibekZholy.LoanTerm'),
            ],
            [
                'field'    => IReportAlmatyBusinessZhibekZholy::LoanAmount,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeFloat,
                'title'    => trans('messages.reports.government.fields.ZhibekZholy.LoanAmount'),
            ],
            [
                'field'    => IReportAlmatyBusinessZhibekZholy::ApprovedLoanAmount,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeFloat,
                'title'    => trans('messages.reports.government.fields.ZhibekZholy.ApprovedLoanAmount'),
            ],
            [
                'field'    => IReportAlmatyBusinessZhibekZholy::FundsOwnAmount,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeFloat,
                'title'    => trans('messages.reports.government.fields.ZhibekZholy.FundsOwnAmount'),
            ],
            [
                'field'    => IReportAlmatyBusinessZhibekZholy::ActualAmount,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeFloat,
                'title'    => trans('messages.reports.government.fields.ZhibekZholy.ActualAmount'),
            ],
            [
                'field'    => IReportAlmatyBusinessZhibekZholy::FundActualAmount,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeFloat,
                'title'    => trans('messages.reports.government.fields.ZhibekZholy.FundActualAmount'),
            ],
            [
                'field'    => IReportAlmatyBusinessZhibekZholy::BankActualAmount,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeFloat,
                'title'    => trans('messages.reports.government.fields.ZhibekZholy.BankActualAmount'),
            ],
            [
                'field'    => IReportAlmatyBusinessZhibekZholy::PrincipalRepaymentPeriod,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeInteger,
                'title'    => trans('messages.reports.government.fields.ZhibekZholy.PrincipalRepaymentPeriod'),
            ],
            [
                'field'    => IReportAlmatyBusinessZhibekZholy::RemunerationPaymentPeriod,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeInteger,
                'title'    => trans('messages.reports.government.fields.ZhibekZholy.RemunerationPaymentPeriod'),
            ],
            [
                'field'    => IReportAlmatyBusinessZhibekZholy::LoanInterestRate,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeFloat,
                'title'    => trans('messages.reports.government.fields.ZhibekZholy.LoanInterestRate'),
            ],
            [
                'field'    => IReportAlmatyBusinessZhibekZholy::EffectiveLoanRate,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeFloat,
                'title'    => trans('messages.reports.government.fields.ZhibekZholy.EffectiveLoanRate'),
            ],
            [
                'field'    => IReportAlmatyBusinessZhibekZholy::LoanObject,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.ZhibekZholy.LoanObject'),
            ],
            [
                'field'    => IReportAlmatyBusinessZhibekZholy::PurposeOfBorrowedFunds,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.ZhibekZholy.PurposeOfBorrowedFunds'),
            ],
            [
                'field'    => IReportAlmatyBusinessZhibekZholy::PlaceOfImplementation,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeSelect,
                'title'    => trans('messages.reports.government.fields.ZhibekZholy.PlaceOfImplementation'),
                'options'  => City
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
                'field'    => IReportAlmatyBusinessZhibekZholy::OKED,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.ZhibekZholy.OKED'),
            ],
            [
                'field'    => IReportAlmatyBusinessZhibekZholy::SubSectorOKED,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.ZhibekZholy.SubSectorOKED'),
            ],
            [
                'field'    => IReportAlmatyBusinessZhibekZholy::NewWorkplaces,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeInteger,
                'title'    => trans('messages.reports.government.fields.ZhibekZholy.NewWorkplaces'),
            ],
            [
                'field'    => IReportAlmatyBusinessZhibekZholy::AuthorizedBankDecisionNo,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.ZhibekZholy.AuthorizedBankDecisionNo'),
            ],
            [
                'field'    => IReportAlmatyBusinessZhibekZholy::AuthorizedBankDecisionDate,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeDate,
                'title'    => trans('messages.reports.government.fields.ZhibekZholy.AuthorizedBankDecisionDate'),
            ],
            [
                'field'    => IReportAlmatyBusinessZhibekZholy::LoanAgreementNo,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.ZhibekZholy.LoanAgreementNo'),
            ],
            [
                'field'    => IReportAlmatyBusinessZhibekZholy::LoanAgreementDate,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeDate,
                'title'    => trans('messages.reports.government.fields.ZhibekZholy.LoanAgreementDate'),
            ],
            [
                'field'    => IReportAlmatyBusinessZhibekZholy::CompanyBinIin,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.ZhibekZholy.CompanyBinIin'),
            ],
            [
                'field'    => IReportAlmatyBusinessZhibekZholy::BusinessProject,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeSelect,
                'title'    => trans(
                    'messages.reports.government.fields.ZhibekZholy.BusinessProject'
                ),
                'options'  => [
                    [
                        'id'   => 'действующий',
                        'name' => 'действующий',
                    ],
                    [
                        'id'   => 'стартовый',
                        'name' => 'стартовый',
                    ],
                ],
            ],
            [
                'field'    => IReportAlmatyBusinessZhibekZholy::IsRegionProject,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeBoolean,
                'title'    => trans('messages.reports.government.fields.ZhibekZholy.IsRegionProject'),
            ],
            [
                'field'    => IReportAlmatyBusinessZhibekZholy::Tax,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeFloat,
                'title'    => trans('messages.reports.government.fields.ZhibekZholy.tax'),
            ],
            [
                'field'    => IReportAlmatyBusinessZhibekZholy::CurrentWorkPlaces,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeFloat,
                'title'    => trans('messages.reports.government.fields.ZhibekZholy.CurrentWorkPlaces'),
            ],
        ];
    }

    final public function getReportRowData(int $id): array
    {
        $record = GovernmentZhibekZholyReport::find($id);

        $data = $record->toArray();

        $data[ IReportAlmatyBusinessZhibekZholy::CompanyUserId ] = optional($record->client)->name ?? 'Не определен';
        $data[ IReportAlmatyBusinessZhibekZholy::LastEditorId ]  = optional($record->editor)->name ?? 'Нет';
        $data[ IReportAlmatyBusinessZhibekZholy::IsEdited ]      = $record->is_edited
            ? 'Да'
            : 'Нет';

        return $data;
    }

    final public function updateReportRow(array $data): Model
    {
        $editData = Arr::except(
            $data,
            [
                IReportAlmatyBusinessZhibekZholy::CompanyUserId,
                IReportAlmatyBusinessZhibekZholy::LastEditorId,
                IReportAlmatyBusinessZhibekZholy::IsEdited,
                IReportAlmatyBusinessZhibekZholy::Id,
            ]
        );

        $editData[ IReportAlmatyBusinessZhibekZholy::LastEditorId ] = optional(Auth::user())->id;
        $editData[ IReportAlmatyBusinessZhibekZholy::IsEdited ]     = true;

        return $this
            ->update(
                $data[ IReportAlmatyBusinessZhibekZholy::Id ],
                $editData
            );
    }

    final public function hasFailedRecords(string $report_id): bool
    {
        return GovernmentZhibekZholyReport
                   ::where(IReportAlmatyBusinessZhibekZholy::ReportId, $report_id)
                   ->whereNotNull(IReportAlmatyBusinessZhibekZholy::LastFailComment)
                   ->count() > 0;
    }

    final public function getByParent(string $report_id): array
    {
        $records = GovernmentZhibekZholyReport
            ::where(IReportAlmatyBusinessZhibekZholy::ReportId, $report_id)
            ->get()
        ;

        $report = $records
            ->map(
                function ($item)
                {
                    $item                                          = $item
                        ->only(
                            [
                                IReportAlmatyBusinessZhibekZholy::ActualAmount,
                                IReportAlmatyBusinessZhibekZholy::NewWorkplaces,
                                IReportAlmatyBusinessZhibekZholy::LoanObject,
                                IReportAlmatyBusinessZhibekZholy::OKED,
                                IReportAlmatyBusinessZhibekZholy::NameOfTheBank,
                                IReportAlmatyBusinessZhibekZholy::BusinessProject,
                                IReportAlmatyBusinessZhibekZholy::CurrentWorkPlaces,
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
            'file'   => '/reports/government-programs/AlmatyBusinessZhibekZholy.mrt',
            'source' => 'AlmatyBusinessZhibekZholy',
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
                if ($field === IReportAlmatyBusinessZhibekZholy::ProgramCityId) {
                    $fieldName = trans(
                        IReportAlmatyBusinessZhibekZholy::ReportFileFieldsNames[ IReportAlmatyBusinessZhibekZholy::Region ]
                    );
                } elseif (array_key_exists($field, IReportAlmatyBusinessZhibekZholy::ReportFileFieldsNames)) {
                    $fieldName = trans(IReportAlmatyBusinessZhibekZholy::ReportFileFieldsNames[ $field ]);
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
            IReportAlmatyBusinessZhibekZholy::ActualAmount    => 'required|numeric',
            IReportAlmatyBusinessZhibekZholy::NewWorkplaces   => 'required|numeric',
            IReportAlmatyBusinessZhibekZholy::ProgramCityId   => 'required|uuid|exists:cities,id',
            IReportAlmatyBusinessZhibekZholy::LoanObject      => 'required|string',
            IReportAlmatyBusinessZhibekZholy::OKED            => 'required|string',
            IReportAlmatyBusinessZhibekZholy::NameOfTheBank   => 'required|string',
            IReportAlmatyBusinessZhibekZholy::BusinessProject => 'required|string',
        ];

        if (!$data[ IReportAlmatyBusinessZhibekZholy::IsRegionProject ]) {
            $validations[ IReportAlmatyBusinessZhibekZholy::PlaceOfImplementation ] = 'required|string';
        }

        return Validator::make(
            $data,
            $validations,
            [
                IReportAlmatyBusinessZhibekZholy::ProgramCityId . '.required' => 'Поле введено не корректно.',
                IReportAlmatyBusinessZhibekZholy::ProgramCityId . '.uuid'     => 'Не определен город.',
            ]
        );
    }


}
