<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Hours;

class StoreClinic extends FormRequest
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
            'name'                     => 'required|min:3|max:255|string',
            'description'              => 'string|nullable',
            'email'                    => 'required|email',
            'phone_number'             => 'required|string|min:3|max:255',
            'emergency_number'         => 'nullable|string|min:3|max:255',
            'url'                      => 'nullable|url',
            'bookmark_url'             => 'nullable|url',
            'social.*'                 => 'nullable|url',
            'city'                     => 'required|string|min:2|max:255',
            'address'                  => 'required|string|min:2|max:255',
            'zip'                      => 'required|string|min:2|max:255',
            'state'                    => 'nullable|string|min:2|max:255',
            'country_id'               => 'integer',
            'hours.*'                  => ['required', new Hours],
            'special_notes'            => 'nullable|string|max:1024',
            'logo'                     => 'nullable|image',
            'marker'                   => 'nullable|image',
            'general_practice'         => 'required_without_all:specialist_and_emergency',
            'specialist_and_emergency' => 'required_without_all:general_practice',

        ];
    }

    public function attributes()
    {
        return [
            'name'                  => 'clinic name',
            'phone_number'          => 'phone number',
            'emergency_number'      => 'emergency number',
            'url'                   => 'Clinic Site URL',
            'zip'                   => 'Postal Code',
            'bookmark_url'          => 'Bookmark URL',
            'special-notes'         => 'Special Notes',
            'social.facebook'       => 'Facebook',
            'social.twitter'        => 'Twitter',
            'social.instagram'      => 'Instagram',
            'social.linkedin'       => 'Linkedin',
            'social.youtube'        => 'YouTube',
            'hours.monday-from'     => 'Monday from',
            'hours.monday-to'       => 'Monday to',
            'hours.monday-from2'    => 'Monday from (2)',
            'hours.monday-to2'      => 'Monday to (2)',
            'hours.tuesday-from'    => 'Tuesday from',
            'hours.tuesday-to'      => 'Tuesday to',
            'hours.tuesday-from2'   => 'Tuesday from (2)',
            'hours.tuesday-to2'     => 'Tuesday to (2)',
            'hours.wednesday-from'  => 'Wednesday from',
            'hours.wednesday-to'    => 'Wednesday to',
            'hours.wednesday-from2' => 'Wednesday from (2)',
            'hours.wednesday-to2'   => 'Wednesday to (2)',
            'hours.thursday-from'   => 'Thursday from',
            'hours.thursday-to'     => 'Thursday to',
            'hours.thursday-from2'  => 'Thursday from (2)',
            'hours.thursday-to'     => 'Thursday to (2)',
            'hours.friday-from'     => 'Friday from',
            'hours.friday-to'       => 'Friday to',
            'hours.friday-from2'    => 'Friday from (2)',
            'hours.friday-to2'      => 'Friday to (2)',
            'hours.saturday-from'   => 'Saturday from',
            'hours.saturday-to'     => 'Saturday to',
            'hours.saturday-from2'  => 'Saturday from (2)',
            'hours.saturday-to'     => 'Saturday to (2)',
            'hours.sunday-from'     => 'Sunday from',
            'hours.sunday-to'       => 'Sunday to',
            'hours.sunday-from2'    => 'Sunday from (2)',
            'hours.sunday-to'       => 'Sunday to (2)',
        ];
    }

    public function messages()
    {
        return [
            'general_practice.required_without_all'         => 'Please check General practice or Specialist and Emergency checkbox, or both',
            'specialist_and_emergency.required_without_all' => 'Please check General practice or Specialist and Emergency checkbox, or both',
        ];
    }
}
