<?php
namespace App\Http\Controllers\Front;

use App\Clinic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClinicController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($clinicName)
    {
        $clinic = Clinic::whereRaw("LOWER(name) = ?", str_replace('_', ' ', $clinicName))->first();

        return view('Front.clinic.index', [
            'clinic' => $clinic,
            'social' => json_decode($clinic->social_media),
            'hours'  => json_decode($clinic->opening_hours),
        ]);
    }

}
