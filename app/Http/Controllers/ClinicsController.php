<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreClinic;
use App\Country;
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
        return view('clinics/create', [
            'countries' => Country::pluck('name', 'id'),
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

        $model = new ClinicQuery;

        if($request->hasFile('logo'))
            $validated['logo'] = $model->uploadLogo($request->file('logo'), $validated['name']);

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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
