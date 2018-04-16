<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public function clinics()
    {
       return $this->belongsToMany(Clinic::class, 'clinics_services');
    }
}
