<?php

namespace App\Http\Requests\API\Telegram;

use Illuminate\Foundation\Http\FormRequest;

class FillProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    final public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    final public function rules(): array
    {
        return [
            'telegram-user-id' => 'required|numeric|exists:users,telegram_user_id',
            'email'            => 'required|email',
            'first_name'       => 'required|string|max:256',
            'second_name'      => 'nullable|string|max:256',
            'last_name'        => 'required|string|max:256',
            'position'         => 'required|string|max:1024',
            'company_name'     => 'required|string|max:2048',
            'iin'              => 'required|string|max:20',
            'description'      => 'nullable|string',
            'industries_id'    => 'required|string',
            'phone'            => 'required|string|max:20',
        ];
    }
}
