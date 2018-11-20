<?php

namespace Anax\Models;

/**
 * Model for IP Locator logic
 */
class Locator
{
    /*
     * Private $access_key contains key to third party API - ipstack.com
     */

    private $access_key = "26ac05fc6257e7fc03c369cec5552b0a";

    /**
     * calls ipstack with ip parameter
     *
     * @param string ip-address
     * @return array
     */
    public function getLocation($ip) : array
    {
        $ch = curl_init('http://api.ipstack.com/'.$ip.'?access_key='.$this->access_key.'');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $json = curl_exec($ch);
        curl_close($ch);

        $api_result = json_decode($json, true);
        $filtered = [
            "ip"           => $api_result["ip"],
            "type"         => $api_result["type"],
            "country_name" => $api_result["country_name"],
            "city"         => $api_result["city"],
            "latitude"     => $api_result["latitude"],
            "longitud"     => $api_result["longitude"]
        ];

        return $filtered;
    }
}
