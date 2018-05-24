<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MediaUploadRequest extends FormRequest
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
            'files'   => 'required',
            'files.*' => 'mimes:jpeg,jpg,png,gif,pdf',
        ];

    }

    public function messages()
    {
        return [
            'files.required' => 'You need to upload at least 1 file',
            'files.*.mimes' => 'Supported formats are: JPEG, JPG, GIF, PNG, and PDF'
        ];
    }
}
