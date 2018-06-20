<?php

namespace App\Statics;

class Radius {

    const RADIUS = [
        '2'  => '2km',
        '5'  => '5km',
        '10'  => '10km',
        '25'  => '25km',
        '50'  => '50km',
        '100' => '100km',
        '200' => '200km',
        '500' => '500km',
        //'all' => 'Show All',

    ];

    static public function get()
    {
        return self::RADIUS;
    }

}