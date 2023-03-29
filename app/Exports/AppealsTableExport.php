<?php

namespace App\Exports;

use App\Models\Appeal;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\HasReferencesToOtherSheets;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Events\BeforeSheet;
use App\Repositories\Enums\FlowTypeEnum;

class AppealsTableExport implements FromCollection, WithHeadings, HasReferencesToOtherSheets, WithMapping, WithColumnWidths, WithStyles, ShouldAutoSize
{
    use Exportable;

    private $appeals;

    public function __construct($appeals)
    {
        $this->appeals = $appeals;
    }

    public function headings(): array
    {
        return [
            'ФИО',
            'Заявитель',
            'ИИН/БИН',
            'Контакты',
            'Содержание',
            'Категория',
            'Источник',
            'Статус',
            'Дата создание',
            'Консультант',
            'Статус заявки',
            'Дата изменение заявки',
            'Примачание',
            //Old code
            /*
            'Заявитель',
            'Содержание',
            'Категория',
            'Статус',
            'Консультант',
            'Источник',
            'Дата создания',
            'Результат исполнения/отказа',
            'Комментарий при исполнении/отказе',
            'Контакты',
            'Направлено в УПиИ',
            'Район',
            'Куратор района'
            */
        ];
    }

    public function collection()
    {
        return $this->appeals;
    }


    public function map($invoice): array
    {
        //Code

        $arr = array();
        //dd($invoice->distributor->profile->last_name);
        //dd($invoice->business->organization->iin);
        
        // ФИО
        array_push($arr, isset($invoice->business->organization->full_name) ? $invoice->business->organization->full_name : 'Нет данных');
        
        // Заявитель
        if ($invoice->business) {
            if ($invoice->business->name)
                array_push($arr, $invoice->business->name); // Excel shows
            else if ($invoice->business->display_name)
                array_push($arr, $invoice->business->display_name);
        }
        // ИИН/БИН
        array_push($arr, isset($invoice->business->organization->iin) ? $invoice->business->organization->iin : 'Нет данных');
        // Контакты
        if ($invoice->client) {
            array_push($arr, $invoice->client->phone);
        } else {
            $contacts = optional($invoice->business)->businessContacts;

            $contactsText = "";

            if($contacts) {
                foreach ($contacts as $contact) {
                    $contactsText = $contactsText . $contact->phone_number . ", ";
                }
            }

            array_push($arr, $contactsText);
        }
        // Содержание
        array_push($arr, $invoice->content);
        // Категория
        array_push($arr, $invoice->category ? $invoice->category->name : '');
        // Источник
        array_push($arr, $invoice->appealSourceType ? $invoice->appealSourceType->name : 'Нет');
        // Статус
        array_push($arr, $invoice->clientAppealStatus ? $invoice->clientAppealStatus->name : '');
        //Дата создание
        array_push($arr, $invoice->createDate);
        // Консультант
        if ($invoice->distributor && $invoice->distributor->profile) {
            array_push($arr, $invoice->distributor->profile->last_name . ' ' . $invoice->distributor->profile->first_name);
        } else {
            array_push($arr, 'Нет');
        }
        // Статус заявки
        array_push($arr, $invoice->appealStatus ? $invoice->appealStatus->name : '');
        //Дата закрытия заявки
        array_push($arr, $invoice->updateDate);
        //Примачание
        array_push($arr, $invoice->comment ? $invoice->comment : 'Нет примечание');    
         
        
        /*
        //Original
        $arr = array();
        if ($invoice->client && $invoice->client->profile) {
            array_push($arr, $invoice->client->profile->last_name . ' ' . $invoice->client->profile->first_name);
        } else if ($invoice->business) {
            if ($invoice->business->name)
                array_push($arr, $invoice->business->name); // Excel shows
            else if ($invoice->business->display_name)
                array_push($arr, $invoice->business->display_name);
        } else {
            array_push($arr, 'Не назначен');
        }

        array_push($arr, $invoice->content);
        array_push($arr, $invoice->category ? $invoice->category->name : '');
        array_push($arr, $invoice->clientAppealStatus ? $invoice->clientAppealStatus->name : '');

        if ($invoice->distributor && $invoice->distributor->profile) {
            array_push($arr, $invoice->distributor->profile->last_name . ' ' . $invoice->distributor->profile->first_name);
        } else {
            array_push($arr, 'Нет');
        }

        // if ($invoice->executor && $invoice->executor->profile) {
        //     array_push($arr, $invoice->executor->profile->last_name . ' ' . $invoice->executor->profile->first_name);
        // } else {
        //     array_push($arr, 'Нет');
        // }

        // if ($invoice->coExecutor && $invoice->coExecutor->profile) {
        //     array_push($arr, $invoice->coExecutor->profile->last_name . ' ' . $invoice->coExecutor->profile->first_name);
        // } else {
        //     array_push($arr, 'Нет');
        // }
        // if ($invoice->upiCurator && $invoice->upiCurator->profile) {
        //     array_push($arr, $invoice->upiCurator->profile->last_name . ' ' . $invoice->upiCurator->profile->first_name);
        // } else {
        //     array_push($arr, 'Нет');
        // }
        array_push($arr, $invoice->appealSourceType ? $invoice->appealSourceType->name : 'Нет');
        array_push($arr, $invoice->createDate);
        if ($invoice->appealStatus)
            array_push($arr, $invoice->appealStatus->name);
        else
            array_push($arr, 'Нет');
        array_push($arr, $invoice->comment);

        if ($invoice->client) {
            array_push($arr, $invoice->client->phone);
        } else {
            $contacts = optional($invoice->business)->businessContacts;

            $contactsText = "";

            if($contacts) {
                foreach ($contacts as $contact) {
                    $contactsText = $contactsText . $contact->phone_number . ", ";
                }
            }

            array_push($arr, $contactsText);
        }
        if ($invoice->flow_type_id && $invoice->flow_type_id===FlowTypeEnum::Upi)
            array_push($arr, 'Да');
        else
            array_push($arr, 'Нет');
        if ($invoice->district)
            array_push($arr, $invoice->district->name);
        else
            array_push($arr, 'Нет');

        if ($invoice->districtCurator && $invoice->districtCurator->profile)
            array_push($arr,  $invoice->districtCurator->profile->last_name . ' ' . $invoice->districtCurator->profile->first_name);
        else
            array_push($arr, 'Нет');
        */
        return $arr;
    }

    public function styles(Worksheet $sheet)
    {

        return [
            // Style the first row as bold text.
            1 => ['font' => ['bold' => true]],

        ];
    }

    public function columnWidths(): array
    {
        return [
            'B' => 45,
        ];
    }


}
