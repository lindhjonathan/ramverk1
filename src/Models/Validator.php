<?php

namespace Anax\Models;

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
    static public function validateIp($ip) : array
    {
        //valideringslogik
        $hostname = "undefined host";

        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            $result = $ip . " is a valid IPv6 Address.";
            $hostname = gethostbyaddr($ip);
        } else if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            $result = $ip . " is a valid IPv4 Address.";
            $hostname = gethostbyaddr($ip);
        } else {
            $result = $ip . " is not a valid IP Address.";
        }
        $data = [
            "result" => $result,
            "hostname" => $hostname
        ];

        return $data;
    }
}
