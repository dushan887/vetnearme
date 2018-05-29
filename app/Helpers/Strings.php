<?php

namespace App\Helpers;

class Strings
{
    static function arrayToJson(array $array)
    {
        return json_encode(array_filter(array_map('trim', $array)));
    }
}
