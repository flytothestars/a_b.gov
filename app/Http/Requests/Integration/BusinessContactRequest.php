<?php


namespace App\Http\Requests\Integration;

use Illuminate\Foundation\Http\FormRequest;


class BusinessContactRequest extends FormRequest
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
                    'id' => 'required|uuid|unique:business_contacts,mio_id',
                    'full_name' => 'required|string',
                    'phone_number' => 'required|string',
                    'business_id' => 'required|uuid|exists:businesses,mio_id',
                ];
            case 'PUT':
                return [
                    'id' => 'required|uuid|exists:business_contacts,mio_id',
                    'full_name' => 'required|string',
                    'phone_number' => 'required|string',
                    'business_id' => 'required|uuid|exists:businesses,mio_id',
                ];
            case 'DELETE':
                return [
                    'id' => 'required|uuid|exists:business_contacts,mio_id',
                ];
        }

        return [];
    }

}
