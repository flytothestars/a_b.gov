<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BusinessRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return[
            'start_date' => 'nullable',
            'end_date' => 'nullable',
            'city_id' => 'nullable|uuid|exists:cities,id',
            'district_id' => 'nullable|uuid:exists:district,id',
            'distributor_id' => 'nullable|exists:users,id',
            'per_page' => 'nullable',
            'page' => 'nullable',
            'sortBy' => 'nullable',
            'sortDesc' => 'nullable',
            'status' => 'nullable',
            'appeals' => 'nullable|string',
        ];
    }
}
