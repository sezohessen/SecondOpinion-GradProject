<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCenterRequest extends FormRequest
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
            'first_name'    => 'required|min:2|max:20',
            'last_name'     => 'required|min:2|max:20',
            'email'         => 'required|string|max:255|unique:users,email',
            'phone'         => 'nullable|numeric',
            'whats_app'     => 'nullable|numeric',
            'password'      => 'required|confirmed|min:6',
            'avatar'        => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:4096',
            'governorate_id'=> 'required|exists:governorates,id',
            'city_id'      => 'required|exists:cities,id',
        ];
    }
}
