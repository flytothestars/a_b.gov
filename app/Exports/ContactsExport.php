<?php

namespace App\Exports;

use App\Services\LoansExportServices;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ContactsExport implements FromView
{
    private $filterForExcel;

    public function __construct($filterForExcel)
    {
        $this->filterForExcel = $filterForExcel;
    }

    public function view() : View
    {
        ini_set('memory_limit', '-1');
        $contacts = LoansExportServices::exportLoansData3($this->filterForExcel)->get();

        return view('exports.contacts', compact('contacts'));
    }
}
