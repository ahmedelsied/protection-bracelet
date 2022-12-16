<?php

namespace App\Http\Requests\Dashboard\Management;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'name' => 'required|string|max:100',
            'phone' => 'required|string|max:15|unique:users',
            'password' => ['required', 'confirmed', Password::min(6)],
            'roles' => 'nullable|array',
            'avatar' => 'sometimes|image|max:2000',
        ];
        if ($this->isMethod('PUT')) {
            $rules['password'] = ['nullable', 'confirmed', Password::min(6)];
            $rules['phone'] = 'required|max:255|unique:users,phone,'.$this->route('user');
        }

        return $rules;
    }
}
