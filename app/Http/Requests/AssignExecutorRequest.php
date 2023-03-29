<?php

namespace App\Http\Requests;

use App\Repositories\Enums\RoleEnum;
use Illuminate\Foundation\Http\FormRequest;

class AssignExecutorRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if (
            $this->user()->hasRole(RoleEnum::Distributor)
            || $this->user()->hasRole(RoleEnum::Head) || $this->user()->hasRole(RoleEnum::IEManager)
        ) {
            return [
                'executor_id' => 'required|exists:users,id',
                'district_id' => 'required|uuid|exists:districts,id',
                'industry_id' => 'required|uuid|exists:industries,id',
                'comment'     => 'nullable|string',
            ];
        }

        return [
            'executor_id' => 'required|exists:users,id',
            'district_id' => 'required|uuid|exists:districts,id',
            'comment'     => 'nullable|string',
        ];
    }
}
