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
        'name', 'description', 'email', 'phone_number', 'emergency_number', 'city', 'address', 'zip', 'country_id', 'lat', 'lng', 'gmaps_link', 'special_notes',
        'social_media', 'opening_hours', 'general_practice', 'specialist_and_emergency', 'logo', 'owner_id'
    ];

    public function isOwner($userID)
    {
        if($this->owner_id === $userID)
            return true;

        return false;
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the country associated with the clinic.
     */
    public function country()
    {
        return $this->hasOne('Country');
    }

    public function services()
    {
       return $this->belongsToMany(Service::class, 'clinics_services', 'clinic_id', 'service_id');
    }
}
