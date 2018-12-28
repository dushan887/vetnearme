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

        if(!$response || !strpos($response->formattedAddress(), "Australia"))
            $response = \Geocode::make()->address($address . " Australia");

        if(!$response)
            return null;

        return $response;
    }

    public static function getTimezoneIP(string $ip)
    {
        $url = "https://api.ipgeolocation.io/ipgeo?apiKey=6cccfd52cc4940409fb57fa1a7739e96&ip={$ip}";

        $ch   = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $responseJson = curl_exec($ch);
        curl_close($ch);

        $response = json_decode($responseJson);

        if(isset($response->time_zone->name))
            return $response->time_zone->name;

        return null;
    }

    public static function getTimezoneCoordinates(array $coordinates)
    {
        $key = env('TIMEZONE_DB_KEY');

        $url  = "http://api.timezonedb.com/v2.1/get-time-zone?key={$key}&lat={$coordinates['lat']}&lng={$coordinates['lng']}&by=position&format=json&fields=zoneName";
        $ch   = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response);

    }
}
