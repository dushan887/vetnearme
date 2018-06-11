<?php
namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Controllers\Controller;

use App\Clinic;
use App\Service;
use App\Helpers\Geolocation;
use App\Helpers\XSS;

class ResultsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $address     = XSS::clean($request->input('address-input'));
        $coordinates = Geolocation::guessCoordinates($address);

        $clinics = $this->getClinics($request, $address, $coordinates);
        $userCoordinates = json_encode(['lat' => $coordinates->latitude(), 'lng' => $coordinates->longitude()]);

        $clinicsCoordinates = [];

        foreach ($clinics as $clinic) {
            $clinicsCoordinates[] = [
                'lat' => $clinic->lat,
                'lng' => $clinic->lng,
            ];
        }

        if($request->ajax()){
            return response()
                    ->json([
                        'page' => view('Front.results.partials.content', [
                            'clinics'            => $clinics,
                            'clinicsCoordinates' => $clinicsCoordinates,
                            'userCoordinates'    => $userCoordinates,
                            'address'            => $address,
                            'currentDay'         => strtolower(date('l')),
                            'currentHour'        => date('H:i:s'),
                        ])->render()
                    ]);

        }

        return view('Front.results.index',[
            'clinics'          => $clinics,
            'coordinates'      => json_encode($clinicsCoordinates),
            'currentDay'       => strtolower(date('l')),
            'currentHour'      => date('H:i:s'),
            'address'          => $address,
            'userCoordinates'  => json_encode(['lat' => $coordinates->latitude(), 'lng' => $coordinates->longitude()]),
            'services'         => Service::where('priority', '=', 1)->orderBy('count', 'desc')->get(),
            'advancedSearch'   => $request->input('advanced-search') && $request->input('advanced-search') === 'search'
                ? true : false,
            'selectedServices' => $request->input('services') ?? [],
            'category'         => XSS::clean($request->input('selector-category'))
        ]);
    }

    private function arrayPaginator($array, $request)
    {
        $page    = Input::get('page', 1);
        $perPage = 4;
        $offset  = ($page * $perPage) - $perPage;

        return new LengthAwarePaginator(array_slice($array, $offset, $perPage, true), count($array), $perPage, $page,
            ['path' => $request->url(), 'query' => $request->query()]);
    }

    private function getClinics($request, $address, $coordinates)
    {

        $radius = $request->input('radius') ? $request->input('radius') : 10;

        $whereCategory = '';

        $category = XSS::clean($request->input('selector-category'));

        $lat      = $coordinates->latitude();
        $lng      = $coordinates->longitude();
        $services = false;

        if($request->input('advanced-search') && $request->input('advanced-search') === 'search')
            $services = $request->input('services');

        if($radius === 'all'){
            $whereRadius = "";
        } else {

            $radius = (int) $radius;

            $whereRadius =  " WHERE lat BETWEEN ({$lat} - ({$radius}*0.010)) AND ({$lat} + ({$radius}*0.010)) AND
                lng BETWEEN ({$lng} - ({$radius}*0.010)) AND ({$lng} + ({$radius}*0.010)) ";
        }

        if($category === 'general')
            $whereCategory = " AND clinics.general_practice = 1 ";

        if($category === 'specialist')
            $whereCategory = " AND clinics.specialist_and_emergency = 1 ";

        if($whereRadius === "")
            $whereCategory = str_replace('AND', 'WHERE', $whereCategory);

        if(!$services):

            // $clinics =  \DB::select('SELECT * FROM
            //     (SELECT clinics.id as cid, clinics.lat, clinics.lng, clinics.opening_hours,
            //     clinics.logo, clinics.address, clinics.city, clinics.name, clinics.description,
            //     clinics.zip, clinics.phone_number, clinics.email, clinics.url, clinics.gmaps_link,
            //     countries.full_name AS country,
            //     (' .  $radius . ' * acos(cos(radians(' . $lat . ')) * cos(radians(lat)) *
            //     cos(radians(lng) - radians(' . $lng . ')) +
            //     sin(radians(' . $lat . ')) * sin(radians(lat))))
            //     AS distance
            //     FROM clinics
            //     JOIN countries ON countries.id = clinics.country_id
            //     ' . $whereCategory . '
            //     ) AS distances
            // WHERE distance < ' . $radius. '
            // ORDER BY distance DESC');

            $clinics = \DB::select("SELECT clinics.*,  countries.full_name AS country
                    FROM clinics
                    JOIN countries ON countries.id = clinics.country_id
                    {$whereRadius}
                    {$whereCategory}");

        else:

            $whereServices = [];

            foreach ($services as $service) {
                $service = (int) $service;
                $whereServices[] = " AND clinics_services.service_id = {$service} ";
            }

            if($whereRadius === "" && $whereCategory === "")
                $whereServices[0] = str_replace('AND', 'WHERE', $whereServices[0]);

            $whereServices = implode(' ', $whereServices);

             $clinics = \DB::select("SELECT clinics.*,  countries.full_name AS country
                    FROM clinics
                    JOIN countries ON countries.id = clinics.country_id
                    JOIN clinics_services ON clinics.id = clinics_services.clinic_id
                    {$whereRadius}
                    {$whereCategory}
                    {$whereServices}");

            // $clinics =  \DB::select('SELECT * FROM
            //     (SELECT clinics.id as cid, clinics.lat, clinics.lng, clinics.opening_hours,
            //     clinics.logo, clinics.address, clinics.city, clinics.name, clinics.description,
            //     clinics.zip, clinics.phone_number, clinics.email, clinics.url, clinics.gmaps_link,
            //     countries.full_name AS country,
            //     (' . $radius . ' * acos(cos(radians(' . $lat . ')) * cos(radians(lat)) *
            //     cos(radians(lng) - radians(' . $lng . ')) +
            //     sin(radians(' . $lat . ')) * sin(radians(lat))))
            //     AS distance
            //     FROM clinics
            //     JOIN countries ON countries.id = clinics.country_id
            //     JOIN clinics_services ON clinic.id = clinics_services.clinic_id
            //     WHERE ' . $whereServices . '
            //     ' . $whereCategory . '
            //     ) AS distances
            // WHERE distance < ' . $radius . '
            // ORDER BY distance');

        endif;

        return $this->arrayPaginator($clinics, $request);
    }


}
