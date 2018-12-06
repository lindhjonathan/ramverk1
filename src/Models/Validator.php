<?php

namespace Jodn14\Models;

/**
 * Model for validating an ip address
 *
 */
class Validator
{
    /**
     * calls ipstack with ip parameter
     *
     * @param string ip-address
     * @return array
     */
    public static function validateIp($ipAddress) : array
    {
        //valideringslogik
        $hostname = "undefined host";

        if (filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            $result = $ipAddress . " is a valid IPv6 Address.";
            $hostname = gethostbyaddr($ipAddress);
        } else if (filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            $result = $ipAddress . " is a valid IPv4 Address.";
            $hostname = gethostbyaddr($ipAddress);
        } else {
            $result = $ipAddress . " is not a valid IP Address.";
        }
        $data = [
            "result" => $result,
            "hostname" => $hostname
        ];

        return $data;
    }
}
