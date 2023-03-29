<?php

namespace App\Http\Requests\GovernmentProgramsReports;

use App\Contracts\GovernmentProgramsReports\IReportTypes;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateRequest extends FormRequest
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
            'type' => [ 'required', Rule::in([ IReportTypes::TypeQolday ]) ],
            'date' => 'required|date_format:Y-m-d',
        ];
    }

}
