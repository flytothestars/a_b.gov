<?php

namespace App\Http\Requests\API\Telegram;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserAccountRequest extends FormRequest
{
    final public function authorize(): bool
    {
        return true;
    }

    final public function rules(): array
    {
        return [
            'phone'            => [
                'required',
                'string',
                'max:12',
                'unique:users,phone',
            ],
            'password'         => [ 'required', 'string', 'min:8' ],
            'confirm-password' => [ 'required', 'string', 'min:8', 'same:password' ],
            'telegram-user-id' => [ 'required', 'numeric', 'unique:users,telegram_user_id' ],
        ];
    }
}
