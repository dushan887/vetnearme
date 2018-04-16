<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    public function services()
    {
       return $this->belongsToMany(Services::class, 'clinics_services');
    }
}
