<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateFeedBackRequest extends FormRequest
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
            'file'          => 'required_without:desc|file|mimes:png,jpg,xlx,xls,pdf,docx,doc|max:10000',
        ];
    }
}
