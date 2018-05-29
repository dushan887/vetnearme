<?php

namespace App\ModelQueries;

use App\User;
use App\Helpers\Strings;

class UserQuery extends User
{

    protected $table = 'users';

    private $_avatarDirectory;

    public function __construct()
    {
        $this->_avatarDirectory = public_path('/img/avatars/');
    }

    public function updateUser($data, $request, $userID = null)
    {
        $user = !$userID ? \Auth::user() : User::find($userID);

        if($request->hasFile('avatar')){

            if($user->avatar)
                $this->deleteOldAvatar($user->avatar);

            $user->avatar = $this->uploadAvatar($request->file('avatar'));
        }

        $user->first_name = $data['first_name'];
        $user->last_name  = $data['last_name'];
        $user->gender     = $data['gender'];
        $user->position   = $data['position'];
        $user->phone      = $data['phone'];
        $user->location   = $data['location'];
        $user->about      = $data['about'] ?? '';
        $user->social     = Strings::arrayToJson($data['social']);

        dd($user);

        if($user->update())
            return true;

        return false;
    }

    private function uploadAvatar($avatar)
    {
        $name = uniqid('avatar_') . ' . ' . $avatar->getClientOriginalExtension();

        $logo->move($this->_avatarDirectory, $name);

        return $name;
    }

    private function deleteOldAvatar($avatar)
    {
        File::delete($this->_avatarDirectory . $avatar);
    }


}
