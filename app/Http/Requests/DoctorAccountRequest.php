<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorAccountRequest extends FormRequest
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
            'desc'              => 'nullable|min:10|max:255',
            'desc_ar'           => 'required|min:10|max:255',
            'avatar'            => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:4096',
            'field_id'          => 'required|exists:fields,id',
            'specialty_id.*'    => 'required|exists:specialties,id',
            'facebook'          => 'nullable',
        ];
    }
}
