<?php

namespace App\Imports;

use App\Contracts\GovernmentProgramsReports\IReportAlmatyBusinessZhibekZholy;
use App\Models\City;
use App\Models\Report\GovernmentProgram\GovernmentZhibekZholyReport;
use App\Repositories\Enums\CitiesEnum;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithLimit;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use App\Contracts\GovernmentProgramsReports\IReportTypes;
use App\Helpers\HelperExcelImport;

class ZhibekZholyImport implements ToModel, WithStartRow, WithCalculatedFormulas/*, WithLimit*/
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

    public function limit(): int
    {
        return 3;
    }


    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function model(array $row)
    {
        if ($row[ 0 ]) {
            $record       = new GovernmentZhibekZholyReport(
                [
                    'report_id'                                                  => $this->report_id,
                    IReportAlmatyBusinessZhibekZholy::Number                     => $row[ 0 ] ?? null,
                    IReportAlmatyBusinessZhibekZholy::Program                    => $row[ 1 ] ?? null,
                    IReportAlmatyBusinessZhibekZholy::NameOfTheBank              => $this->formatName(
                        $row[ 2 ] ?? null
                    ),
                    IReportAlmatyBusinessZhibekZholy::Region                     => $row[ 3 ] ?? null,
                    IReportAlmatyBusinessZhibekZholy::BorrowerName               => $row[ 4 ] ?? null,
                    IReportAlmatyBusinessZhibekZholy::LegalStatus                => $row[ 5 ] ?? null,
                    IReportAlmatyBusinessZhibekZholy::LoanIssueDate              => $this->helper->validateDate(
                        $row[ 6 ] ?? null
                    ),
                    IReportAlmatyBusinessZhibekZholy::LoanTerm                   => $this->castNumberToInt(
                        $row[ 7 ] ?? null
                    ),
                    IReportAlmatyBusinessZhibekZholy::LoanAmount                 => $row[ 8 ] ?? null,
                    IReportAlmatyBusinessZhibekZholy::ApprovedLoanAmount         => $row[ 9 ] ?? null,
                    IReportAlmatyBusinessZhibekZholy::FundsOwnAmount             => $row[ 10 ] ?? null,
                    IReportAlmatyBusinessZhibekZholy::ActualAmount               => $row[ 11 ] ?? null,
                    IReportAlmatyBusinessZhibekZholy::FundActualAmount           => $row[ 12 ] ?? null,
                    IReportAlmatyBusinessZhibekZholy::BankActualAmount           => $row[ 13 ] ?? null,
                    IReportAlmatyBusinessZhibekZholy::PrincipalRepaymentPeriod   => $row[ 14 ] ?? null,
                    IReportAlmatyBusinessZhibekZholy::RemunerationPaymentPeriod  => $row[ 15 ] ?? null,
                    IReportAlmatyBusinessZhibekZholy::LoanInterestRate           => $this->helper->getDoublePercent(
                        $row[ 16 ] ?? null
                    ),
                    IReportAlmatyBusinessZhibekZholy::EffectiveLoanRate          => $this->helper->getDoublePercent(
                        $row[ 17 ] ?? null
                    ),
                    IReportAlmatyBusinessZhibekZholy::LoanObject                 => $this->formatName(
                        $row[ 18 ] ?? null
                    ),
                    IReportAlmatyBusinessZhibekZholy::PurposeOfBorrowedFunds     => $row[ 19 ] ?? null,
                    IReportAlmatyBusinessZhibekZholy::PlaceOfImplementation      => isset($row[ 3 ], $row[ 20 ])
                                                                                    && ($row[ 3 ] === $row[ 20 ])
                        ? $this->getRegionName($row[ 20 ] ?? null)
                        : $row[ 20 ] ?? null,
                    IReportAlmatyBusinessZhibekZholy::OKED                       => $row[ 21 ] ?? null,
                    IReportAlmatyBusinessZhibekZholy::SubSectorOKED              => $row[ 22 ] ?? null,
                    IReportAlmatyBusinessZhibekZholy::NewWorkplaces              => $row[ 23 ] ?? null,
                    IReportAlmatyBusinessZhibekZholy::AuthorizedBankDecisionNo   => $row[ 24 ] ?? null,
                    IReportAlmatyBusinessZhibekZholy::AuthorizedBankDecisionDate => $this->helper->validateDate(
                        $row[ 25 ] ?? null
                    ),
                    IReportAlmatyBusinessZhibekZholy::LoanAgreementNo            => $row[ 26 ] ?? null,
                    IReportAlmatyBusinessZhibekZholy::LoanAgreementDate          => $this->helper->validateDate(
                        $row[ 27 ] ?? null
                    ),
                    IReportAlmatyBusinessZhibekZholy::CompanyBinIin              => $row[ 28 ] ?? null,
                    IReportAlmatyBusinessZhibekZholy::BusinessProject            => $row[ 29 ] ?? null,
                    IReportAlmatyBusinessZhibekZholy::ProgramCityId              => $row[ 3 ] ?? null
                            ? $this->helper->getRegionId($row[ 3 ])
                            : null,
                    IReportAlmatyBusinessZhibekZholy::IsRegionProject            => isset($row[ 3 ], $row[ 20 ])
                                                                                    && ($row[ 3 ] === $row[ 20 ])
                        ? 1
                        : 0,
                    IReportAlmatyBusinessZhibekZholy::CompanyId                  => $this->helper->getCompanyId(
                        $row[ 28 ] ?? null
                    ),
                    IReportAlmatyBusinessZhibekZholy::CompanyUserId              => $this->helper->getCompanyUserId(
                        $row[ 28 ] ?? null
                    ),

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


    function getRegionName($string)
    {
        foreach (CitiesEnum::CitiesList as $key => $value) {
            if (strpos(Str::lower($string), Str::lower($value)) !== false) {
                return City::find($key)->name;
            }
        }
        return null;
    }

    private function formatName($item)
    {
        if ($item === null) {
            return null;
        }

        $wordsCount = 0;
        $wordsCount += count(explode(' ', $item));
        if (strpos($item, '/') !== false) {
            $wordsCount += count(explode('/', $item)) - 1;
        }

        if ($wordsCount === 1) {
            $item = Str::ucfirst(Str::lower($item));
        }
        $item = Str::replace([ '«', '»', '"' ], '', $item);

        return trim($item);
    }

    private function castNumberToInt($number)
    {
        if (is_int($number)) {
            return $number;
        }
        if (is_float($number)) {
            return round($number);
        }
        return null;
    }
}
