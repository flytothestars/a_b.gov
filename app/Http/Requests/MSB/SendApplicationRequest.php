<?php

namespace App\Http\Requests\MSB;

use Illuminate\Foundation\Http\FormRequest;

class SendApplicationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'bin'          => 'required|string',
            'program_id'   => 'required|integer',
            'program_type' => 'required|integer',
            'name'         => 'required|string',
            'phone'        => 'required|string',
            'amount'       => 'required|integer',
            'turnover'     => 'required|integer',
            'banks.*'      => 'required|integer',
            'banks'        => 'required|array',
        ];
    }
}
