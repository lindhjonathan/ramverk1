<?php

namespace Anax\Weather;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the OwnJsonController.
 */
class OwnJSONControllerTest extends TestCase
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
        $this->controller = new OwnJSONWeatherController();
        $this->controller->setDI($this->di);
        $this->controller->initialize();
    }



    /**
     * Test the route "index".
     */
    public function testIndexAction()
    {
        $res = $this->controller->indexAction();
        $this->assertInternalType("array", $res);

        $json = $res[0];
        $exp = "JSON REST API working";
        $this->assertContains($exp, $json["result"]);
    }



    /**
     * Test the route "forecast/value".
     */
    public function testforecastActionGet()
    {
        $resIP = $this->controller->forecastActionGet("69.89.31.226");
        $resCity = $this->controller->forecastActionGet("Karlskrona");
        $resFail = $this->controller->forecastActionGet("awdawdhhhaw");

        $this->assertInternalType("array", $resCity);
        $city = $resCity[0]["city"];
        $expCity = "Karlskrona";
        $this->assertContains($expCity, $city);

        $expIP = "box426.bluehost.com";
        $expCity = 56.1621073;
        $expFail = "Invalid Location";
        $this->assertContains($expIP, $resIP[0]["hostname"]);
        $this->assertEquals($expCity, $resCity[0]["latitude"]);
        $this->assertContains($expFail, $resFail[0]["error"]);
    }


    /**
     * Test the route "past/value".
     */
    public function testpastActionGet()
    {
        $resIP = $this->controller->pastActionGet("69.89.31.226");
        $resCity = $this->controller->pastActionGet("Karlskrona");
        $resFail = $this->controller->pastActionGet("awdawdhhhaw");

        $this->assertInternalType("array", $resCity);
        $city = $resCity[0]["city"];
        $expCity = "Karlskrona";
        $this->assertContains($expCity, $city);

        $expIP = "box426.bluehost.com";
        $expCity = 56.1621073;
        $expFail = "Invalid Location";
        $this->assertContains($expIP, $resIP[0]["hostname"]);
        $this->assertEquals($expCity, $resCity[0]["latitude"]);
        $this->assertContains($expFail, $resFail[0]["error"]);
    }

    /**
     * Test the route "forecast" with POST.
     */
    public function testforecastActionPost()
    {
        $request = $this->di->get("request");
        $request->setPost("userInput", "69.89.31.226");
        $resIP = $this->controller->forecastActionPost();

        $request = $this->di->get("request");
        $request->setPost("userInput", "Karlskrona");
        $resCity = $this->controller->forecastActionPost();

        $request = $this->di->get("request");
        $request->setPost("userInput", "aoiwdnnndn23fail");
        $resFail = $this->controller->forecastActionPost();

        $this->assertInternalType("array", $resCity);
        $city = $resCity[0]["city"];
        $expCity = "Karlskrona";
        $this->assertContains($expCity, $city);


        $expIP = "box426.bluehost.com";
        $expCity = 56.1621073;
        $expFail = "Invalid Location";
        $this->assertContains($expIP, $resIP[0]["hostname"]);
        $this->assertEquals($expCity, $resCity[0]["latitude"]);
        $this->assertContains($expFail, $resFail[0]["error"]);
    }

    /**
     * Test the route "past" with POST.
     */
    public function testpastActionPost()
    {
        $request = $this->di->get("request");
        $request->setPost("userInput", "69.89.31.226");
        $resIP = $this->controller->pastActionPost();

        $request = $this->di->get("request");
        $request->setPost("userInput", "Karlskrona");
        $resCity = $this->controller->pastActionPost();

        $request = $this->di->get("request");
        $request->setPost("userInput", "aoiwdnnndn23fail");
        $resFail = $this->controller->pastActionPost();

        $this->assertInternalType("array", $resCity);
        $city = $resCity[0]["city"];
        $expCity = "Karlskrona";
        $this->assertContains($expCity, $city);


        $expIP = "box426.bluehost.com";
        $expCity = 56.1621073;
        $expFail = "Invalid Location";
        $this->assertContains($expIP, $resIP[0]["hostname"]);
        $this->assertEquals($expCity, $resCity[0]["latitude"]);
        $this->assertContains($expFail, $resFail[0]["error"]);
    }
}
