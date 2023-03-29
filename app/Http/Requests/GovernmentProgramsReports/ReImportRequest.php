<?php

namespace App\Http\Requests\GovernmentProgramsReports;

use Illuminate\Foundation\Http\FormRequest;

class ReImportRequest extends FormRequest
{
    private $mimeTypes = [
        'application/csv',
        'application/excel',
        'application/vnd.ms-excel',
        'application/vnd.msexcel',
        'text/anytext',
        'text/plain',
        'text/x-c',
        'text/comma-separated-values',
        'inode/x-empty',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
    ];

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
            'id'   => 'required|uuid|exists:government_report_headers,id',
            'file' => 'required|mimetypes:' . implode(',', $this->mimeTypes),
        ];
    }


    final public function messages(): array
    {
        return [
            'file.mimetypes' => trans('validation.custom.file.excel'),
        ];
    }
}
