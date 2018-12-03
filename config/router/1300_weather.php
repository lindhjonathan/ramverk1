<?php
/**
 * Load the weather service as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "Weather Service",
            "mount" => "weather",
            "handler" => "\Anax\Weather\WeatherController",
        ],
    ]
];
