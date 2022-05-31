<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientOpinionRequest extends FormRequest
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
        $rules=[
            'first_name'    => 'required|min:2|max:20',
            'last_name'     => 'required|min:2|max:20',
            'day'           => 'required|numeric|between:1,31',
            'month'         => 'required|numeric|between:1,12',
            'year'          => 'required|numeric|between:1900,2300',
            'phone'         => 'required|numeric',
            'whats_app'     => 'nullable|numeric',
            'fees'          => 'required|integer',
        ];
        if(!session("files")){
            $rules['files']   = 'required|max:3';
            $rules['files.*'] ='max:2048';
        }

        return $rules;
    }
}
