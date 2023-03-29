<?php


namespace App\Http\Requests\Integration;

use Illuminate\Foundation\Http\FormRequest;


class OrganizationRequest extends FormRequest
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
                    'id' => 'required|uuid|unique:organizations,mio_id',
                    'iin' => 'required|string',
                    'description' => 'nullable|string',
                    'position' => 'nullable|string',
                    'name' => 'required|string',
                    'full_name' => 'required|string',
                    'is_individual' => 'nullable|boolean',
                ];
            case 'PUT':
                return [
                    'id' => 'required|uuid|exists:organizations,mio_id',
                    'iin' => 'required|string',
                    'description' => 'nullable|string',
                    'position' => 'nullable|string',
                    'name' => 'required|string',
                    'full_name' => 'required|string',
                    'is_individual' => 'nullable|boolean',
                ];
        }

        return [];
    }

}


