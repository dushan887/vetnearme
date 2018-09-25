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

        if(!strpos($response->formattedAddress(), "Australia"))
            $response = \Geocode::make()->address($address . " Australia");

        if(!$response)
            return null;

        return $response;
    }

    public static function getTimezone($coordinates)
    {
        $time = time();
        $url  = "https://maps.googleapis.com/maps/api/timezone/json?location={$coordinates['lat']},{$coordinates['lng']}&timestamp=$time&key=AIzaSyAcrIAbpZUflBVuRlUwYWfdRr_fmLy_sio";
        $ch   = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $responseJson = curl_exec($ch);
        curl_close($ch);

        $response = json_decode($responseJson);

        dd($response);
    }
}
