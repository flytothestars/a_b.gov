<?php

namespace App\Exports;

use App\Models\Appeal;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Events\BeforeSheet;

class StaticByDistrict implements WithMultipleSheets
{
    use Exportable;
    use RegistersEventListeners;


    private $appealsByStatus;
    private $breakByCategories;

    public function __construct($appealsByStatus, $breakByCategories)
    {
        $this->appealsByStatus = $appealsByStatus;     
        $this->breakByCategories = $breakByCategories;
    }

    public function sheets(): array
    {
        return [
            'Статистика обращений по статусу' => new ByDistrict($this->appealsByStatus),
            'Разбивка по категориям' => new ByDictCategories($this->breakByCategories),
        ];
    }




}
