<?php

namespace App\Http\Requests\API\Telegram;

use Illuminate\Foundation\Http\FormRequest;

class CreateAppealRequest extends FormRequest
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
            'content'          => 'required|string',
            'category_id'      => 'required|uuid:exists:service_groups,id',
            'file'             => 'nullable',
        ];
    }
}
