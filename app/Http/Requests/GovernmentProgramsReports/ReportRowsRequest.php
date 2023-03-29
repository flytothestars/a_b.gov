<?php

namespace App\Http\Requests\GovernmentProgramsReports;

use Illuminate\Foundation\Http\FormRequest;

class ReportRowsRequest extends FormRequest
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
            'id'     => 'required|uuid|exists:government_report_headers,id',
            'filter' => 'required|string',
        ];
    }
}
