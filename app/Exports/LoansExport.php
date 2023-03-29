<?php


namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Services\LoansExportServices;


class LoansExport implements FromView
{
    private $filterForExcel;

    public function __construct($filterForExcel)
    {
        $this->filterForExcel = $filterForExcel;
    }

    public function view() : View
    {
        ini_set('memory_limit', '-1');
        $loans = LoansExportServices::exportLoansData($this->filterForExcel);
        //dd($loans);
        return view('exports.loans', compact('loans'));
    }
}
