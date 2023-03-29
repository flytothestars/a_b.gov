<?php

namespace App\Http\Requests\Report;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDistrictRatiosRequest extends FormRequest
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
        return [
            'report_type_id' => 'required|exists:report_types,id',
            'city_id' => 'required|exists:cities,id',
            'district_id' => 'required|exists:districts,id',
            'date' => 'required|date_format:Y-m-d',
            'ratios' => 'required|array',
            'ratios.*.id' => 'required|exists:report_ratios,id',
            'ratios.*.value' => 'required|numeric',
        ];
    }
}
