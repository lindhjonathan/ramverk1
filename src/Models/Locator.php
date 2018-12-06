<?php

namespace Jodn14\Models;

/**
 * Model for IP Locator logic
 */
class Locator
{
    /*
     * Private $access_key contains key to third party API - ipstack.com
     */

    private $accessKey = "26ac05fc6257e7fc03c369cec5552b0a";

    /**
     * calls ipstack with ip parameter
     *
     * @param string ip-address
     * @return array
     */
    public function getLocation($ipAddress) : array
    {
        $apiCall = curl_init('http://api.ipstack.com/'.$ipAddress.'?access_key='.$this->accessKey.'');
        curl_setopt($apiCall, CURLOPT_RETURNTRANSFER, true);

        $json = curl_exec($apiCall);
        curl_close($apiCall);

        $apiResult = json_decode($json, true);
        $filtered = [
            "ip"           => $apiResult["ip"],
            "type"         => $apiResult["type"],
            "country_name" => $apiResult["country_name"],
            "city"         => $apiResult["city"],
            "latitude"     => $apiResult["latitude"],
            "longitud"     => $apiResult["longitude"]
        ];

        return $filtered;
    }
}
