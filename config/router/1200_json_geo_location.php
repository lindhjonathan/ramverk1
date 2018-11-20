<?php
/**
 * Load the json validator as Controller Class
 */
return [
    "routes" => [
        [
            "info" => "JSON IP Location",
            "mount" => "gjson",
            "handler" => "\Anax\Geo\OwnJSONLocationController",
        ],
    ]
];
