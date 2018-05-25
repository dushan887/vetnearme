<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'extension', 'user_id', 'clinic_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function clinic()
    {
        return $this->belongsTo('App\Clinic');
    }
}
