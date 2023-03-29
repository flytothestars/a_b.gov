<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class SearchServiceRequest extends FormRequest
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
                return[
                        'content' => 'string',
                        //'type_id' => 'required'

                    ] + $rules;
        }

        return $rules;
    }

}
