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
            'name'          => 'required|min:3|max:255|string',
            'description'   => 'string',
            'email'         => 'required|email|unique:clinics,email',
            'phoneNumber'   => 'required',
            'url'           => 'url',
            'gmap'          => 'url',
            'social.*'      => 'url',
            'city'          => 'required|string|min:2|max:255',
            'address'       => 'required|string|min:2|max:255',
            'zip'           => 'required|string|min:2|max:255',
            'hours.*'       => ['required', new Hours],
            'special-notes' => 'string|min:3|max:1024',
        ];
    }

    public function messages()
    {
        return [

        ];
    }

    public function attributes()
    {
        return [
            'name'                  => 'Clinic Name',
            'phoneNumber'           => 'phone number',
            'emergencyNumber'       => 'emergency number',
            'url'                   => 'Clinic Site URL',
            'zip'                   => 'Postal Code',
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

}
