<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceFormRequest extends FormRequest
{

    public function authorize() : bool
    {
        return true;
    }

    public function rules() : array
    {
        $rules = [
            'per_page' => '',
            'page' => '',
            'sortBy' => '',
            'sortDesc' => '',
        ];

        switch ($this->getMethod()) {
            case 'GET':
                return [
                ];
            case 'POST':
                return[
                        'serviceName' => 'required|string|max:256',
                        'fio' => 'required|string|max:256',
                        'phone' => 'required|string|max:20',
                        'question' => 'required|string',
                    ] + $rules;
        }

        return $rules;
    }
}
