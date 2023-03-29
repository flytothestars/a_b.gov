<?php

namespace App\Http\Requests\API\Telegram;

use Illuminate\Foundation\Http\FormRequest;

class VerifyTelegramIdRequest extends FormRequest
{
    final public function authorize(): bool
    {
        return true;
    }

    final public function rules(): array
    {
        return [
            'telegram-user-id' => 'required|numeric',
        ];
    }
}
