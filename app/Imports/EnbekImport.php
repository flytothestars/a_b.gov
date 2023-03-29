<?php

namespace App\Imports;

use App\Contracts\GovernmentProgramsReports\IReportEnbek;
use App\Models\Report\GovernmentProgram\GovernmentEnbekReport;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithLimit;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use App\Contracts\GovernmentProgramsReports\IReportTypes;
use App\Helpers\HelperExcelImport;

class EnbekImport implements ToModel, WithStartRow, WithCalculatedFormulas/*, WithLimit*/
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
        return 3;
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
        if ($row[ 0 ] && $row[ 3 ]) {
            $record       = new GovernmentEnbekReport(
                [
                    IReportEnbek::ReportId               => $this->report_id,
                    IReportEnbek::Number                 => $row[ 0 ] ?? null,
                    IReportEnbek::STB                    => $row[ 1 ] ?? null,
                    IReportEnbek::Source                 => $row[ 2 ] ?? null,
                    IReportEnbek::CompanyBinIin          => $row[ 3 ] ?? null,
                    IReportEnbek::Borrower               => $row[ 4 ] ?? null,
                    IReportEnbek::Amount                 => $this->helper->getValidNumber($row[ 5 ] ?? null),
                    IReportEnbek::Target                 => $row[ 6 ] ?? null,
                    IReportEnbek::TypeOfActivityIndustry => $row[ 7 ] ?? null,
                    IReportEnbek::ADistrictOfTheCity     => $row[ 8 ] ?? null,
                    IReportEnbek::WorkplacesActual       => $row[ 9 ] ?? null,
                    IReportEnbek::JobsCreated            => $row[ 10 ] ?? null,
                    IReportEnbek::StartUp                => $row[ 11 ] ?? null,
                    IReportEnbek::ProjectStatus          => $row[ 12 ] ?? null,
                    IReportEnbek::Guarantees             => $this->helper->getValidNumber($row[ 13 ] ?? null),
                    IReportEnbek::ProgramDistrictId      => $row[ 8 ] ?? null
                            ? $this->helper->getDistrictId($row[ 8 ])
                            : null,
                    IReportEnbek::CompanyUserId          => $this->helper->getCompanyUserId($row[ 3 ] ?? null),
                    IReportEnbek::CompanyId              => $this->helper->getCompanyId($row[ 3 ] ?? null),
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
}
