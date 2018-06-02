<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'count',
    ];

    public function clinics()
    {
       return $this->hasMany(Clinic::class, 'clinics_services');
    }
}
