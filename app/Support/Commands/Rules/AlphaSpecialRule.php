<?php

namespace App\Support\Rules;

use Illuminate\Contracts\Validation\Rule;

class AlphaSpecialRule implements Rule
{
    public function passes($attribute, $value)
    {
        return preg_match('/^[\'\-_.:;\/\\\,0-9a-zA-Z\s]+$/u', $value);
    }

    public function message()
    {
        return trans('validation.alpha_special');
    }
}
