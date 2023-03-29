<?php

namespace App\Http\Requests\Integration;

use Illuminate\Foundation\Http\FormRequest;

class ActivitySectionRequest extends FormRequest
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
                    'activity_type_id' => 'required|uuid|exists:activity_types,mio_id'
                ];
        }

        return [];
    }

}
