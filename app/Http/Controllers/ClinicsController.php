<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreClinic;
use App\Http\Requests\UpdateClinicRequest;
use App\Clinic;
use App\Country;
use App\Service;
use App\Helpers\XSS;
use App\Helpers\Geolocation;
use App\ModelQueries\ClinicQuery;

class ClinicsController extends Controller
{
    /**
     * Show the dashboard Clinics.
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Owner of the clinic can see only his clinic
        // Super admin will see all clinics in this place
        if(!\Auth::user()->hasRole('super_admin')){
            return redirect('admin/clinics/edit/' . \Auth::user()->clinic()->id);
        }

        return view('clinics/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Super admin can make as many clinics as he wants
        // Clinic owner can make only one clinic
        if(!\Auth::user()->hasRole('super_admin')){
            if($clinic = Clinic::where('owner_id', \Auth::user()->id)->first())
                return redirect('admin/clinics/' . $clinic->id);
        }

        return view('clinics/create', [
            'countries' => Country::pluck('name', 'id'),
            'services'  => Service::pluck('id', 'name'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreClinic $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClinic $request)
    {
        $validated = $request->validated();

        $model     = new ClinicQuery;

        $clinicID = $model->store( XSS::clean($validated, ['logo']), $request);

        if(!$clinicID){
            \Session::flash('alert', [
                'message' => 'Something went wrong. Please try again',
                'type'    => 'danger'
            ]);
            return Redirect::back();
        }

        if(\Auth::user()->hasRole('super_admin'))
            return redirect('admin/clinics/edit/' . $clinicID);

        return redirect()->route('my-clinic');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return view('clinics/show', [
            'clinic' => Clinic::find($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(?int $id = null)
    {
        if(!\Auth::user()->hasRole('super_admin') ||
            (\Auth::user()->hasRole('admin') && \Auth::user()->clinic_id !== $id)
        )
            return redirect('admin/clinics/' . $id);

        // Super admin can edit all clinics
        // Admin and owner
        $clinic = Clinic::find($id ?? \Auth::user()->clinic_id);

        return view('clinics/edit', [
            'clinic'         => $clinic,
            'social'         => json_decode($clinic->social_media),
            'hours'          => json_decode($clinic->opening_hours),
            'services'       => Service::pluck('id', 'name'),
            'clinicServices' => $clinic->services->pluck('id')->toArray(),
            'countries'      => Country::pluck('name', 'id'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\StoreClinic  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClinicRequest $request, int $id)
    {
        // User can update only his clinic
        if(!\Auth::user()->hasRole('super_admin') && \Auth::user()->clinic->owner_id !== $id)
            return redirect('admin/clinics/' . $id);

        $validated = $request->validated();

        $model     = new ClinicQuery;

        $clinicID = $model->updateClinic( XSS::clean($validated, ['logo']), $request, $id);

        if(!$clinicID){
            \Session::flash('alert', [
                'message' => 'Something went wrong. Please try again',
                'type'    => 'danger'
            ]);

        } else {

            \Session::flash('alert', [
                'message' => 'Clinic Updated',
                'type'    => 'success'
            ]);

        }

        return redirect('admin/clinics/edit/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     * Only super admin can delete clinic
     *
     * @param  int|array  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = Clinic::destroy($id) ?
            $message = [
                'messageTitle' => 'Clinic(s) Deleted',
                'messageText'  => 'The clinic(s) has been deleted',
                'class'        => 'success'
            ] :
            $message = [
                'messageTitle' => 'Alert',
                'messageText'  => '',
                'class'        => 'error'
            ];

        return response()->json($message, $deleted ? 200 : 500);
    }

    public function get(Request $request)
    {
        return response()->json(ClinicQuery::get($request));
    }

    public function export()
    {
        $headers = [
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Content-type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename=clinics.csv',
            'Expires'             => '0',
            'Pragma'              => 'public',
        ];

        $clinics = Clinic::all();

        $columns = [
            'name', 'description', 'special_notes', 'email', 'phone_number', 'emergency_number', 'city',
            'address', 'zip', 'state', 'country', 'latitude', 'longitude', 'web_site',
            'social_media', 'opening_hours', 'general_practice', 'specialist_and_emergency', 'subscribe',
            'owner'
        ];

        $callback = function() use ($clinics, $columns)
        {
            $file = fopen('php://output', 'w');

            fputcsv($file, $columns);

            foreach($clinics as $clinic) {
                fputcsv($file, [
                    $clinic->name,
                    $clinic->description,
                    $clinic->special_notes,
                    $clinic->email,
                    $clinic->phone_number,
                    $clinic->emergency_number,
                    $clinic->city,
                    $clinic->zip,
                    $clinic->address,
                    $clinic->state,
                    $clinic->country->full_name,
                    $clinic->lat,
                    $clinic->lng,
                    $clinic->url,
                    $clinic->social_media,
                    $clinic->opening_hours,
                    $clinic->general_practice ? 'No' : 'Yes',
                    $clinic->specialist_and_emergency ? 'No' : 'Yes',
                    $clinic->subscribe ? 'No' : 'Yes',
                    $clinic->owner ? $clinic->owner->first_name . " " . $clinic->owner->last_name : "Doesn't have an owner",
                ]);
            }

            fclose($file);
        };

        return \Response::stream($callback, 200, $headers);


    }

}
