<?php

namespace App\Support\Rules;

use Illuminate\Contracts\Validation\Rule;

class RequiredOnCreateRule implements Rule
{
    public function passes($attribute, $value)
    {
        return request()->isMethod('PUT') || filled($value);
    }

    public function message()
    {
        return trans('validation.required');
    }
}
