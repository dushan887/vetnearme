<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClinicImages extends Model
{
    public function clinic()
    {
       return $this->belongsTo(Clinic::class);
    }
}
