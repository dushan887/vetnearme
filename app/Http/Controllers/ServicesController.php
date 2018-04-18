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
    public function all(Request $request)
    {
        return response()
            ->json(Service::all());
    }

    /**
     * Show the form for creating a new service.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()
            ->json(view('services/partials/_createForm')->render());
    }

    /**
     * Store a newly created service in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:services|min:3|max:255',
        ]);

        $service = Service::create($data);

        return response()->json($service);
    }
}
