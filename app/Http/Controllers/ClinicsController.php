<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Clinics;

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

    
}
