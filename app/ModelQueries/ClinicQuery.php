<?php

namespace App\ModelQueries;

use Illuminate\Database\Eloquent\Model;

use App\Clinic;
use App\Helpers\Geolocation;

class ClinicQuery extends Clinic
{
    protected $table = 'clinics';

    public function store($data, $request)
    {
        $coordinates = Geolocation::getCoordinates($data);

        $data['owner_id']      = \Auth::id();
        $data['opening_hours'] = $this->formatHours($data['hours'], $request);
        $data['social_media']  = json_encode($this->cleanSocialLinks(($data['social'])));

        if($coordinates){
            $data['lat'] = $coordinates->latitude();
            $data['lng'] = $coordinates->longitude();
        }

        if($this->create($data))
            return $data->id;

        return false;
    }

    public function uploadLogo($logo, $clinicName)
    {
        $destinationPath = public_path('/img/logo');

        $name = md5($clinicName . time()) .' . ' . $logo->getClientOriginalExtension();

        $logo->move($destinationPath, $name);

        return $name;
    }

    private function cleanSocialLinks($socialLinks)
    {
        return array_filter(array_map('trim', $socialLinks));
    }

    private function formatHours($data, $request)
    {
        foreach ($request->post('not-working') as $day) {
            $data[$day . '-from']  = null;
            $data[$day . '-to']    = null;
            $data[$day . '-from2'] = null;
            $data[$day . '-to2']   = null;
        }

        return json_encode($data);
    }
}
