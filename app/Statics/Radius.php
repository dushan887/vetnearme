<?php

namespace App\Statics;

class Radius {

    const RADIUS = [

        '10'  => '10km',
        '20'  => '20km',
        '30'  => '30km',
        '50'  => '50km',
        '100' => '100km',
        'all' => 'Show All',

    ];

    static public function get()
    {
        return self::RADIUS;
    }

}