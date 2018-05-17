<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreClinic;
use App\Country;
use App\Service;
use App\Helpers\XSS;
use App\Helpers\Geolocation;
use App\ModelQueries\ClinicQuery;

class ClinicsController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkRole:super_admin');
    }

    /**
     * Show the dashboard Clinics.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
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
            Session::flash('alert', [
                'message' => 'Something went wrong. Please try again',
                'type'    => 'danger'
            ]);
            return Redirect::back();
        }

        return redirect('admin/clinics/' . $clinicID);
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
    public function edit(int $id)
    {
        if(!\Auth::user()->hasRole('super_admin') && \Auth::user()->clinic->owner_id !== $id)
            return redirect('admin/clinics/' . $id);

        $clinic = Clinic::find($id);

        return view('clinics/edit', [
            'clinic'    => $clinic,
            'social'    => json_decode($clinic->social_media),
            'hours'     => json_decode($clinic->opening_hours),
            'countries' => Country::pluck('name', 'id'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\StoreClinic  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreClinic $request, int $id)
    {
        // User can update only his clinic
        if(!\Auth::user()->hasRole('super_admin') && \Auth::user()->clinic->owner_id !== $id)
            return redirect('admin/clinics/' . $id);

        $validated = $request->validated();

        $model     = new ClinicQuery;

        $clinicID = $model->update( XSS::clean($validated, ['logo']), $request, $id);

        if(!$clinicID){
            Session::flash('alert', [
                'message' => 'Something went wrong. Please try again',
                'type'    => 'danger'
            ]);
            return Redirect::back();
        }

        return redirect('admin/clinics/' . $clinicID);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
