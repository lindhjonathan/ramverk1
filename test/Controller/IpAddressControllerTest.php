<?php

namespace Anax\ip;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the IpAddressController.
 */
class IpAddressControllerTest extends TestCase
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
        $this->controller = new IpAddressController();
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

        $exp = "IP Validator";
        $body = $res->getBody();
        $this->assertContains($exp, $body);
    }

    /**
     * Test the route "validate" with POST.
     */
    public function testvalidateActionPost()
    {
        $request = $this->di->get("request");
        $request->setPost("ip_address", "255.255.255.255");
        $res4 = $this->controller->validateActionPost();

        $request = $this->di->get("request");
        $request->setPost("ip_address", "2001:6b0:2a:c280:487c:27f8:34d6:1435");
        $res6 = $this->controller->validateActionPost();

        $request = $this->di->get("request");
        $request->setPost("ip_address", "255.255.255.252627");
        $resF = $this->controller->validateActionPost();

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
