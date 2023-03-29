<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class MatchOldPassword implements Rule
{

    public function __construct()
    {
        //
    }

    public function passes($attribute, $value) : bool
    {
        return Hash::check($value, auth()->user()->password);
    }


    public function message() : string
    {
        return trans('validation.match_password');
    }
}
