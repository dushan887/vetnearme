<?php

namespace App\Statics;

class Radius {

    const RADIUS = [
        '5',
        '10',
        '25',
        '50',
    ];

    static public function get()
    {
        return self::RADIUS;
    }

}