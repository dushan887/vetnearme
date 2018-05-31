<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserCreateRequest extends FormRequest
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
        $rules = [];

        if(\Auth::user()->hasRole('super_admin', 'admin'))
            $rules = [
                'user_role'    => [Rule::in(['super_admin', 'admin', 'user'])],
                'clinic_owner' => 'integer',
                'clinic_user'  => 'integer',
            ];

        return array_merge($rules, [
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'email'         => "required|string|email|unique:users",
            'temp_password' => 'required|string|min:8',
            'title'         => 'integer|nullable',
            'gender'        => [Rule::in([0, 1])],
            'position'      => 'string|max:255|nullable',
            'phone'         => 'string|max:255|nullable',
            'location'      => 'string|max:255|nullable',
            'about'         => 'string|nullable',
            'social.*'      => 'url|nullable',
            'avatar'        => 'nullable|image|mimes:jpeg,jpg,png,gif',
        ]);
    }

    public function attributes()
    {
        return [
            'social.facebook'  => 'Facebook',
            'social.twitter'   => 'Twitter',
            'social.instagram' => 'Instagram',
            'social.linkedin'  => 'Linkedin',
            'temp_password'    => 'Temporary Password',
        ];
    }
}
