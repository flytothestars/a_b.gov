<?php


namespace App\Http\Requests\Camunda;

use Illuminate\Foundation\Http\FormRequest;


class ClientSettingRequest extends FormRequest
{

    public function authorize() : bool
    {
        return true;
    }

    public function rules() : array
    {
        switch ($this->getMethod()) {

            case 'PUT':
                return[
                        'workerWebhookUrl' => 'required',
                        'workerWebhookSecret' => 'required',
                    ];
        }

        return [];
    }

}
