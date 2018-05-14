<?php

namespace App\Helpers;

use App\Country;

class Geolocation
{
    // array $address
    // Needs to contains following keys
    // city, address, zip and country ID
    public static function getCoordinates(array $address)
    {
        $country = Country::find($address['country_id']);

        $response = \Geocode::make()->address("{$address['city']} {$address['address']} {$address['zip']}, $country->name");

        if(!$response)
            return null;

        return $response;
    }
}
