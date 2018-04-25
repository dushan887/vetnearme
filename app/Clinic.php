<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'email', 'phone_number', 'phone_number2', 'address', 'lat', 'lng', 'gmaps_link',
        'social_media', 'opening_hours', 'logo', 'owner_id'
    ];

    public function services()
    {
       return $this->belongsToMany(Services::class, 'clinics_services');
    }
}
