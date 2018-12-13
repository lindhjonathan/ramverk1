<?php
/**
 * Supply the basis for the navbar as an array.
 */
return [
    // Use for styling the menu
    "wrapper" => null,
    "class" => "my-navbar rm-default rm-desktop",

    // Here comes the menu items
    "items" => [
        [
            "text" => "Hem",
            "url" => "",
            "title" => "Första sidan, börja här.",
        ],
        [
            "text" => "Redovisning",
            "url" => "redovisning",
            "title" => "Redovisningstexter från kursmomenten.",
            "submenu" => [
                "items" => [
                    [
                        "text" => "Kmom01",
                        "url" => "redovisning/kmom01",
                        "title" => "Redovisning för kmom01.",
                    ],
                    [
                        "text" => "Kmom02",
                        "url" => "redovisning/kmom02",
                        "title" => "Redovisning för kmom02.",
                    ],
                    [
                        "text" => "Kmom03",
                        "url" => "redovisning/kmom03",
                        "title" => "Redovisning för kmom03.",
                    ],
                    [
                        "text" => "Kmom04",
                        "url" => "redovisning/kmom04",
                        "title" => "Redovisning för kmom04.",
                    ],
                    [
                        "text" => "Kmom05",
                        "url" => "redovisning/kmom05",
                        "title" => "Redovisning för kmom05.",
                    ],
                    [
                        "text" => "Kmom06",
                        "url" => "redovisning/kmom06",
                        "title" => "Redovisning för kmom06.",
                    ],
                ],
            ],
        ],
        [
            "text" => "Om",
            "url" => "om",
            "title" => "Om denna webbplats.",
        ],
        [
            "text" => "IP",
            "url" => "ip",
            "title" => "IP Address validator",
            "submenu" => [
                "items" => [
                    [
                        "text" => "Validator",
                        "url" => "ip/index",
                        "title" => "IP Validator",
                    ],
                    [
                        "text" => "JSON Validator",
                        "url" => "ip/json",
                        "title" => "JSON REST API IP Validator",
                    ],
                ],
            ],
        ],
        [
            "text" => "Geolocation",
            "url" => "geo",
            "title" => "IP Geo locator",
            "submenu" => [
                "items" => [
                    [
                        "text" => "Geolocator",
                        "url" => "geo/index",
                        "title" => "IP Geo Locator",
                    ],
                    [
                        "text" => "JSON Locator",
                        "url" => "geo/json",
                        "title" => "JSON REST API Geo Locator",
                    ],
                ],
            ],
        ],
        [
            "text" => "Weather",
            "url" => "weather",
            "title" => "Weather Service",
            "submenu" => [
                "items" => [
                    [
                        "text" => "Weather Forecast",
                        "url" => "weather/index",
                        "title" => "Weather Forecast",
                    ],
                    [
                        "text" => "JSON Weather",
                        "url" => "weather/json",
                        "title" => "JSON REST API Weather Service",
                    ],
                ],
            ],
        ],
        [
            "text" => "Books",
            "url" => "book",
            "title" => "Bokdatabas",
        ],
        [
            "text" => "Verktyg",
            "url" => "verktyg",
            "title" => "Verktyg och möjligheter för utveckling.",
        ],
    ],
];
