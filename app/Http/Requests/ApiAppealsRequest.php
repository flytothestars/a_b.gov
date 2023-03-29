<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class ApiAppealsRequest extends FormRequest
{

    public function authorize() : bool
    {
        return true;
    }

    public function rules() : array
    {
        switch ($this->getMethod()) {

            case 'POST':
                return[
                        'status' => 'required',
                        'appeals_id' => 'required',
                        'user' => 'required'
                    ];
        }
    }

}
