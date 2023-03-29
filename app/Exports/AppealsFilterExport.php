<?php

namespace App\Exports;

use App\Models\Appeal;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\HasReferencesToOtherSheets;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
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

class AppealsFilterExport implements FromCollection, WithHeadings, HasReferencesToOtherSheets, ShouldAutoSize
{
    use Exportable;

    private $filters;
    private $appeal;

    public function __construct($appeal, $filters = null)
    {
        $this->appeal = $appeal;
        $this->filters = $filters;
    }

    public function headings(): array
    {
        return [
            'Наименование фильтра',
            'Значение',
        ];
    }

    public function collection()
    {

        $filterArray = collect();
        if (array_key_exists('category_id', $this->filters))
            $filterArray->push([0 => 'Категория', 1 => $this->appeal->category->name]);



        if (array_key_exists('appeal_status_id', $this->filters))
            $filterArray->push([0 => 'Статус', 1 => $this->appeal->clientAppealStatus->name]);

        if (array_key_exists('district_id', $this->filters))
            $filterArray->push([0 => 'Район', 1 => $this->appeal->district->name]);
        if (array_key_exists('start_date', $this->filters))
            $filterArray->push([0 => 'Начиная с', 1 => $this->filters['start_date']]);
        if (array_key_exists('end_date', $this->filters))
            $filterArray->push([0 => 'Заканчивая', 1 => $this->filters['end_date']]);

        return $filterArray;
    }


}
