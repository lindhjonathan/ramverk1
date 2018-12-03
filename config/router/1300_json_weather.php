<?php
/**
 * Load the json validator as Controller Class
 */
return [
    "routes" => [
        [
            "info" => "JSON Weather Service",
            "mount" => "wjson",
            "handler" => "\Anax\Weather\OwnJSONWeatherController",
        ],
    ]
];
