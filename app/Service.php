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
        'name', 'count', 'priority'
    ];

    public function clinics()
    {
       return $this->hasMany(Clinic::class, 'clinics_services');
    }

    static function updateCount(array $ids)
    {
        \DB::table('services')->whereIn('id', $ids)->increment('count');
    }
}
