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
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithTitle;

class ByDistrict implements FromCollection,WithColumnWidths,WithEvents,WithStrictNullComparison,WithCustomStartCell,WithTitle
{
    use Exportable;
    use RegistersEventListeners;


    use Exportable;

    static   $collection;

    public function __construct($arrays) {
        
        $output[] = [''];
        foreach ($arrays as $array) {
            
            $output[] = $array;
            $output[] = [''];
        }
           
        self::$collection = $output;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet  ::class => [self::class, 'afterSheet']
        ];
    }

    public function startCell(): string
    {
        return 'A1';
    }

    public function title(): string
    {
        return 'Статистика обращений по статусу ';
    }
  
    
    public static function afterSheet(AfterSheet $event) 
    {
        $tables = self::$collection;
        $sheet = $event->sheet;
       
        $startRow = 0;
        $row =0;
        
        $alphabet = range('A', 'Z');
        $satrtColumn =  $alphabet[0];


        foreach ($tables as $table) {
            if (!is_array($table)){
            $row = count( $table) +$startRow;

            $column =  $alphabet[count($table[0])-1];
            if($startRow>2){
                $sheet->getStyle('A'.($startRow+1).':'. $column.$row)->applyFromArray([
                            'borders' => [
                                'allBorders' => [
                                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                    'color' => ['argb' => '000000'],
                                ],
                            ],
                ]);
            }
            $sheet->getStyle('B'.($startRow+1).':'. $column.($startRow+1))->getAlignment()->setWrapText(true);
            if($startRow>2){
                $sheet->getStyle('A'.($startRow+1).':'. $column.($startRow+1))->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('a6a6a6');
            }
            $startRow = $row;
            
        }else{
            $startRow +=1;
        }
            
        }
        $sheet->getStyle('B')->getAlignment()->setWrapText(true);
      
        $highestColumn = $event->sheet->getDelegate()->getHighestColumn();
            $highestColumn++;
            for ($column = 'E'; $column !== $highestColumn; $column++) {
                $sheet->getDelegate()->getColumnDimension($column)->setWidth(15);
            }
        

        
    }

    

  

    public function columnWidths(): array
    {
        return [
            'B' => 45,
            'C' => 45,
            'D' => 45,
        ];
    }
    


    public function collection()
    {
        return collect(self::$collection);
    }




}
