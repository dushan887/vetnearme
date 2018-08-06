<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Clinic;
use App\ClinicGallery;

class ClinicGalleryController extends Controller
{
    public function getClinics(Request $request)
    {
        return response()
                ->json(view('clinic-images/partials/_clinics', [
                    'clinics' => Clinic::select('id', 'name')->orderBy('name', 'asc')->with(['gallery'])->get(),
                    'mediaID' => (int) $request->get('mediaID'),
                ])->render());
    }

    public function store(Request $request)
    {
        $mediaID = (int) $request->post('mediaID');
        $insert  = [];

        ClinicGallery::where('media_id', $mediaID)->delete();

        foreach ($request->post('clinics') as $clinic) {
            $insert[] = [
                'media_id'  => $mediaID,
                'clinic_id' => $clinic,
            ];
        }

        ClinicGallery::insert($insert);
    }
}
