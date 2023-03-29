<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Employer;

class ImportTaxingData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:taxing';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $path_to_file = public_path() . '/TaxingImport1.xlsx';
        $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($path_to_file);
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
        $spreadsheet = $reader->load($path_to_file);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
        $this->excel($sheetData);
        $this->info('The first file successfully uploaded');

        $path_to_file = public_path() . '/TaxingImport2.xlsx';
        $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($path_to_file);
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
        $spreadsheet = $reader->load($path_to_file);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
        $this->excel($sheetData);
        $this->info('The second file successfully uploaded');

        $path_to_file = public_path() . '/TaxingImport3.xlsx';
        $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($path_to_file);
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
        $spreadsheet = $reader->load($path_to_file);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
        $this->excel($sheetData);
        $this->info('The third file successfully uploaded');
    }

    public function excel($sheetData)
    {
        foreach ($sheetData as $key=>$arr) {
            if ($key == 1) continue;
            $bin_iin = $arr['A'];
            $code_no = $arr['B'];
            $count_np = $arr['C'];
            $risk_degree = $arr['D'];
            $relevance_date = $arr['E'];

            if ($risk_degree == 'высокая') {
                $risk_degree_value = 'high';
            } elseif ($risk_degree == 'средняя') {
                $risk_degree_value = 'medium';
            } else {
                $risk_degree_value = 'low';
            }

            if (!Employer::exists($bin_iin)) {
                Employer::create([
                    'bin_iin' => $bin_iin, 'code_no' => $code_no, 'count_np' => $count_np, 'risk_degree' => $risk_degree_value,
                    'relevance_date' => Carbon::parse($relevance_date)->format('Y-m-d')
                ]);
            }
        }
    }
}
