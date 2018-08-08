<?php

namespace App\ModelQueries;

use Illuminate\Database\Eloquent\Model;

use App\Clinic;
use App\Service;
use App\Helpers\Geolocation;
use App\Helpers\Strings;

class ClinicQuery extends Clinic
{
    protected $table = 'clinics';

    private $_logoDirectory;
    private $_markerDirectory;

    public function __construct()
    {
        $this->_logoDirectory   = public_path('/img/logo/');
        $this->_markerDirectory = public_path('/img/markers/');
    }

    public function store($data, $request)
    {

        if($request->hasFile('logo'))
            $data['logo'] = $this->uploadImage($request->file('logo'), $data['name'], $this->_logoDirectory);

        if($request->hasFile('marker'))
            $data['marker'] = $this->uploadImage($request->file('marker'), $data['name'], $this->_markerDirectory);

        $data = $this->formatData($data, $request);

        $model = (new Clinic())->create($data);

        if($model->id){

            if($request->has('services')){
                $services = $this->getServices($request['services']);

                if($services !== null)
                    $model->services()->saveMany($services);
            }

            return $model->id;
        }

        return false;
    }

    public function updateClinic($data, $request, $clinicID)
    {
        $clinic = Clinic::find($clinicID);

        if($request->hasFile('logo')){

            if($clinic->logo)
                $this->deleteOldLogo($clinic->logo);

            $data['logo'] = $this->uploadImage($request->file('logo'), $data['name'], $this->_logoDirectory);

        }

        $data = $this->formatData($data, $request);

        if($clinic->update($data)){

            $clinic->services()->detach();

            if($request->has('services')){
                $services = $this->getServices($request['services']);

                if($services !== null)
                    $clinic->services()->saveMany($services);
            }

            return $clinic->id;
        }

        return false;

    }

    public function uploadImage($image, $clinicName, $directory)
    {
        $name = strtolower(str_replace(' ', '_', $clinicName)) . '.' . $logo->getClientOriginalExtension();

        $image->move($uploadImagedirectory, $name);

        return $name;
    }

    private function getServices($services)
    {
        return Service::whereIn('id', $services)->get();

    }

    private function formatData($data, $request)
    {
        $coordinates = Geolocation::getCoordinates($data);

        $data['owner_id']      = \Auth::user()->hasRole('super_admin') ? null : \Auth::id();
        $data['opening_hours'] = $this->formatHours($data['hours'], $request);
        $data['social_media']  = Strings::arrayToJson($data['social']);

        if($coordinates){
            $data['lat'] = $coordinates->latitude();
            $data['lng'] = $coordinates->longitude();
        }

        if($request->input('general_practice') && $request->input('general_practice') === 'true')
            $data['general_practice'] = 1;

        if($request->input('specialist_and_emergency') && $request->input('specialist_and_emergency') === 'true')
            $data['specialist_and_emergency'] = 1;

        if($request->input('subscribe') && $request->input('subscribe') === 'true')
            $data['subscribe'] = 1;

        if($request->input('accessibility') && $request->input('accessibility') === 'true')
            $data['accessibility'] = 1;

        // Laravel validation will return null if empty
        // Text in mysql can't be null so we need to set it as the empty string
        $data['description']   = $data['description']  ?? '';
        $data['special_notes'] = $data['special_notes']  ?? '';

        return $data;
    }

    private function formatHours($data, $request)
    {
        if ($request->has('not-working'))
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
        \File::delete($this->_logoDirectory . $logo);
    }
}
