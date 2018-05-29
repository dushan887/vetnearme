<?php

namespace App\ModelQueries;

use App\User;
use App\Helpers\Strings;

class UserQuery extends User
{

    protected $table = 'users';

    private $_avatarDirectory;
    private $_avatarThumbsDirectory;

    public function __construct()
    {
        $this->_avatarDirectory       = public_path('/avatars/');
        $this->_avatarThumbsDirectory = $this->_avatarDirectory . "thumbs/";
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
        $user->title      = $data['title'];
        $user->position   = $data['position'];
        $user->phone      = $data['phone'];
        $user->location   = $data['location'];
        $user->about      = $data['about'] ?? '';
        $user->social     = Strings::arrayToJson($data['social']);

        if($user->update())
            return true;

        return false;
    }

    private function uploadAvatar($avatar)
    {
        $image = \Image::make($avatar->getPathName());

        $name  = uniqid('avatar_') . '.' . $avatar->getClientOriginalExtension();

        $image->save($this->_avatarDirectory . $name);

        // Make thumbs
        $image->fit(250, 250);
        $image->save($this->_avatarThumbsDirectory  . "/" . $name);

        return $name;
    }

    private function deleteOldAvatar($avatar)
    {
        File::delete($this->_avatarDirectory . $avatar);
        File::delete($this->_avatarThumbsDirectory . $avatar);
    }


}
