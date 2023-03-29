<?php

namespace App\Imports;

use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use App\Models\Report\GovernmentProgram\GovernmentGuaranteeReport;
use App\Repositories\Enums\CitiesEnum;
use App\Repositories\Enums\DistrictsEnum;
use App\Contracts\GovernmentProgramsReports\IReportTypes;
use App\Models\Organization;
use App\Helpers\HelperExcelImport;

class DKBGuaranteeImport implements ToModel, WithStartRow, WithCalculatedFormulas
{
    use Importable;

    public $data;

    private $report_id;
    private $helper;

    /**
     * DKBGuaranteeImport constructor.
     *
     * @param $report_id
     */
    public function __construct($report_id)
    {
        $this->report_id = $report_id;
        $this->helper    = new HelperExcelImport();
    }


    public function startRow(): int
    {
        return 3;
    }

    /*public function limit(): int
    {
        return 3;
    }*/

    public function model(array $row)
    {
        $companyType = $row[ 1 ] ?? null;
        $guaranteeKind = $row[ 27 ] ?? null;

        if($companyType)
        {
            $companyType = trim(Str::upper($companyType));
        }

        if($guaranteeKind)
        {
            $guaranteeKind = trim(Str::upper($guaranteeKind));
        }

        $record = new GovernmentGuaranteeReport(
            [
                'report_id'                         => $this->report_id,
                'number'                            => $row[ 0 ] ?? null,
                'company_type'                      => $companyType,
                'name'                              => $row[ 2 ] ?? null,
                'project_description'               => $row[ 3 ] ?? null,
                'loan_target'                       => $row[ 4 ] ?? null,
                'bank_issue_date'                   => $this->helper->validateDate($row[ 5 ] ?? null),
                'bank_uo_decision_date'             => $this->helper->validateDate($row[ 6 ] ?? null),
                'industry'                          => $row[ 7 ] ?? null,
                'sub_industry'                      => $row[ 8 ] ?? null,
                'lender_bank'                       => $row[ 9 ] ?? null,
                'loan_amount'                       => $row[ 10 ] ?? null,
                'loan_guarantee'                    => $row[ 11 ] ?? null,
                'loan_guarantee_period'             => $row[ 12 ] ?? null,
                'foundation_decision_date'          => $this->helper->validateDate($row[ 13 ] ?? null),
                'sign_guarantee_agreement_date'     => $this->helper->validateDate($row[ 14 ] ?? null),
                'current_employers_count'           => $this->helper->getIntegerIfEmpty($row[ 16 ] ?? null),
                'new_jobs_places_count'             => $this->helper->getIntegerIfEmpty($row[ 17 ] ?? null),
                'women_entrepreneurship_compliance' => $this->helper->yesNo($row[ 18 ] ?? null),
                'company_head_date_of_birth'        => $this->helper->validateDate($row[ 19 ] ?? null),
                'project_region'                    => $row[ 20 ] ?? null,
                'project_location'                  => $this->helper->mbUcFirst($row[ 21 ] ?? null, "utf8"),
                'project_location_in_monocity'      => $this->helper->yesNo($row[ 22 ] ?? null),
                'dkb_program'                       => $row[ 23 ] ?? null,
                'program_direction'                 => $row[ 24 ] ?? null
                        ? $this->helper->getParsedNumber($row[ 24 ])
                        : null,
                'funding_source'                    => $row[ 25 ] ?? null,
                'loan_percent'                      => $this->helper->getDoublePercent($row[ 26 ] ?? null),
                'guarantee_kind'                    => $guaranteeKind,
                'guarantee_end_date'                => $this->helper->validateDate($row[ 28 ] ?? null),
                'guarantee_expired'                 => $this->helper->yesNo($row[ 29 ] ?? null),
                'project_status'                    => $row[ 30 ] ?? null,
                'guarantee_expire_date'             => $this->helper->validateDate($row[ 31 ] ?? null),
                'bank_pay_on_demand_amount'         => $row[ 32 ] ?? null,
                'bin_iin'                           => $row[ 33 ] ?? null,
                'rf_manager_full_name'              => $row[ 34 ] ?? null,
                'year'                              => $row[ 35 ] ?? null,
                'quarter'                           => $row[ 36 ] ?? null
                        ? $this->helper->getParsedNumber($row[ 36 ])
                        : null,
                'portfolio_guarantee'               => $this->helper->yesNo($row[ 37 ] ?? null),
                'pg_commission_registration_date'   => $row[ 38 ] ?? null,
                'program_city_id'                   => $row[ 20 ] ?? null
                        ? $this->helper->getRegionId($row[ 20 ])
                        : null,
                'is_region_project'                 => isset($row[ 20 ], $row[ 21 ])
                                                       && (Str::lower($row[ 20 ]) === Str::lower($row[ 21 ]))
                    ? 1
                    : 0,
                'program_district_id'               => isset($row[ 20 ], $row[ 21 ])
                                                       && (Str::lower($row[ 20 ]) === Str::lower($row[ 21 ]))
                    ? null
                    : $this->helper->getDistrictId($row[ 21 ] ?? null),
                'company_user_id'                   => $this->helper->getCompanyUserId($row[ 33 ] ?? null),
            ]
        );

        $this->data[] = $record;
        return $record;
    }


    public function getData()
    {
        return $this->data;
    }
}
