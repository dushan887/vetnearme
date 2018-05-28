<?php

namespace App;

use App\User;

class UserQuery extends Authenticatable
{

     protected $table = 'users';

    public function update($data)
    {
        $user = \Auth::user();
    }

}
