<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Users;
use App\Statics\Titles;

use App\Http\Requests\UserUpdateRequest;

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
        $user = \Auth::user();

        return view('users/edit', [
            'user'   => $user,
            'social' => json_decode($user->social),
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

    public function update(UserUpdateRequest $request)
    {
        $validated = $request->validated();

        $model = new UserQuery;

        $model->update($validated);
    }


}
