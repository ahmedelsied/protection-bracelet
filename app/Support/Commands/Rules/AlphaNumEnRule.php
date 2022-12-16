<?php

namespace App\Support\Rules;

use Illuminate\Contracts\Validation\Rule;

class AlphaNumEnRule implements Rule
{
    public function passes($attribute, $value)
    {
        return preg_match('/^[A-Z0-9]+$/u', $value);
    }

    public function message()
    {
        return trans('validation.alpha_num_en');
    }
}
