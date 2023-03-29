<?php

namespace App\Imports;

use App\Contracts\GovernmentProgramsReports\IReportTypeAlmatyFinance;
use App\Models\Report\GovernmentProgram\GovernmentAlmatyFinanceReport;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithLimit;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use App\Helpers\HelperExcelImport;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\Rule;

class AlmatyFinanceImport implements ToModel, WithStartRow, WithCalculatedFormulas/*, WithLimit*/
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
            $record       = new GovernmentAlmatyFinanceReport(
                [
                    IReportTypeAlmatyFinance::ReportId                 => $this->report_id,
                    IReportTypeAlmatyFinance::Number                   => $row[ 0 ] ?? null,
                    IReportTypeAlmatyFinance::EntrepreneurName         => $this->formatName($row[ 1 ] ?? null),
                    IReportTypeAlmatyFinance::CompanyBinIin            => $row[ 2 ] ?? null,
                    IReportTypeAlmatyFinance::SubjectSize              => $row[ 3 ] ?? null,
                    IReportTypeAlmatyFinance::PlaceOfImplementation    => $row[ 4 ] ?? null,
                    IReportTypeAlmatyFinance::CreditAmount             => $row[ 5 ] ?? null,
                    IReportTypeAlmatyFinance::LoanRate                 => $this->helper->getDoublePercent(
                        $row[ 6 ] ?? null
                    ),
                    IReportTypeAlmatyFinance::CurrentWorkPlace         => $this->helper->getValidNumber(
                        $row[ 7 ] ?? null
                    ),
                    IReportTypeAlmatyFinance::CreatedWorkPlace         => $this->helper->getValidNumber(
                        $row[ 8 ] ?? null
                    ),
                    IReportTypeAlmatyFinance::BranchOfActivity         => $row[ 9 ] ?? null,
                    IReportTypeAlmatyFinance::OKED                     => $row[ 10 ] ?? null,
                    IReportTypeAlmatyFinance::BusinessOfImplementation => $row[ 11 ] ?? null,
                    IReportTypeAlmatyFinance::PurposeOfTheLoan         => $row[ 12 ] ?? null,
                    IReportTypeAlmatyFinance::ProjectStatus            => $row[ 13 ] ?? null,
                    IReportTypeAlmatyFinance::DateOfIssue => $this->helper->validateDate(
                        $row[ 14 ] ?? null
                    ),
                    IReportTypeAlmatyFinance::LegalAddressOfTheCompany => $row[ 15 ] ?? null,
                    IReportTypeAlmatyFinance::FullNameOfTheHead        => $row[ 16 ] ?? null,
                    IReportTypeAlmatyFinance::Contacts                 => $row[ 17 ] ?? null,
                    IReportTypeAlmatyFinance::ProgramDistrictId        => $this->helper->getDistrictId(
                        $row[ 4 ] ?? null
                    ),
                    IReportTypeAlmatyFinance::CompanyUserId            => $this->helper->getCompanyUserId(
                        $row[ 2 ] ?? null
                    ),
                    IReportTypeAlmatyFinance::CompanyId                => $this->helper->getCompanyId(
                        $row[ 2 ] ?? null
                    ),

                ]
            );
            $this->data[] = $record;
            return $record;
        }
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

    public function Getdata()
    {
        return $this->data;
    }
}
