<?php

namespace Jodn14\Models;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the IpAddressController.
 */
class ValidatorTest extends TestCase
{

    // Create the validator
    protected $validator;



    /**
     * Prepare before each test.
     */
    protected function setUp()
    {
        $this->validator = new Validator();
    }

    /**
     * Test the route "index".
     */
    public function testvalidateIP()
    {
        $res4 = $this->validator->validateIp("255.255.255.255");
        $res6 = $this->validator->validateIp("2001:6b0:2a:c280:487c:27f8:34d6:1435");
        $resF = $this->validator->validateIp("255.255.255.252627");

        $exp4 = "is a valid IPv4 Address.";
        $exp6 = "is a valid IPv6 Address.";
        $expF = "is not a valid IP Address.";
        $this->assertContains($exp4, $res4["result"]);
        $this->assertContains($exp6, $res6["result"]);
        $this->assertContains($expF, $resF["result"]);
    }
}
