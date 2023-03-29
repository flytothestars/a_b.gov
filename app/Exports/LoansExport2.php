<?php

namespace App\Exports;

use App\Services\LoansExportServices;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LoansExport2 implements FromView
{
    private $filterForExcel;

    public function __construct($filterForExcel)
    {
        $this->filterForExcel = $filterForExcel;
    }

    public function view() : View
    {
        ini_set('memory_limit', '-1');
        $loans = LoansExportServices::exportLoansData2($this->filterForExcel)->get();

        return view('exports.loans2', compact('loans'));
    }
}
