<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{

    public function authorize() : bool
    {
        return true;
    }

    public function rules() : array
    {
        $rules = [

        ];

        switch ($this->getMethod()) {
            case 'POST':
                return[
                        'firstName' => ['required', 'string', 'max:50'],
                        'lastName' => ['required', 'string', 'max:50'],
                        'secondName' => ['nullable', 'string', 'max:50'],
                        'email' => ['required', 'string', 'email', 'max:255'],
                        'phone' => ['required', 'string', 'max:12', 'unique:users'],
                        'password' => ['required', 'string', 'min:8', 'confirmed'],
                        'roleId' => 'required',
                        'departmentId' => 'required|exists:departments,id',
                        'position' => 'required|string',
                    ] + $rules;
            case 'PUT':
                return [
                        'id' => 'required|integer|exists:users,id',
                        'firstName' => ['required', 'string', 'max:50'],
                        'lastName' => ['required', 'string', 'max:50'],
                        'secondName' => ['nullable', 'string', 'max:50'],
                        'email' => ['required', 'string', 'email', 'max:255'],
                        'phone' => ['required', 'string', 'max:12', 'unique:users,phone,'.$this->id],
                        'roleId' => 'required',
                        'departmentId' => 'required|exists:departments,id',
                        'position' => 'required|string',
                    ] + $rules;
            case 'DELETE':
                return [
                    'id' => 'required|integer|exists:users,id'
                ];
        }

        return $rules;

    }
}
