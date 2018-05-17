<?php

namespace App\ModelQueries;

use Illuminate\Database\Eloquent\Model;

use App\Clinic;
use App\Helpers\Geolocation;

private $_logoDirectory;

public function __construct()
{
    $this->_logoDirectory = public_path('/img/logo/');
}

class ClinicQuery extends Clinic
{
    protected $table = 'clinics';

    public function store($data, $request)
    {

        if($request->hasFile('logo'))
            $data['logo'] = $this->uploadLogo($request->file('logo'), $data['name']);

        $data = $this->formatData($data);

        if($this->create($data))
            return $this->id;

        return false;
    }

    public function update($data, $request, $clinicID)
    {
        $clinic = self::find($clinicID);

        if($request->hasFile('logo')){

            if($clinic->logo)
                $this->deleteOldLogo($clinic->logo);

            $data['logo'] = $this->uploadLogo($request->file('logo'), $data['name']);

        }

        $data = $this->formatData($data);

        if($clinic->update($data)){
            $clinic->services->attach($request->input('services'));
            return $clinic->id;
        }

        return false;

    }

    public function uploadLogo($logo, $clinicName)
    {
        $name = strtolower(str_replace(' ', '_', $clinicName)) . ' . ' . $logo->getClientOriginalExtension();

        $logo->move($this->_logoDirectory, $name);

        return $name;
    }

    private function formatData($data)
    {
        $coordinates = Geolocation::getCoordinates($data);

        $data['owner_id']      = \Auth::id();
        $data['opening_hours'] = $this->formatHours($data['hours'], $request);
        $data['social_media']  = json_encode($this->cleanSocialLinks(($data['social'])));

        if($coordinates){
            $data['lat'] = $coordinates->latitude();
            $data['lng'] = $coordinates->longitude();
        }

        return $data;
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

    private function deleteOldLogo($logo)
    {
        File::delete($this->_logoDirectory . $logo);
    }
}
