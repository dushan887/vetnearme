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
        $data['opening_hours'] = $this->formatHours($data, $request);
        $data['social_media']  = json_encode($this->cleanSocialLinks(($data['social'])));

        if($coordinates){
            $data['lat'] = $coordinates->latitude();
            $data['lng'] = $coordinates->longitude();
        }

        $this->create($data);
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
        var_dump('<pre>', $request->input('not-working-friday'), '</pre>');
        var_dump('<pre>', $request->input('not-working-sunday'), '</pre>');die;
    }
}
