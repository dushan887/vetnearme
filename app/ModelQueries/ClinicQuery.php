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
                $this->deleteImage($clinic->logo, $this->_logoDirectory );

            $data['logo'] = $this->uploadImage($request->file('logo'), $data['name'], $this->_logoDirectory);

        }

        if($request->hasFile('marker')){

            if($clinic->marker)
                $this->deleteImage($clinic->marker, $this->_markerDirectory);

            $data['marker'] = $this->uploadImage($request->file('marker'), $data['name'], $this->_markerDirectory);

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

    static public function get($request)
    {
        $paginate = $request->get('limit') ?? 10;
        $type     = $request->get('type');

        $clinics = Clinic::orderBy('name', 'asc')->with(['users', 'country']);

        if($type && $type !== 'any'){

            if($type === 'general_practice')
                $clinics->where('general_practice', '=', 1);

            if($type === 'specialist_and_emergency')
                $clinics->where('specialist_and_emergency', '=', 1);

        }

        if($request->get('subscribed') && $request->get('subscribed') !== 'any'){

            $clinics->where('subscribed', '=', (int) $request->get('subscribed'));

        }

        if($request->get('has-admin') && $request->get('has-admin') !== 'any'){

            $hasOwner = null;

            if($request->get('subscribed') === 'yes')
                $hasOwner = 1;

            if($request->get('subscribed') === 'no')
                $hasOwner = 0;

            if($hasOwner !== null)
                $clinics->where('owner_id', '=', (int) $hasOwner);

        }

        if($request->get('country') && $request->get('country') !== 'any'){

            $country = Country::where('name', '=', ucwords($request->get('country')))->first();

            if($country)
                $clinics->where('country_id', '=', (int) $country->id);

        }

        if($request->has('name') && strlen($request->get('name')) >= 3){
            $clinics->whereRaw('LOWER(`name`) LIKE ? ', ['%'. trim(strtolower($request->get('name'))). '%']);
        }

        return $clinics->paginate((int) $paginate);
    }

    public function uploadImage($image, $clinicName, $directory)
    {
        $name = strtolower(str_replace(' ', '_', $clinicName)) . '.' . $image->getClientOriginalExtension();

        $image->move($directory, $name);

        return $name;
    }

    private function getServices($services)
    {
        return Service::whereIn('id', $services)->get();

    }

    private function formatData($data, $request)
    {
        $coordinates = Geolocation::getCoordinates($data);

        if($coordinates){
            $data['timezone'] = Geolocation::getTimezoneCoordinates([
                'lat' => $coordinates->latitude(),
                'lng' => $coordinates->longitude(),
            ])->zoneName;
        }

        $data['general_practice'] = 0;
        $data['specialist_and_emergency'] = 0;

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
        $data['description']      = $data['description']  ?? '';
        $data['meta_description'] = $data['meta_description']  ?? '';
        $data['keywords']         = $data['keywords']  ?? '';
        $data['special_notes']    = $data['special_notes']  ?? '';

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

    private function deleteImage($name, $directory)
    {
        return  \File::delete($directory . $name);
    }
}
