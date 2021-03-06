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
        'name', 'description', 'email', 'phone_number', 'emergency_number', 'city', 'address', 'zip', 'country_id', 'state', 'lat', 'lng', 'bookmark_url', 'special_notes', 'social_media', 'opening_hours', 'meta_description',
        'keywords',
        'general_practice', 'specialist_and_emergency', 'accessibility', 'logo', 'marker', 'owner_id', 'url', 'timezone',
    ];

    public function isOwner($userID)
    {
        if($this->owner_id === $userID)
            return true;

        return false;
    }

    public function media()
    {
        return $this->hasMany(Media::class);
    }

    public function gallery()
    {
        return $this->hasMany(ClinicGallery::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function owner()
    {
        return $this->hasOne(User::class, 'id', 'owner_id');
    }

    /**
     * Get the country associated with the clinic.
     */
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function services()
    {
       return $this->belongsToMany(Service::class, 'clinics_services', 'clinic_id', 'service_id');
    }
}
