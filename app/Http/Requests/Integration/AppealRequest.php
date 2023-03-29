<?php


namespace App\Http\Requests\Integration;

use Illuminate\Foundation\Http\FormRequest;


class AppealRequest extends FormRequest
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
                    'id' => 'required|uuid|unique:appeals,mio_id',
                    'requirement' => 'required|uuid',
                    'district' => 'nullable',
                    'content' => 'nullable|string',
                    'createDate' => 'required|date',
                    'updateDate' => 'required|date',
                    'business_id' => 'required|uuid|exists:businesses,mio_id',
                    'source_type' => 'required|uuid|exists:source_types,id',
                ];
            case 'PUT':
                return [
                    'id' => 'required|uuid|exists:appeals,mio_id',
                    'requirement' => 'required|uuid',
                    'district' => 'nullable',
                    'content' => 'nullable|string',
                    'createDate' => 'required|date',
                    'updateDate' => 'required|date',
                    'business_id' => 'required|uuid|exists:businesses,mio_id',
                    'source_type' => 'required|uuid|exists:source_types,id',
                ];
        }

        return [];
    }

}
