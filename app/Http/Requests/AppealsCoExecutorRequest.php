<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class AppealsCoExecutorRequest extends FormRequest
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

            case 'POST':
                return[
                        'coexecutor_id' => 'required',
                        'appeals_id' => 'required'
                    ] + $rules;
        }

        return $rules;
    }

}
