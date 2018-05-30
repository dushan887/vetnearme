<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PasswordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'menu.admin']);
    }

    public function index()
    {
        return view('users.changePassword');
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = \Auth::user();

        $user->password           = \Hash::make($data['password']);
        $user->temporary_password = null;

        $user->update();

        return redirect()->route('profile');
    }
}
