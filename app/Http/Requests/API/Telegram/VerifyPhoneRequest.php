<?php

namespace App\Http\Requests\API\Telegram;

use Illuminate\Foundation\Http\FormRequest;

class VerifyPhoneRequest extends FormRequest
{
    final public function authorize(): bool
    {
        return true;
    }

    final public function rules(): array
    {
        return [
            'phone' => 'required|string|max:12',
        ];
    }
}
