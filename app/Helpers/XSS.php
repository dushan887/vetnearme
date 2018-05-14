<?php

namespace App\Helpers;

class XSS
{
    public static function clean($data, array $exclude = [])
    {
        if(!is_array($data))
            return htmlspecialchars(strip_tags($data), ENT_QUOTES, 'UTF-8');

        array_walk_recursive($data, function(&$data, $key) use ($exclude) {

            if(in_array($key, $exclude))
                $data = htmlspecialchars(strip_tags($data), ENT_QUOTES, 'UTF-8');

        });

        return $data;
    }
}
