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
use App\Statics\Radius;

class ResultsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {

        $address     = XSS::clean($request->input('address-input'));
        $coordinates = $request->get('coordinates') ?? Geolocation::guessCoordinates($address);
        $currentHour = date('H:i:s');
        $currentDay  = strtolower(date('l'));

        if(is_object($coordinates))
            $coordinates = [
                'lat' => $coordinates->latitude(),
                'lng' => $coordinates->longitude(),
            ];

        $result  = $this->getClinics($request, $address, $coordinates, $currentDay);
        $clinics = $result['clinics'];

        if(!$coordinates) {
            $userCoordinates = json_encode(['lat' => '-33.8688197', 'lng' => '151.2092955']);
            return redirect()->route('home')->with(['message' => 'Address not valid!']);
        } else {
            $userCoordinates = json_encode(['lat' => $coordinates['lat'], 'lng' => $coordinates['lng']]);
        }

        $clinicsCoordinates = [];

        foreach ($clinics as $clinic) {
            $clinicsCoordinates[] = [
                'lat' => $clinic->lat,
                'lng' => $clinic->lng,
            ];
        }

        if($request->ajax()){

            $count = count($request->get('ids'));

            return response()
                ->json([
                    'page' => view('Front.results.partials._clinics', [
                        'clinics'         => $clinics,
                        'userCoordinates' => $userCoordinates,
                        'address'         => $address,
                        'currentHour'     => $currentHour,
                        'currentDay'      => $currentDay,
                        'count'           => $count + 1,
                    ])->render(),
                    'coordinates'  => json_encode($clinicsCoordinates),
                    'count'        => $count + 1,
                    'clinicsTotal' => $clinics->total() + $count,
                ]);

        }

        return view('Front.results.index',[
            'clinics'          => $clinics,
            'coordinates'      => json_encode($clinicsCoordinates),
            'currentHour'      => $currentHour,
            'currentDay'       => $currentDay,
            'address'          => $address,
            'userCoordinates'  => $userCoordinates,
            'services'         => Service::where('priority', '=', 1)->orderBy('count', 'desc')->get(),
            'advancedSearch'   => $request->input('advanced-search') && $request->input('advanced-search') === 'search'
                ? true : false,
            'selectedServices' => $request->input('services') ?? [],
            'category'         => XSS::clean($request->input('selector-category')),
            'radius'           => Radius::get(),
            'radiusSelected'   => $result['radius'],
            'working'          => $request->input('working') ?? 'all'
        ]);
    }

    private function arrayPaginator($array, $request)
    {
        $page    = Input::get('page', 1);
        $perPage = 150;
        $offset  = ($page * $perPage) - $perPage;

        return new LengthAwarePaginator(array_slice($array, $offset, $perPage, true), count($array), $perPage, $page,
            ['path' => $request->url(), 'query' => $request->query()]);
    }

    private function getClinics($request, $address, $coordinates, $currentDay)
    {

        $radiusList  = Radius::get();
        $radius      = $request->input('radius') ? $request->input('radius'): $radiusList[0];
        $services    = false;
        $currentHour = date('H:i');

        $conditionsQuery = [];

        $category = XSS::clean($request->input('selector-category'));

        if(!$coordinates) {
            $lat      = -33.8688197;
            $lng      = 151.2092955;
        } else {
            $lat      = $coordinates['lat'];
            $lng      = $coordinates['lng'];
        }

        if($request->input('advanced-search') && $request->input('advanced-search') === 'search')
            $services = $request->input('services');

        $whereOpen = "";

        if($request->input('working') !== null && $request->input('working') === 'open')
            $conditionsQuery[] = "JSON_EXTRACT(`opening_hours`, '$.\"{$currentDay}-to\"') > '{$currentHour}'
            OR (JSON_EXTRACT(`opening_hours`, '$.\"{$currentDay}-to\"') = '00:00' AND JSON_EXTRACT(`opening_hours`, '$.\"{$currentDay}-to2\"') = '00:00')" ;

        if($category === 'general')
            $conditionsQuery[] = "clinics.general_practice = 1";

        if($category === 'specialist')
            $conditionsQuery[] = "clinics.specialist_and_emergency = 1";

        // if($services):
        //     foreach ($services as $service) {
        //         $service = (int) $service;
        //         $conditionsQuery[] = "clinics_services.service_id = {$service}";
        //     }
        // endif;

        if($request->input('ids') !== null){

            foreach ($request->input('ids') as $id) {
                $id = (int) $id;

                $conditionsQuery[] = "clinics.id != {$id}";
            }
        }

        $clinics     = [];
        $radiusCount = count($radiusList);
        $i           = array_search($radius, $radiusList);

        do {

            $clinics = $this->clinicQuery($conditionsQuery, $lat, $lng, $radiusList[$i]);

            $i++;

        } while  (empty($clinics) && $i < $radiusCount);

        // $i - 1 is used to get the right position in the array
        return [
            'clinics' => $this->arrayPaginator($clinics, $request),
            'radius'  => $radiusList[$i - 1],
        ];
    }

    private function clinicQuery($conditionsQuery, $lat, $lng, $radius)
    {
        $conditionsQuery = $conditionsQuery ? " WHERE " . implode(' AND ', $conditionsQuery) : "";

        // 6378 is the circumvent of the Earth in km
        return \DB::select('SELECT * FROM
                (SELECT clinics.id as cid, clinics.lat, clinics.lng, clinics.opening_hours,
                clinics.logo, clinics.address, clinics.city, clinics.state, clinics.name, clinics.description,
                clinics.zip, clinics.phone_number, clinics.email, clinics.url, clinics.gmaps_link,
                clinics.marker,
                countries.full_name AS country,
                (6378 * acos(
                    cos(radians(' . $lat . ')) * cos(radians(lat)) *
                    cos(radians(lng) - radians(' . $lng . ')) +
                    sin(radians(' . $lat . ')) * sin(radians(lat))))
                AS distance
                FROM clinics
                JOIN countries ON countries.id = clinics.country_id
                LEFT JOIN clinics_services ON clinics.id = clinics_services.clinic_id
                ' . $conditionsQuery . '
                GROUP BY clinics.id
                ) AS distances
            WHERE distance < ' . $radius. '
            ORDER BY distance ASC');
    }


}
