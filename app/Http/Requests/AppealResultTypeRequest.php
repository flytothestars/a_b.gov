<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppealResultTypeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
        ];

        switch ($this->getMethod()) {
            case 'GET':
                return [
                    'appeal_id' => 'required|uuid|exists:appeals,id',
                    'to_appeal_status_id' => 'required|uuid|exists:appeal_statuses,id',
                ];
        }

        return $rules;
    }
}
