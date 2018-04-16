<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Service;

class ServicesController extends Controller
{
    /**
     * Show the dashboard services.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('services/index');
    }

    /**
     * Get all Services.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('services/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
}
