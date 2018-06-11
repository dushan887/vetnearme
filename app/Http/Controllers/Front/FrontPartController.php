<?php
namespace App\Http\Controllers\Front;

use App\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontPartController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('Front.home.index',[
            'services'         => Service::where('priority', '=', 1)->orderBy('count', 'desc')->get(),
            // This are default values for extra search inputs
            // Since the search file is shared, we need the default values to avoid possible errors
            'category'         => 'all',
            'advancedSearch'   => false,
            'selectedServices' => []
        ]);
    }


}
