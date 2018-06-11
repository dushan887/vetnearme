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
            'services' => Service::where('priority', '=', 1)->orderBy('count', 'desc')->get(),
        ]);
    }


}
