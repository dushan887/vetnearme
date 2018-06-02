<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreClinic;
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
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('clinics/index', [
            'clinics' => Clinic::paginate(20),
        ]);
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
            return redirect('admin/clinics/show/' . $clinicID);

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

        $clinicID = $model->updateClinic( XSS::clean($validated, ['logo']), $request, $id);

        if(!$clinicID){
            \Session::flash('alert', [
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

    public function get(Request $request)
    {
        switch ($request->input('role')) {
            case 'owner':
                return response()
                    ->json(Clinic::whereNull('owner_id')->orderBy('name', 'desc')->get());
                break;

             case 'user':
                return response()
                    ->json(Clinic::orderBy('name', 'desc')->with('users')->get());
                break;

            default:
                return response()
                    ->json(Clinic::orderBy('name', 'desc')->with('users')->get());
                break;
        }

    }

}
