<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Users;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('checkRole:super_admin');
    }

    /**
     * Show the dashboard Users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('users/index');
    }

    /**
     * Show the dashboard Edit User.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit_user(Request $request)
    {
        return view('users/edit_user');
    }

    /**
     * Show the dashboard New User.
     *
     * @return \Illuminate\Http\Response
     */
    public function new_user(Request $request)
    {
        return view('users/new_user');
    }

    
}
