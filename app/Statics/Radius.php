<?php

namespace App\Statics;

class Radius {

    const RADIUS = [
        '2',
        '5',
        '10',
        '25',
        '50',
        '100',
        '200',
        '500',
    ];

    static public function get()
    {
        return self::RADIUS;
    }

}