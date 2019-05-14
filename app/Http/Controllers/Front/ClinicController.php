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
        $clinic = Clinic::whereRaw("LOWER(name) = ?", str_replace('-', ' ', $clinicName))->first();

        if(isset($clinic->gallery[0]))
            $metaImage = $clinic->gallery[0]->media->super_admin ?
            "/media/general/{$clinic->gallery[0]->media->name}" :
            "/media/" . strtolower(str_replace(' ', '-', $clinic->name)) . "/" . $clinic->gallery[0]->media->name;
        else
            $metaImage = null;

        return view('Front.clinic.index', [
            'clinic'    => $clinic,
            'social'    => json_decode($clinic->social_media),
            'hours'     => json_decode($clinic->opening_hours),
            'metaImage' => $metaImage
        ]);
    }

}
