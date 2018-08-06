<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClinicGallery extends Model
{
    protected $table = 'clinic_gallery';

    protected $fillable = [
        'clinic_id', 'media_id'
    ];

    public function clinic()
    {
       return $this->belongsTo(Clinic::class);
    }

    public function media(){
        return $this->belongsTo(Media::class);
    }

}
