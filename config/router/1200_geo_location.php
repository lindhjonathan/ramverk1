<?php
/**
 * Load the stylechooser as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "IP Geo Location",
            "mount" => "geo",
            "handler" => "\Anax\Geo\GeoLocationController",
        ],
    ]
];
