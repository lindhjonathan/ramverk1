<?php

namespace Jodn14\Weather;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Jodn14\Models\Validator;
use Jodn14\Models\Locator;

/**
 * Json Locator Controller. Validates and gets location data from third part api(ipstack)
 * returns response in json format to blank page
 */
class OwnJSONWeatherController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     * @var string $db a sample member variable that gets initialised
     */
    private $db = "not active";
    private $validator;
    private $locator;

    /**
     * The initialize method is optional and will always be called before the
     * target method/action. This is a convienient method where you could
     * setup internal properties that are commonly used by several methods.
     *
     * @return void
     */
    public function initialize() : void
    {
        // Use to initialise member variables.
        $this->db = "active";
        $this->validator = new Validator();
        $this->locator = new Locator();
    }



    /**
     * Display index resultset in JSON format
     *
     * @return array
     */
    public function indexAction() : array
    {
        $json = [
            "result" => "JSON REST API working",
        ];
        return [$json];
    }


    /**
     * This sample method action takes one argument:
     * GET mountpoint/argument/<value>
     *
     * @param mixed $value
     *
     * @return array
     */
    public function forecastActionGet($value) : array
    {
        $curl = $this->di->get("curl");

        $valid = $this->validator->validateIp($value);
        if ($valid["hostname"] == "undefined host") {
            //valid, check what the return contents are
            $location = $curl->getCoordinates($value);
            if (in_array(400, $location)) {
                if ($location["code"] == 400) {
                    $json = $location;

                    return [$json];
                }
            }
            $latitude = $location["lat"];
            $longitud = $location["lon"];
        } else {
            $location = $this->locator->getLocation($value);
            $longitud = $location["longitud"];
            $latitude = $location["latitude"];
            $value = $location["city"];
        }
        $weather = $curl->getForecast($latitude, $longitud);
        $info = [
            "city" => $value,
            "latitude" => $latitude ?? null,
            "longitud" => $longitud ?? null,
        ];

        $json = array_merge($valid, array_merge($weather, $info));
        return [$json];
    }

    /**
     * This sample method action takes one argument:
     * GET mountpoint/argument/<value>
     *
     * @param mixed $value
     *
     * @return array
     */
    public function pastActionGet($value) : array
    {
        $curl = $this->di->get("curl");

        $valid = $this->validator->validateIp($value);
        if ($valid["hostname"] == "undefined host") {
            //valid, check what the return contents are
            $location = $curl->getCoordinates($value);
            if (in_array(400, $location)) {
                if ($location["code"] == 400) {
                    $json = $location;

                    return [$json];
                }
            }
            $latitude = $location["lat"];
            $longitud = $location["lon"];
        } else {
            $location = $this->locator->getLocation($value);
            $longitud = $location["longitud"];
            $latitude = $location["latitude"];
            $value = $location["city"];
        }
        $weather = $curl->getPast($latitude, $longitud);

        $info = [
            "city" => $value,
            "latitude" => $latitude ?? null,
            "longitud" => $longitud ?? null,
        ];

        $json = array_merge($valid, array_merge($weather, $info));
        return [$json];
    }

    /**
     * POST to get forecast in json
     *
     * @return array    JSON Array
     */
    public function forecastActionPost() : array
    {
        $request = $this->di->get("request");
        $userInput = $request->getPost("userInput");
        $curl = $this->di->get("curl");

        $valid = $this->validator->validateIp($userInput);
        if ($valid["hostname"] == "undefined host") {
            //valid, check what the return contents are
            $location = $curl->getCoordinates($userInput);
            if (in_array(400, $location)) {
                if ($location["code"] == 400) {
                    $json = $location;

                    return [$json];
                }
            }
            $latitude = $location["lat"];
            $longitud = $location["lon"];
        } else {
            $location = $this->locator->getLocation($userInput);
            $longitud = $location["longitud"];
            $latitude = $location["latitude"];
            $userInput = $location["city"];
        }
        $weather = $curl->getForecast($latitude, $longitud);

        $info = [
            "city" => $userInput,
            "latitude" => $latitude ?? null,
            "longitud" => $longitud ?? null,
        ];

        $json= array_merge($valid, array_merge($weather, $info));
        return [$json];
    }

    /**
     * POST to get forecast in json
     *
     * @return array    JSON Array
     */
    public function pastActionPost() : array
    {
        $request = $this->di->get("request");
        $userInput = $request->getPost("userInput");
        $curl = $this->di->get("curl");

        $valid = $this->validator->validateIp($userInput);
        if ($valid["hostname"] == "undefined host") {
            $location = $curl->getCoordinates($userInput);
            if (in_array(400, $location)) {
                if ($location["code"] == 400) {
                    $json = $location;

                    return [$json];
                }
            }
            $latitude = $location["lat"];
            $longitud = $location["lon"];
        } else {
            $location = $this->locator->getLocation($userInput);
            $longitud = $location["longitud"];
            $latitude = $location["latitude"];
            $userInput = $location["city"];
        }
        $weather = $curl->getPast($latitude, $longitud);

        $info = [
            "city" => $userInput,
            "latitude" => $latitude ?? null,
            "longitud" => $longitud ?? null,
        ];

        $json = array_merge($valid, array_merge($weather, $info));
        return [$json];
    }
}
