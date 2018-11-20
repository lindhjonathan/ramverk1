<?php
/**
 * Load the json validator as Controller Class
 */
return [
    "routes" => [
        [
            "info" => "JSON Address Validator",
            "mount" => "json",
            "handler" => "\Anax\IP\OwnJSONController",
        ],
    ]
];
