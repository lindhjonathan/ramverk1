<?php

namespace Anax\Geo;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the IpAddressController.
 */
class GeoLocationControllerTest extends TestCase
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
        $this->controller = new GeoLocationController();
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

        $exp = "IP Locator";
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

        $exp = "JSON IP Locator";
        $body = $res->getBody();
        $this->assertContains($exp, $body);
    }

    /**
     * Test the route "validate" with POST.
     */
    public function testlocatorActionPost()
    {
        $request = $this->di->get("request");
        $request->setGlobals(
            [
                "post" => [
                    "ip_address" => "69.89.31.226",
                ]
            ]
        );
        $res4 = $this->controller->locatorActionPost();

        $request = $this->di->get("request");
        $request->setGlobals(
            [
                "post" => [
                    "ip_address" => "2001:6b0:2a:c280:487c:27f8:34d6:1435",
                ]
            ]
        );
        $res6 = $this->controller->locatorActionPost();

        $request = $this->di->get("request");
        $request->setGlobals(
            [
                "post" => [
                    "ip_address" => "255.255.255.252627",
                ]
            ]
        );
        $resF = $this->controller->locatorActionPost();

        $expFhost  = "undefined host";
        $body4 = $res4->getBody();
        $body6 = $res6->getBody();
        $bodyF = $resF->getBody();
        $this->assertContains($expFhost, $bodyF);

        $exp4 = "is a valid IPv4 Address.";
        $exp6 = "is a valid IPv6 Address.";
        $expF = "is not a valid IP Address.";
        $this->assertContains($exp4, $body4);
        $this->assertContains($exp6, $body6);
        $this->assertContains($expF, $bodyF);
    }
}
