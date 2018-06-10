<?php
namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Controllers\Controller;

use App\Clinic;
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

        $radius = $request->input('radius') ? (int)  $request->input('radius') : 10;

        $whereCategry = '';

        $category = XSS::clean($request->input('selector-category'));

        if($category === 'general')
            $whereCategry = " WHERE clinics.general_practice = 1 ";

        if($category === 'specialist')
            $whereCategry = " WHERE clinics.specialist_and_emergency = 1 ";

        $lat = $coordinates->latitude();
        $lng = $coordinates->longitude();

        $clinics =  \DB::select('SELECT * FROM
                    (SELECT clinics.id as cid, clinics.lat, clinics.lng, clinics.opening_hours,
                    clinics.logo, clinics.address, clinics.city, clinics.name, clinics.description,
                    clinics.zip, clinics.phone_number, clinics.email, clinics.url, clinics.gmaps_link,
                    countries.full_name AS country,
                    (' . $radius . ' * acos(cos(radians(' . $lat . ')) * cos(radians(lat)) *
                    cos(radians(lng) - radians(' . $lng . ')) +
                    sin(radians(' . $lat . ')) * sin(radians(lat))))
                    AS distance
                    FROM clinics
                    JOIN countries ON countries.id = clinics.country_id
                    ' . $whereCategry . '
                    ) AS distances
                WHERE distance < ' . $radius . '
                ORDER BY distance');

        $clinics = $this->arrayPaginator($clinics, $request);

        $coordinates = [];

        foreach ($clinics as $clinic) {
            $coordinates[] = [
                'lat' => $clinic->lat,
                'lng' => $clinic->lng,
            ];
        }

        return view('Front.results.index',[
            'clinics'         => $clinics,
            'coordinates'     => json_encode($coordinates),
            'currentDay'      => strtolower(date('l')),
            'currentHour'     => date('H:i:s'),
            'address'         => $address,
            'userCoordinates' => json_encode(['lat' => $lat, 'lng' => $lng]),
        ]);
    }

    public function arrayPaginator($array, $request)
    {
        $page    = Input::get('page', 1);
        $perPage = 4;
        $offset  = ($page * $perPage) - $perPage;

        return new LengthAwarePaginator(array_slice($array, $offset, $perPage, true), count($array), $perPage, $page,
            ['path' => $request->url(), 'query' => $request->query()]);
    }


}
