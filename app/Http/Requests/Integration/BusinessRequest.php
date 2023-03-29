<?php


namespace App\Http\Requests\Integration;

use Illuminate\Foundation\Http\FormRequest;


class BusinessRequest extends FormRequest
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
                    'id' => 'required|uuid|unique:businesses,mio_id',
                    'organization_id' => 'nullable|uuid|exists:organizations,mio_id',
                    'name' => 'required|string',
                    'display_name' => 'required|string',
                    'address_line' => 'required|string',
                    'address_line_stat' => 'required|string',
                    'source' => 'required|string',
                    'employee_count' => 'nullable|numeric',
                    'has_cash_register' => 'nullable|boolean',
                    'cash_register_count' => 'nullable|numeric',
                    'need_to_contact' => 'nullable|boolean',
                    'refused_to_provide_identification_numeric' => 'nullable|boolean',
                    'identification_numeric_not_found_in_stat' => 'nullable|boolean',
                    'status' => 'required|string',
                    'status_changed' => 'nullable|date',
                    'created' => 'required|date',
                    'modified' => 'required|date',
                    'location_long' => 'nullable|numeric',
                    'location_lat' => 'nullable|numeric',
                    'district' => 'nullable',
                    'region' => 'nullable',
                    'source_type' => 'required|uuid|exists:source_types,id',
                    'activity_type' => 'required|uuid|exists:activity_types,mio_id',
                ];
            case 'PUT':
                return [
                    'id' => 'required|uuid|exists:businesses,mio_id',
                    'organization_id' => 'nullable|uuid|exists:organizations,mio_id',
                    'name' => 'required|string',
                    'display_name' => 'required|string',
                    'address_line' => 'required|string',
                    'address_line_stat' => 'required|string',
                    'source' => 'required|string',
                    'employee_count' => 'nullable|numeric',
                    'has_cash_register' => 'nullable|boolean',
                    'cash_register_count' => 'nullable|numeric',
                    'need_to_contact' => 'nullable|boolean',
                    'refused_to_provide_identification_numeric' => 'nullable|boolean',
                    'identification_numeric_not_found_in_stat' => 'nullable|boolean',
                    'status' => 'required|string',
                    'status_changed' => 'nullable|date',
                    'created' => 'required|date',
                    'modified' => 'required|date',
                    'location_long' => 'nullable|numeric',
                    'location_lat' => 'nullable|numeric',
                    'district' => 'nullable',
                    'region' => 'nullable',
                    'source_type' => 'required|uuid|exists:source_types,id',
                    'activity_type' => 'required|uuid|exists:activity_types,mio_id',
                ];
        }

        return [];
    }

}
