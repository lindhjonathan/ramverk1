<?php

namespace Jodn14\Weather;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Jodn14\Models\Validator;
use Jodn14\Models\Locator;

/**
 * Weather controller that 1) brings the user forecasts for the next 7 days
 * 2) Shows what the weather's been like for the past 30 days
 * Does so by taking IP-address or City name and calling Dark Sky API
 *
 */
class WeatherController implements ContainerInjectableInterface
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
     * Display index with input form
     *
     * @return object
     */
    public function indexAction() : object
    {
        $title = "Weather";
        $request = $this->di->get("request");

        $data = [
            "userIp" => $request->getServer("REMOTE_ADDR"),
        ];

        $page = $this->di->get("page");
        $page->add("anax/weather/index", $data);

        return $page->render([
            "title" => $title,
        ]);
    }

    /**
     * Display index with json input form
     *
     * @return object
     */
    public function jsonAction() : object
    {
        $title = "JSON Weather Service";
        $request = $this->di->get("request");

        $data = [
            "userIp" => $request->getServer("REMOTE_ADDR"),
        ];

        $page = $this->di->get("page");
        $page->add("anax/weather/json", $data);

        return $page->render([
            "title" => $title,
        ]);
    }

    /**
     * POST form processing, get ip and lookup weather
     *
     * @return object
     */
    public function pastActionPost() : object
    {
        $title = "Weather Service";
        $request = $this->di->get("request");
        $page = $this->di->get("page");
        $curl = $this->di->get("curl");
        $userInput = $request->getPost("userInput");

        $valid = $this->validator->validateIp($userInput);
        if ($valid["hostname"] == "undefined host") {
            $location = $curl->getCoordinates($userInput);

            if (in_array(400, $location)) {
                if ($location["code"] == 400) {
                    $page->add("anax/weather/invalid", $location);

                    return $page->render([
                        "title" => $title,
                    ]);
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

        $data = [
            "city" => $userInput,
            "latitude" => $latitude ?? null,
            "longitud" => $longitud ?? null,
            "weather" => $weather,
        ];

        $page->add("anax/weather/past", $data);

        return $page->render([
            "title" => $title,
        ]);
    }

    /**
     * POST form processing, get ip and lookup weather
     *
     * @return object
     */
    public function forecastActionPost() : object
    {
        $title = "Weather Service";
        $request = $this->di->get("request");
        $page = $this->di->get("page");
        $curl = $this->di->get("curl");
        $userInput = $request->getPost("userInput");

        $valid = $this->validator->validateIp($userInput);
        if ($valid["hostname"] == "undefined host") {
            $location = $curl->getCoordinates($userInput);

            if (in_array(400, $location)) {
                if ($location["code"] == 400) {
                    $page->add("anax/weather/invalid", $location);

                    return $page->render([
                        "title" => $title,
                    ]);
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

        $data = array_merge($valid, array_merge($weather, $info));

        $page->add("anax/weather/forecast", $data);

        return $page->render([
            "title" => $title,
        ]);
    }
}
