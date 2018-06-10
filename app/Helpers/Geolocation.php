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

    /**
     * Try to guess the coordinates based on input provided by the user
     *
     * @param string $address
     * @return coordinates
     */
    public static function guessCoordinates(string $address)
    {
        $response = \Geocode::make()->address($address);

        if(!$response)
            return null;

        return $response;
    }
}
