<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Services\MioExportServices;

class ExportMio implements FromView
{
    public function view() : View
    {
        ini_set('memory_limit', '-1');
        $loans = MioExportServices::exportLoansData();
        //dd($loans[0]);
        return view('exports.mio', compact('loans'));
    }
}
