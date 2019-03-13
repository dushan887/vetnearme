<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostUpdateRequest extends FormRequest
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
            'title'       => 'required|min:3|max:255|unique:posts,title,' . $this->route('id'),
            'permalink'   => 'required|min:3|max:255|unique:posts,permalink,' . $this->route('id'),
            'body'        => 'required|string',
            'description' => 'required|string',
            'expert'      => 'required|string',
            'status'      => [Rule::in([0, 1])],
            'category_id' => 'required|integer'
        ];
    }
}
