<?php
namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResultsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        
        return view('Front.results.index');
    }


}
