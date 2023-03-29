<?php

namespace App\Repositories\GovernmentProgramsReports;

use App\Contracts\GovernmentProgramsReports\IReportDKBGuarantee;
use App\Contracts\GovernmentProgramsReports\IReportFieldsTypes;
use App\Contracts\GovernmentProgramsReports\IReportStatuses;
use App\Models\City;
use App\Models\District;
use App\Models\Report\GovernmentProgram\GovernmentGuaranteeReport;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GovernmentGuaranteeReportsRepository extends BaseReportRepository
    implements IGovernmentGuaranteeReportsRepositoryContract
{
    public function __construct(
        GovernmentGuaranteeReport $model
    )
    {
        parent::__construct($model);
    }

    final public function getReportRecords(string $id): Collection
    {
        return $this
            ->query()
            ->where(IReportDKBGuarantee::ReportId, $id)
            ->get()
            ;
    }

    final public function getReportRecordsFailed(string $id): array
    {
        return $this
            ->query()
            ->with([ 'city', 'district' ])
            ->where(IReportDKBGuarantee::ReportId, $id)
            ->where(IReportDKBGuarantee::Status, IReportStatuses::ImportFailed)
            ->get()
            ->map(
                function ($item)
                {
                    $record                                       = $item
                        ->only(IReportDKBGuarantee::ReportTableFields);
                    $record[ IReportDKBGuarantee::ProjectRegion ] = optional($item->city)[ 'name' ] ?? null;
                    $record[ IReportDKBGuarantee::Id ]            = $item->id;
                    $record[ IReportDKBGuarantee::ReportId ]      = $item->report_id;
                    if ($item[ IReportDKBGuarantee::IsRegionProject ]) {
                        $record[ IReportDKBGuarantee::ProjectLocation ] = optional($item->city)[ 'name' ] ?? null;
                    } else {
                        $record[ IReportDKBGuarantee::ProjectLocation ] = optional($item->district)[ 'name' ] ?? null;
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
            ->with([ 'city', 'district' ])
            ->where(IReportDKBGuarantee::ReportId, $id)
            ->where(IReportDKBGuarantee::Status, '!=', IReportStatuses::ImportFailed)
            ->get()
            ->map(
                function ($item)
                {
                    $record                                       = $item
                        ->only(IReportDKBGuarantee::ReportTableFields);
                    $record[ IReportDKBGuarantee::ProjectRegion ] = optional($item->city)[ 'name' ] ?? null;
                    $record[ IReportDKBGuarantee::Id ]            = $item->id;
                    $record[ IReportDKBGuarantee::ReportId ]      = $item->report_id;
                    if ($item[ IReportDKBGuarantee::IsRegionProject ]) {
                        $record[ IReportDKBGuarantee::ProjectLocation ] = optional($item->city)[ 'name' ] ?? null;
                    } else {
                        $record[ IReportDKBGuarantee::ProjectLocation ] = optional($item->district)[ 'name' ] ?? null;
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

        foreach (IReportDKBGuarantee::ReportTableFields as $field) {
            $headers[] = [
                'text'     => trans(IReportDKBGuarantee::ReportFileFieldsNames[ $field ]),
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
                'field'    => IReportDKBGuarantee::Id,
                'visible'  => false,
                'editable' => false,
                'type'     => IReportFieldsTypes::TypeInfo,
            ],
            [
                'field'    => IReportDKBGuarantee::ReportId,
                'visible'  => false,
                'editable' => false,
                'type'     => IReportFieldsTypes::TypeInfo,
            ],
            [
                'field'    => IReportDKBGuarantee::CompanyUserId,
                'editable' => false,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeInfo,
                'title'    => trans('messages.reports.user'),
            ],
            [
                'field'    => IReportDKBGuarantee::IsEdited,
                'editable' => false,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeInfo,
                'title'    => trans('messages.reports.isEdited'),
            ],
            [
                'field'    => IReportDKBGuarantee::LastEditorId,
                'editable' => false,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeInfo,
                'title'    => trans('messages.reports.editor'),
            ],
            [
                'field'    => IReportDKBGuarantee::Number,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.Guarantee.Number'),
            ],
            [
                'field'    => IReportDKBGuarantee::CompanyType,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeSelect,
                'title'    => trans(
                    'messages.reports.government.fields.Guarantee.CompanyType'
                ),
                'options'  => [
                    [
                        'id'   => 'TOO',
                        'name' => 'TOO',
                    ],
                    [
                        'id'   => 'ТДО',
                        'name' => 'ТДО',
                    ],
                    [
                        'id'   => 'ИП',
                        'name' => 'ИП',
                    ],
                    [
                        'id'   => 'АО',
                        'name' => 'АО',
                    ],
                    [
                        'id'   => 'ПК',
                        'name' => 'ПК',
                    ],
                    [
                        'id'   => 'КТ',
                        'name' => 'КТ',
                    ],
                ],
            ],
            [
                'field'    => IReportDKBGuarantee::Name,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.Guarantee.Name'),
            ],
            [
                'field'    => IReportDKBGuarantee::ProjectDescription,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.Guarantee.ProjectDescription'),
            ],
            [
                'field'    => IReportDKBGuarantee::LoanTarget,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.Guarantee.LoanTarget'),
            ],
            [
                'field'    => IReportDKBGuarantee::BankIssueDate,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeDate,
                'title'    => trans('messages.reports.government.fields.Guarantee.BankIssueDate'),
            ],
            [
                'field'    => IReportDKBGuarantee::BankUODecisionDate,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeDate,
                'title'    => trans('messages.reports.government.fields.Guarantee.BankUODecisionDate'),
            ],
            [
                'field'    => IReportDKBGuarantee::Industry,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.Guarantee.Industry'),
            ],
            [
                'field'    => IReportDKBGuarantee::SubIndustry,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.Guarantee.SubIndustry'),
            ],
            [
                'field'    => IReportDKBGuarantee::LenderBank,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.Guarantee.LenderBank'),
            ],
            [
                'field'    => IReportDKBGuarantee::LoanAmount,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeFloat,
                'title'    => trans('messages.reports.government.fields.Guarantee.LoanAmount'),
            ],
            [
                'field'    => IReportDKBGuarantee::LoanGuarantee,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeFloat,
                'title'    => trans('messages.reports.government.fields.Guarantee.LoanGuarantee'),
            ],
            [
                'field'    => IReportDKBGuarantee::LoanGuaranteePeriod,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeInteger,
                'title'    => trans('messages.reports.government.fields.Guarantee.LoanGuaranteePeriod'),
            ],
            [
                'field'    => IReportDKBGuarantee::FoundationDecisionDate,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeDate,
                'title'    => trans('messages.reports.government.fields.Guarantee.FoundationDecisionDate'),
            ],
            [
                'field'    => IReportDKBGuarantee::SignGuaranteeAgreementDate,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeDate,
                'title'    => trans('messages.reports.government.fields.Guarantee.SignGuaranteeAgreementDate'),
            ],
            [
                'field'    => IReportDKBGuarantee::GuaranteeAgreementNumber,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.Guarantee.GuaranteeAgreementNumber'),
            ],
            [
                'field'    => IReportDKBGuarantee::CurrentEmployeesCount,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeInteger,
                'title'    => trans('messages.reports.government.fields.Guarantee.CurrentEmployeesCount'),
            ],
            [
                'field'    => IReportDKBGuarantee::NewJobsPlacesCount,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeInteger,
                'title'    => trans('messages.reports.government.fields.Guarantee.NewJobsPlacesCount'),
            ],
            [
                'field'    => IReportDKBGuarantee::WomenEntrepreneurshipCompliance,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeBoolean,
                'title'    => trans('messages.reports.government.fields.Guarantee.WomenEntrepreneurshipCompliance'),
            ],
            [
                'field'    => IReportDKBGuarantee::CompanyHeadDateOfBirth,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeDate,
                'title'    => trans('messages.reports.government.fields.Guarantee.CompanyHeadDateOfBirth'),
            ],
            [
                'field'    => IReportDKBGuarantee::ProgramCityId,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeSelect,
                'title'    => trans('messages.reports.government.fields.Guarantee.ProjectRegion'),
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
                'field'    => IReportDKBGuarantee::ProgramDistrictId,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeSelect,
                'title'    => trans('messages.reports.government.fields.Guarantee.ProjectLocation'),
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
                'field'    => IReportDKBGuarantee::ProjectLocationInMonocity,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeBoolean,
                'title'    => trans('messages.reports.government.fields.Guarantee.ProjectLocationInMonocity'),
            ],
            [
                'field'    => IReportDKBGuarantee::DKBProgram,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.Guarantee.DKBProgram'),
            ],
            [
                'field'    => IReportDKBGuarantee::ProgramDirection,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeInteger,
                'title'    => trans('messages.reports.government.fields.Guarantee.ProgramDirection'),
            ],
            [
                'field'    => IReportDKBGuarantee::FundingSource,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.Guarantee.FundingSource'),
            ],
            [
                'field'    => IReportDKBGuarantee::LoanPercent,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeFloat,
                'title'    => trans('messages.reports.government.fields.Guarantee.LoanPercent'),
            ],
            [
                'field'    => IReportDKBGuarantee::GuaranteeKind,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeSelect,
                'title'    => trans('messages.reports.government.fields.Guarantee.GuaranteeKind'),
                'options'  => [
                    [
                        'id'   => 'МНП',
                        'name' => 'МНП',
                    ],
                    [
                        'id'   => 'НП',
                        'name' => 'НП',
                    ],
                    [
                        'id'   => 'ЭГ',
                        'name' => 'ЭГ',
                    ],
                    [
                        'id'   => 'ИГ',
                        'name' => 'ИГ',
                    ],
                    [
                        'id'   => 'ММП',
                        'name' => 'ММП',
                    ],
                ],
            ],
            [
                'field'    => IReportDKBGuarantee::GuaranteeEndDate,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeDate,
                'title'    => trans('messages.reports.government.fields.Guarantee.GuaranteeEndDate'),
            ],
            [
                'field'    => IReportDKBGuarantee::GuaranteeExpired,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeBoolean,
                'title'    => trans('messages.reports.government.fields.Guarantee.GuaranteeExpired'),
            ],
            [
                'field'    => IReportDKBGuarantee::ProjectStatus,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.Guarantee.ProjectStatus'),
            ],
            [
                'field'    => IReportDKBGuarantee::GuaranteeExpireDate,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeDate,
                'title'    => trans('messages.reports.government.fields.Guarantee.GuaranteeExpireDate'),
            ],
            [
                'field'    => IReportDKBGuarantee::BankPayOnDemandAmount,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeFloat,
                'title'    => trans('messages.reports.government.fields.Guarantee.BankPayOnDemandAmount'),
            ],
            [
                'field'    => IReportDKBGuarantee::CompanyBinIin,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.Guarantee.CompanyBinIin'),
            ],
            [
                'field'    => IReportDKBGuarantee::RFManagerFullName,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.Guarantee.RFManagerFullName'),
            ],
            [
                'field'    => IReportDKBGuarantee::Year,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeText,
                'title'    => trans('messages.reports.government.fields.Guarantee.Year'),
            ],
            [
                'field'    => IReportDKBGuarantee::Quarter,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeSelect,
                'title'    => trans('messages.reports.government.fields.Guarantee.Quarter'),
                'options'  => [
                    [
                        'id'   => 1,
                        'name' => 1,
                    ],
                    [
                        'id'   => 2,
                        'name' => 2,
                    ],
                    [
                        'id'   => 3,
                        'name' => 3,
                    ],
                    [
                        'id'   => 4,
                        'name' => 4,
                    ],
                ],
            ],
            [
                'field'    => IReportDKBGuarantee::PortfolioGuarantee,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeBoolean,
                'title'    => trans('messages.reports.government.fields.Guarantee.PortfolioGuarantee'),
            ],
            [
                'field'    => IReportDKBGuarantee::PGCommissionRegistrationDate,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeDate,
                'title'    => trans('messages.reports.government.fields.Guarantee.PGCommissionRegistrationDate'),
            ],
            [
                'field'    => IReportDKBGuarantee::IsRegionProject,
                'editable' => true,
                'visible'  => true,
                'type'     => IReportFieldsTypes::TypeBoolean,
                'title'    => trans('messages.reports.government.fields.Guarantee.IsRegionProject'),
            ],
        ];
    }

    final public function getReportRowData(int $id): array
    {
        $record = GovernmentGuaranteeReport::find($id);

        $data = $record->toArray();

        $data[ IReportDKBGuarantee::CompanyUserId ] = optional($record->client)->name ?? 'Не определен';
        $data[ IReportDKBGuarantee::LastEditorId ]  = optional($record->editor)->name ?? 'Нет';
        $data[ IReportDKBGuarantee::IsEdited ]      = $record->is_edited
            ? 'Да'
            : 'Нет';

        return $data;
    }

    final public function updateReportRow(array $data): Model
    {
        $editData = Arr::except(
            $data,
            [
                IReportDKBGuarantee::CompanyUserId,
                IReportDKBGuarantee::LastEditorId,
                IReportDKBGuarantee::IsEdited,
                IReportDKBGuarantee::Id,
            ]
        );

        $editData[ IReportDKBGuarantee::LastEditorId ] = optional(Auth::user())->id;
        $editData[ IReportDKBGuarantee::IsEdited ]     = true;
        if ($editData[ IReportDKBGuarantee::ProgramDirection ]) {
            $editData[ IReportDKBGuarantee::ProgramDirection ] = (string)$editData[ IReportDKBGuarantee::ProgramDirection ];
        }

        return $this
            ->update(
                $data[ IReportDKBGuarantee::Id ],
                $editData
            );
    }

    final public function hasFailedRecords(string $report_id): bool
    {
        return GovernmentGuaranteeReport
                   ::where(IReportDKBGuarantee::ReportId, $report_id)
                   ->whereNotNull(IReportDKBGuarantee::LastFailComment)
                   ->count() > 0;
    }

    final public function getByParent(string $report_id): array
    {
        $records = GovernmentGuaranteeReport
            ::where(IReportDKBGuarantee::ReportId, $report_id)
            ->get()
        ;

        $report = $records
            ->map(
                function ($item)
                {
                    return $item
                        ->only(
                            [
                                IReportDKBGuarantee::LoanTarget,
                                IReportDKBGuarantee::Industry,
                                IReportDKBGuarantee::LenderBank,
                                IReportDKBGuarantee::LoanAmount,
                                IReportDKBGuarantee::CurrentEmployeesCount,
                                IReportDKBGuarantee::NewJobsPlacesCount,
                                IReportDKBGuarantee::ProjectLocation,
                                IReportDKBGuarantee::ProgramDirection,
                            ]
                        );
                }
            )
            ->toArray()
        ;

        return $report;
    }

    final public function getFileInfo(): array
    {
        return [
            'file'   => '/reports/government-programs/GosProgramsGuarantee.mrt',
            'source' => 'GosProgrammi_garantirovanie',
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
                if ($field === IReportDKBGuarantee::ProgramCityId) {
                    $fieldName = trans(
                        IReportDKBGuarantee::ReportFileFieldsNames[ IReportDKBGuarantee::ProjectRegion ]
                    );
                } elseif ($field === IReportDKBGuarantee::ProgramDistrictId) {
                    $fieldName = trans(
                        IReportDKBGuarantee::ReportFileFieldsNames[ IReportDKBGuarantee::ProjectLocation ]
                    );
                } elseif (array_key_exists($field, IReportDKBGuarantee::ReportFileFieldsNames)) {
                    $fieldName = trans(IReportDKBGuarantee::ReportFileFieldsNames[ $field ]);
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
            IReportDKBGuarantee::LoanAmount            => 'required|numeric',
            IReportDKBGuarantee::ProgramCityId         => 'required|uuid|exists:cities,id',
            IReportDKBGuarantee::NewJobsPlacesCount    => 'nullable|integer',
            IReportDKBGuarantee::CurrentEmployeesCount => 'nullable|integer',
            IReportDKBGuarantee::LoanTarget            => 'required|string',
            IReportDKBGuarantee::Industry              => 'required|string',
            IReportDKBGuarantee::ProgramDirection      => 'required|numeric',
            IReportDKBGuarantee::LenderBank            => 'required|string',
        ];

        if (!$data[ IReportDKBGuarantee::IsRegionProject ]) {
            $validations[ IReportDKBGuarantee::ProgramDistrictId ] = 'required|uuid|exists:districts,id';
        }

        return Validator::make(
            $data,
            $validations,
            [
                IReportDKBGuarantee::ProgramDistrictId . '.required_unless' => 'Поле введено не корректно.',
                IReportDKBGuarantee::ProgramDistrictId . '.required'        => 'Поле введено не корректно.',
                IReportDKBGuarantee::ProgramDistrictId . '.uuid'            => 'Не определен район.',
                IReportDKBGuarantee::ProgramCityId . '.required'            => 'Поле введено не корректно.',
                IReportDKBGuarantee::ProgramCityId . '.uuid'                => 'Не определен город.',
            ]
        );
    }


}
