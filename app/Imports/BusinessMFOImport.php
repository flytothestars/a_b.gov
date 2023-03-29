<?php

namespace App\Imports;

use App\Contracts\GovernmentProgramsReports\IReportAlmatyBusinessMFO;
use App\Models\Report\GovernmentProgram\GovernmentBusinessMFOReport;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithLimit;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use App\Helpers\HelperExcelImport;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\Rule;

class BusinessMFOImport implements ToModel, WithStartRow, WithCalculatedFormulas/*, WithLimit*/
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
        if ($row[ 0 ]) {
            $record       = new GovernmentBusinessMFOReport(
                [
                    IReportAlmatyBusinessMFO::ReportId              => $this->report_id,
                    IReportAlmatyBusinessMFO::Number                => $row[ 0 ] ?? null,
                    IReportAlmatyBusinessMFO::Name                  => $row[ 1 ] ?? null,
                    IReportAlmatyBusinessMFO::CurrentActivity       => $row[ 2 ] ?? null,
                    IReportAlmatyBusinessMFO::PlannedTypeOfActivity => $row[ 3 ] ?? null,
                    IReportAlmatyBusinessMFO::Place                 => $row[ 4 ] ?? null,
                    IReportAlmatyBusinessMFO::LimitAmount           => $row[ 5 ] ?? null,
                    IReportAlmatyBusinessMFO::WorkPlace => $this->helper->getIntegerIfEmpty(
                        $row[ 6 ] ?? null
                    ),
                    IReportAlmatyBusinessMFO::CompanyBinIin         => $row[ 7 ] ?? null,
                    IReportAlmatyBusinessMFO::ProgramDistrictId     => $this->helper->getDistrictId($row[ 4 ] ?? null),
                    IReportAlmatyBusinessMFO::CompanyUserId         => $this->helper->getCompanyUserId(
                        $row[ 7 ] ?? null
                    ),
                    IReportAlmatyBusinessMFO::CompanyId             => $this->helper->getCompanyId($row[ 7 ] ?? null),

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
