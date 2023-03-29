<?php

namespace App\Imports;

use App\Models\Report\GovernmentProgram\GovernmentSubsidiesReport;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use App\Helpers\HelperExcelImport;

class DKBSubsidiesImport implements ToModel, WithStartRow, WithCalculatedFormulas/*, WithLimit*/
{
    use Importable;

    public  $data;
    private $helper;
    private $report_id;

    public function __construct($report_id)
    {
        $this->helper    = new HelperExcelImport();
        $this->report_id = $report_id;
    }

    public function startRow(): int
    {
        return 2;
    }


    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function model(array $row)
    {
        if ($row[ 0 ]) {
            $record       = new GovernmentSubsidiesReport(
                [
                    'report_id'                                       => $this->report_id,
                    'number'                                          => $row[ 0 ] ?? null,
                    'stb_name'                                        => $this->formatStbName($row[ 1 ] ?? null),
                    'entrepreneur_s_name'                             => $row[ 2 ] ?? null,
                    'bin_iin'                                         => $row[ 3 ] ?? null,
                    'subject_size'                                    => $row[ 4 ] ?? null,
                    'district'                                        => $this->helper->mbUcFirst(
                        $row[ 5 ] ?? null,
                        "utf8"
                    ),
                    'credit_amount'                                   => $this->helper->getValidNumber(
                        $row[ 6 ] ?? null
                    ),
                    'loan_rate'                                       => $this->helper->getDoublePercent(
                        $row[ 7 ] ?? null
                    ),
                    'subsidies'                                       => $this->helper->getDoublePercent(
                        $row[ 8 ] ?? null
                    ),
                    'the_amount_of_the_planned_subsidy_until'         => $row[ 9 ] ?? null,
                    'current_number_of_work_places'                   => $row[ 10 ] ?? null,
                    'number_of_created_workplaces'                    => $row[ 11 ] ?? null,
                    'industry_of_activity'                            => $row[ 12 ] ?? null,
                    'oked'                                            => $row[ 13 ] ?? null,
                    'purpose_of_the_loan'                             => $this->formatPurposeOfTheLoan(
                        $row[ 14 ] ?? null
                    ),
                    'direction_by_program'                            => $row[ 15 ] ?? null,
                    'the_essence_of_the_question_is_new_prolongation' => $row[ 16 ] ?? null,
                    'date_of_registration_of_the_application'         => $this->helper->validateDate(
                        $row[ 17 ] ?? null
                    ),
                    'protocol_number_of_the_fund_ma_pm'               => $row[ 18 ] ?? null,
                    'date_of_the_minutes_of_the_fund_ma_pm'           => $this->helper->validateDate(
                        $row[ 19 ] ?? null
                    ),
                    'expiration_date_of_rks_fund'                     => $this->helper->validateDate(
                        $row[ 20 ] ?? null
                    ),
                    'date_of_sending_the_letter_to_stb'               => $this->helper->validateDate(
                        $row[ 21 ] ?? null
                    ),
                    'yur_company_address'                             => $row[ 22 ] ?? null,
                    'full_name_of_the_head'                           => $row[ 23 ] ?? null,
                    'contacts'                                        => $row[ 24 ] ?? null,
                    'program_district_id'                             => $row[ 5 ]
                        ? $this->helper->getDistrictId($row[ 5 ])
                        : null,
                    'company_user_id'                                 => $this->helper->getCompanyUserId(
                        $row[ 3 ] ?? null
                    ),
                    'company_id'                                      => $this->helper->getCompanyId($row[ 3 ] ?? null),
                ]
            );
            $this->data[] = $record;
            return $record;
        }
    }

    public function Getdata()
    {
        return $this->data;
    }

    private function formatPurposeOfTheLoan($item)
    {
        if ($item === null) {
            return null;
        }
        $origin = $item;

        $item = Str::replace(["\t","\n"], '', $item);
        $item = trim($item);

        $wordsCount = 0;
        $wordsCount += count(explode(' ', $item));
        if(strpos($item,'/') !== false){
            $wordsCount += count(explode('/', $item)) -1;
        }

        if (
            $wordsCount === 1
        ) {
            $item = Str::ucfirst(Str::lower($item));

            if ($item === 'Пос') {
                $item = Str::upper($item);
            }
            if ($item === 'Реф') {
                $item = 'Рефинансирование';
            }
        }

        return $item;
    }

    private function formatStbName($item)
    {
        if ($item === null) {
            return null;
        }


        $wordsCount = 0;
        $wordsCount += count(explode(' ', $item));
        if(strpos($item,'/') !== false){
            $wordsCount += count(explode('/', $item)) -1;
        }

        if ($wordsCount === 1) {
            $item = Str::ucfirst(Str::lower($item));
        }
        $item = Str::replace([ '«', '»', '"' ], '', $item);

        return trim($item);
    }


}
