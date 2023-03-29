<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DateFilterRequest extends FormRequest
{

    final public function authorize(): bool
    {
        return true;
    }

    final public function rules(): array
    {
        return [
            'date' => 'nullable|date_format:Y-m-d',
        ];
    }

}
