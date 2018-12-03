<?php
/**
 * Configuration file for request service.
 */
return [
    // Services to add to the container.
    "services" => [
        "curl" => [
            "shared" => true,
            "callback" => function () {
                $curl = new \Anax\Curl\Curl();

                //Load Configuration Files
                $cfg = $this->get("configuration");
                $config = $cfg->load("curl");

                //Set API Keys
                $weatherKey = $config["config"]["weatherKey"] ?? null;
                $ipstackKey = $config["config"]["ipstackKey"] ?? null;
                $mapquestKey = $config["config"]["mapquestKey"] ?? null;
                if (is_string($weatherKey)) {
                    $curl->setKeys($weatherKey, $ipstackKey, $mapquestKey);
                }
                return $curl;
            }
        ],
    ],
];
