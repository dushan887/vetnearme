<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Helpers\XSS;

use App\User;
use App\ModelQueries\UserQuery;
use App\Statics\Titles;

use App\Http\Requests\UserCreateRequest;
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
        $users = \Auth::user()->hasRole('super_admin') ?
            User::paginate(20) :
            User::where('clinic_id', '=', \Auth::user()->clinic_id)->get()->paginate(20);

        return view('users/index', [
            'users'  => $users,
            'titles' => Titles::TITLES,
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create', [
            'titles' => Titles::TITLES,
        ]);
    }

    /**
     * Show the dashboard Edit User.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $user = User::find($id);

        return view('users/edit', [
            'user'   => $user,
            'social' => json_decode($user->social),
            'titles' => Titles::TITLES,
        ]);
    }

    public function update(UserUpdateRequest $request)
    {
        $validated = $request->validated();

        $model = new UserQuery;

        if(!$model->updateUser(XSS::clean($validated, ['avatar']), $request))
             Session::flash('alert', [
                'message' => 'Something went wrong. Please try again',
                'type'    => 'danger'
            ]);

        return \Redirect::back();
    }

    public function store(UserCreateRequest $request)
    {
        $validated = $request->validated();

        $model = new UserQuery;

        if(!$model->store(XSS::clean($validated, ['avatar']), $request)){

            Session::flash('alert', [
                'message' => 'Something went wrong. Please try again',
                'type'    => 'danger'
            ]);

            return \Redirect::back();
        }

        return redirect('/admin/users');

    }

    public function destroy($id)
    {
        $user  = \Auth::user();
        $error = true;
        $id    = (int) $id;

        // Super admin can delete all user accounts
        if($user->hasRole('super_admin'))
            $error = User::destroy($id) ? false : true;

        // Normal admin can only delete users from his own clinic
        if($user->hasRole('admin') && $deletingUser->clinic_id === $user->clinic_id)
            $error = $deletingUser->destroy() ? false : true;

        // Normal users (without any admin priviledges) can delete only themselves
        if($user->hasRole('user') && $deletingUser->id === $user->id)
            $error = $deletingUser->destroy() ? false : true;

        $message = $error ?
            [
                'messageTitle' => 'Alert',
                'messageText'  => 'Something went wrong. Please try again a bit later',
                'class'        => 'error'
            ] :
            [
                'messageTitle' => 'User Deleted',
                'messageText'  => 'The user has been deleted',
                'class'        => 'success'
            ];

        return response()->json($message, $error ? 404 : 200);

    }


}
