<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('checkRole:super_admin');
    }

    /**
     * Show the dashboard User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('user/index');
    }

    
}
