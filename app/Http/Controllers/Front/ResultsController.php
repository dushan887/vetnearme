<?php
namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Clinic;

class ResultsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $clinics = Clinic::orderBy('subscribe', 'desc')->paginate(2);

        $coordinates = [];

        foreach ($clinics as $clinic) {
            $coordinates[] = [
                'lat' => $clinic->lat,
                'lng' => $clinic->lng,
            ];
        }

        return view('Front.results.index',[
            'clinics'     => $clinics,
            'coordinates' => $coordinates,
            'currentDay'  => strtolower(date('l')),
            'currentHour' => date('H:i:s'),
        ]);
    }


}
