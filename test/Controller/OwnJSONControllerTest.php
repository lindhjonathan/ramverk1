<?php

namespace Anax\ip;

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
        $this->controller = new OwnJSONController();
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
        $this->assertContains($exp, $json["message"]);
    }



    /**
     * Test the route "validate/value".
     */
    public function testvalidateActionGet()
    {
        $resValid4 = $this->controller->validateActionGet("255.255.255.255");
        $resValid6 = $this->controller->validateActionGet("2001:6b0:2a:c280:487c:27f8:34d6:1435");
        $resFail = $this->controller->validateActionGet("255.255.255.252627");

        $this->assertInternalType("array", $resValid4);

        $json4 = $resValid4[0];
        $json6 = $resValid6[0];
        $jsonFail = $resFail[0];
        $exp4 = "is a valid IPv4 Address.";
        $exp6 = "is a valid IPv6 Address.";
        $expFail = "is not a valid IP Address.";
        $this->assertContains($exp4, $json4["result"]);
        $this->assertContains($exp6, $json6["result"]);
        $this->assertContains($expFail, $jsonFail["result"]);
    }

    /**
     * Test the route "validate" with POST.
     */
    public function testvalidateActionPost()
    {
        $request = $this->di->get("request");
        $request->setGlobals(
            [
                "post" => [
                    "ip_address" => "69.89.31.226",
                ]
            ]
        );
        $res4 = $this->controller->validateActionPost();

        $request = $this->di->get("request");
        $request->setGlobals(
            [
                "post" => [
                    "ip_address" => "2001:6b0:2a:c280:487c:27f8:34d6:1435",
                ]
            ]
        );
        $res6 = $this->controller->validateActionPost();

        $request = $this->di->get("request");
        $request->setGlobals(
            [
                "post" => [
                    "ip_address" => "255.255.255.252627",
                ]
            ]
        );
        $resF = $this->controller->validateActionPost();

        $this->assertInternalType("array", $res4);
        $hostnameF = $resF[0]["hostname"];
        $expFhost  = "undefined host";
        $this->assertContains($expFhost, $hostnameF);

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
