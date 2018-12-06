<?php

namespace Anax\Geo;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the OwnJsonController.
 */
class OwnJSONLocationControllerTest extends TestCase
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
        $this->controller = new OwnJSONLocationController();
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
     * Test the route ""locate/value".
     */
    public function testlocateActionGet()
    {
        $res4 = $this->controller->locateActionGet("69.89.31.226");
        $res6 = $this->controller->locateActionGet("2002:4559:1fe2::4559:1fe2");
        $resFail = $this->controller->locateActionGet("255.255.255.252627");

        $this->assertInternalType("array", $res6);
        $countryName6 = $res6[0]["country_name"];
        $exp6country  = "United States";
        $this->assertContains($exp6country, $countryName6);

        $json4 = $res4[0];
        $json6 = $res6[0];
        $jsonFail = $resFail[0];
        $exp4 = "is a valid IPv4 Address.";
        $exp6 = "is a valid IPv6 Address.";
        $expFail = "is not a valid IP Address.";
        $this->assertContains($exp4, $json4["result"]);
        $this->assertContains($exp6, $json6["result"]);
        $this->assertContains($expFail, $jsonFail["result"]);
    }

    /**
     * Test the route "locate" with POST.
     */
    public function testlocateActionPost()
    {
        $request = $this->di->get("request");
        $request->setGlobals(
            [
                "post" => [
                    "ip_address" => "69.89.31.226",
                ]
            ]
        );
        $res4 = $this->controller->locateActionPost();

        $request = $this->di->get("request");
        $request->setGlobals(
            [
                "post" => [
                    "ip_address" => "2001:6b0:2a:c280:487c:27f8:34d6:1435",
                ]
            ]
        );
        $res6 = $this->controller->locateActionPost();

        $request = $this->di->get("request");
        $request->setGlobals(
            [
                "post" => [
                    "ip_address" => "255.255.255.252627",
                ]
            ]
        );
        $resF = $this->controller->locateActionPost();

        $this->assertInternalType("array", $res4);
        $countryName4 = $res4[0]["country_name"];
        $exp4country  = "United States";
        $this->assertContains($exp4country, $countryName4);

        $json4 = $res4[0];
        $json6 = $res6[0];
        $jsonF = $resF[0];
        $exp4 = "is a valid IPv4 Address.";
        $exp6 = "is a valid IPv6 Address.";
        $expF = "is not a valid IP Address.";
        $this->assertContains($exp4, $json4["result"]);
        $this->assertContains($exp6, $json6["result"]);
        $this->assertContains($expF, $jsonF["result"]);
    }
}
