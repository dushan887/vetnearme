<?php

namespace App;

use App\App\Permissions\HasPermissionsTrait;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasPermissionsTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'about', 'education', 'position', 'phone',
        'social', 'title', 'gender', 'avatar', 'location', 'email', 'password',
        'temporary_password', 'verified', 'clinic_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function clinic()
    {
       return $this->belongsTo(Clinic::class);
    }

    public function files()
    {
       return $this->hasMany('App/Media');
    }

    public function verifyUser()
    {
        return $this->hasOne('App\VerifyUser');
    }

}
