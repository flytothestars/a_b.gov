<?php


namespace App\Http\Requests\Camunda;

use Illuminate\Foundation\Http\FormRequest;


class TaskRequest extends FormRequest
{

    public function authorize() : bool
    {
        return true;
    }

    public function rules() : array
    {
        switch ($this->getMethod()) {
            case 'GET':
                return[
                        'processDefinitionKey' => 'required',
                        'candidateGroup' => 'required',
                        'user' => 'required',
                        'businessKey' => 'required',
                    ];
        }

        return [];
    }

}
