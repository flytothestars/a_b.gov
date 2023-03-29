<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssignCoExecutorRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'co_executor_id' => 'required|exists:users,id',
            'comment' => 'nullable|string'
        ];
    }
}
