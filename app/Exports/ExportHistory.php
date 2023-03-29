<?php

namespace App\Exports;

use App\Services\LoansExportServices;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportHistory implements FromView
{
    public function view() : View
    {
        ini_set('memory_limit', '-1');
        $loans = LoansExportServices::exportHistory()->get();

        return view('exports.history', compact('loans'));
    }
}
