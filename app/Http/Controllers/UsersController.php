<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Users;
use App\Statics\Titles;

class UsersController extends Controller
{
    /**
     * Show the dashboard Users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('users/index', [
            'users' => \Auth::user(),
        ]);
    }

     /**
     * Show the dashboard Users.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        return view('users/edit', [
            'user'   => \Auth::user(),
            'titles' => Titles::TITLES,
        ]);
    }

    /**
     * Show the dashboard Edit User.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        return view('users/edit_user');
    }

    /**
     * Show the dashboard New User.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('users/new_user');
    }

    public function update(Request $request)
    {
        dd(333);
    }


}
