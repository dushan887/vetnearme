<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Service;

class ServicesController extends Controller
{

    public function __construct()
    {
        $this->middleware('checkRole:super_admin');
    }

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
        $services = Service::orderBy('count', 'desc');
        $name     = $request->get('name');

        if($name && strlen($name) >= 3)
            $services->whereRaw('LOWER(`name`) LIKE ? ', ['%'. trim(strtolower($name)). '%']);

        return response()
            ->json($services->get());
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

        return response()->json([
            'service'      => $service,
            'messageTitle' => 'Service Created',
            'messageText'  => 'The service has been created',
            'class'        => 'success'
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
        return response()
            ->json(view('services/partials/_editForm', [
                'service' => Service::find($id),
            ])->render());
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
        $service = Service::find($id);

        $data = $request->validate([
            'name' => 'required|min:3|max:255|unique:services,name,' . $service->id,
        ]);

        $service->update($data);

        return response()->json([
            'service'      => $service,
            'messageTitle' => 'Service Updated',
            'messageText'  => 'The service has been updated',
            'class'        => 'success'
        ]);
    }

    public function changePriorityStatus(Request $request)
    {
        $service = Service::find((int) $request->input('id'));

        // At any time only 12 services can have priority status
        $services = Service::where('priority', '=', 1)->get();

        if($services && count($services) >= 12)
            return response()->json([
                'messageTitle' => 'Service Priority Limit',
                'messageText'  => 'You can set priority status to 12 services.',
                'class'        => 'danger'
            ], 400);

        $service->priority = (int) !$request->input('priority');

        $service->update();

        return response()->json([
            'service'      => $service,
            'messageTitle' => 'Service Priority Changed',
            'messageText'  => 'The service priority status has been updated',
            'class'        => 'success'
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Service::destroy($id))
            return response()->json([
                'messageTitle' => 'Service Deleted',
                'messageText'  => 'The service has been deleted',
                'class'        => 'success'
            ]);

         return response()->json([
                'messageTitle' => 'Alert',
                'messageText'  => '',
                'class'        => 'error'
            ]);
    }
}
