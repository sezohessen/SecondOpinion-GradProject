<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CenterStoreRadiologyRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'desc'          => 'nullable|min:3|max:3000',
            'doctor_id'     => 'required|exists:doctors,id',
            'first_name'    => 'required|min:2|max:20',
            'last_name'     => 'required|min:2|max:20',
            'email'         => 'required|string|max:255|unique:users,email',
            'day'           => 'required|integer|between:1,31',
            'month'         => 'required|integer|between:1,12',
            'year'          => 'required|integer|between:1900,2300',
            'phone'         => 'nullable|numeric',
            'whats_app'     => 'nullable|numeric',
            'password'      => 'required|confirmed|min:6',
            'fees'          => 'required|integer',
            'files'         => 'required'
        ];
    }
}
