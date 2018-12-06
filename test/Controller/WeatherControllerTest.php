<?php

namespace Jodn14\Weather;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the IpAddressController.
 */
class WeatherControllerTest extends TestCase
{

    // Create the di container.
    protected $di;
    protected $controller;



    /**
     * Prepare before each test.
     */
    protected function setUp()
    {
        global $di;

        // Setup di
        $this->di = new DIFactoryConfig();
        $this->di->loadServices(ANAX_INSTALL_PATH . "/config/di");

        // View helpers uses the global $di so it needs its value
        $di = $this->di;

        // Setup the controller
        $this->controller = new WeatherController();
        $this->controller->setDI($this->di);
        $this->controller->initialize();
    }



    /**
     * Test the route "index".
     */
    public function testIndexAction()
    {
        $res = $this->controller->indexAction();
        //$this->assertInternalType("array", $res);

        $exp = "Weather Service";
        $body = $res->getBody();
        $this->assertContains($exp, $body);
    }

    /**
     * Test the route "index".
     */
    public function testjsonAction()
    {
        $res = $this->controller->jsonAction();
        //$this->assertInternalType("array", $res);

        $exp = "JSON Weather";
        $body = $res->getBody();
        $this->assertContains($exp, $body);
    }


    /**
     * Test the route "forecast" with POST.
     */
    public function testforecastActionPost()
    {
        $request = $this->di->get("request");
        $request->setGlobals(
            [
                "post" => [
                    "userInput" => "69.89.31.226",
                ]
            ]
        );
        $resIP = $this->controller->forecastActionPost();

        $request = $this->di->get("request");
        $request->setGlobals(
            [
                "post" => [
                    "userInput" => "Karlskrona",
                ]
            ]
        );
        $resCity = $this->controller->forecastActionPost();

        $request = $this->di->get("request");
        $request->setGlobals(
            [
                "post" => [
                    "userInput" => "aoiwdnnndn23fail",
                ]
            ]
        );
        $resFail = $this->controller->forecastActionPost();

        $bodyIP = $resIP->getBody();
        $bodyCity = $resCity->getBody();
        $bodyFail = $resFail->getBody();

        $expIP = "Provo";
        $expCity = "Karlskrona";
        $expFail = "Invalid Location";
        $this->assertContains($expIP, $bodyIP);
        $this->assertContains($expCity, $bodyCity);
        $this->assertContains($expFail, $bodyFail);
    }



    /**
     * Test the route "weather/past" with POST.
     */
    public function testpastActionPost()
    {
        $request = $this->di->get("request");
        $request->setGlobals(
            [
                "post" => [
                    "userInput" => "69.89.31.226",
                ]
            ]
        );
        $resIP = $this->controller->pastActionPost();

        $request = $this->di->get("request");
        $request->setGlobals(
            [
                "post" => [
                    "userInput" => "Karlskrona",
                ]
            ]
        );
        $resCity = $this->controller->pastActionPost();

        $request = $this->di->get("request");
        $request->setGlobals(
            [
                "post" => [
                    "userInput" => "aoiwdnnndn23fail",
                ]
            ]
        );
        $resFail = $this->controller->pastActionPost();

        $bodyIP = $resIP->getBody();
        $bodyCity = $resCity->getBody();
        $bodyFail = $resFail->getBody();

        $expIP = "Provo";
        $expCity = "Karlskrona";
        $expFail = "Invalid Location";
        $this->assertContains($expIP, $bodyIP);
        $this->assertContains($expCity, $bodyCity);
        $this->assertContains($expFail, $bodyFail);
    }
}
