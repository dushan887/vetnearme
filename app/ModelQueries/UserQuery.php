<?php

namespace App\ModelQueries;

use App\User;
use App\Events\ClinicUpdate;
use App\Events\NewUser;
use App\Events\UserUpdate;
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

    public function store($data, $request)
    {
        if($request->hasFile('avatar'))
            $data['avatar'] = $this->uploadAvatar($request->file('avatar'));

        $password = \Hash::make($data['temp_password']);

        $this->first_name         = $data['first_name'];
        $this->last_name          = $data['last_name'];
        $this->email              = $data['email'];
        $this->gender             = $data['gender'];
        $this->title              = $data['title'];
        $this->position           = $data['position'];
        $this->phone              = $data['phone'];
        $this->location           = $data['location'];
        $this->about              = $data['about'] ?? '';
        $this->social             = Strings::arrayToJson($data['social']);
        $this->password           = $password;
        $this->temporary_password = $password;

        // Assign the clinic_id from the select menu (only super admin have the permission to do this)
        if(\Auth::user()->hasRole('super_admin') && isset($data['clinic_user']))
            $this->clinic_id = (int) $data['clinic_user'];

        // If the admin of the clinic is creating the user we wiil use his clinic_id for the new user
        if(\Auth::user()->hasRole('admin'))
            $this->clinic_id = \Auth::user()->clinic_id;

        if($this->save()){

            event(new NewUser($this, $data['temp_password']));

            if(\Auth::user()->hasRole('super_admin') && isset($data['clinic_owner']))
                event(new ClinicUpdate($this));

            if(\Auth::user()->hasRole('super_admin', 'admin') && \Auth::user()->id !== $this->id)
                $this->giveRole($data['user_role']);

            return true;
        }

        return false;

    }

    public function updateUser($data, $request, $userID = null)
    {
        $user = !$userID ? \Auth::user() : User::find($userID);

        if($request->hasFile('avatar')){

            if($user->avatar)
                $this->deleteOldAvatar($user->avatar);

            $user->avatar = $this->uploadAvatar($request->file('avatar'));
        }

        $user->first_name         = $data['first_name'];
        $user->last_name          = $data['last_name'];
        $user->gender             = $data['gender'];
        $user->title              = $data['title'];
        $user->position           = $data['position'];
        $user->phone              = $data['phone'];
        $user->location           = $data['location'];
        $user->about              = $data['about'] ?? '';
        $user->social             = Strings::arrayToJson($data['social']);

        if($user->hasRole('super_admin')){

            if(isset($data['clinic_owner']))
                event(new ClinicUpdate($user, $data['clinic_owner']));

            if(isset($data['clinic_user']))
                $user->clinic_id = (int) $data['clinic_user'];

            if(\Auth::user()->id !== $user->id)
                $user->giveRole($data['user_role']);

        }

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
