<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
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
                return [

                        'email' => 'required|email',
                        'first_name' => 'required|string|max:256',
                        'second_name' => 'nullable|string|max:256',
                        'last_name' => 'required|string|max:256',
                        'position' => 'nullable|string|max:1024',
                        'company_name' => 'nullable|string|max:2048',
                        'iin' => 'required|string|max:20',
                        'description' => 'nullable|string',
                        'industries_id' => 'nullable|string',
                        'phone' => 'required|string|max:20',
                    ] + $rules;
        }

        return $rules;
    }
}
