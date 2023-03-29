<?php

namespace App\Exports;

use App\Models\Appeal;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;


class TransactionsExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    public function query()
    {
        return Appeal::query();
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
        ];
    }

    public function map($invoice): array
    {
        //dd($transaction);
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
         
        return $arr;
    }

    public function fields(): array
    {
        return [
            'id',
            'description',
            'amount',
            'user',
            'created_at'
        ];
    }
}