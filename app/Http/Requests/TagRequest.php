<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
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
                    'search_text' => ''
                ];
            case 'POST':
                return[
                        'id' => 'required|uuid',
                        'name' => 'required|string|max:256',
                        'translations' => ''
                    ] + $rules;
            case 'PUT':
                return [
                        'id' => 'required|uuid|exists:tags,id',
                        'name' => 'string|max:256',
                        'translations' => ''
                    ] + $rules;
            case 'DELETE':
                return [
                    'id' => 'required|uuid|exists:tags,id'
                ];
        }

        return $rules;
    }
}
