<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';

    /**
     * Get the clinics associated with the coutry.
     */
    public function clinic()
    {
        return $this->hasMany(Clinic::class);
    }
}


