<?php

namespace App\Http\Requests\Integration;

use Illuminate\Foundation\Http\FormRequest;

class ActivityGroupRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        switch ($this->getMethod()) {
            case 'POST':
                return [
                    'id' => 'required|uuid',
                    'code' => 'required|string|max:250',
                    'name' => 'required|string|max:250',
                    'activity_section_id' => 'required|uuid|exists:activity_types,mio_id'
                ];
        }

        return [];
    }

}
