<?php

namespace App\Support\Rules;

use Illuminate\Contracts\Validation\Rule;

class AlphaSpacesRule implements Rule
{
    public function passes($attribute, $value)
    {
        return preg_match('/^[a-zA-Z\s]+$/u', $value);
    }

    public function message()
    {
        return trans('validation.alpha_spaces');
    }
}
