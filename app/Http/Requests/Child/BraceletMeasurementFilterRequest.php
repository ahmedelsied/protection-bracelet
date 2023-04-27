<?php

namespace App\Http\Requests\Child;

use Illuminate\Foundation\Http\FormRequest;

class BraceletMeasurementFilterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'from'  =>  'required|date|date_format:Y-m-d',
            'to'    =>  'required|date|after:from|date_format:Y-m-d'
        ];
    }
}