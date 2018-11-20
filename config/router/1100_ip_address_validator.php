<?php
/**
 * Load the stylechooser as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "IP Address Validator",
            "mount" => "ip",
            "handler" => "\Anax\IP\IpAddressController",
        ],
    ]
];
