<?php

namespace Anax\Geo;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\Models\Validator;
use Anax\Models\Locator;

/**
 * Json Locator Controller. Validates and gets location data from third part api(ipstack)
 * returns response in json format to blank page
 */
class OwnJSONLocationController implements ContainerInjectableInterface
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
        $title = "JSON IP Locator";
        $json = [
            "result" => "JSON REST API working",
            "title" => $title
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
    public function locateActionGet($value) : array
    {
        $valid = $this->validator->validateIp($value);
        $location = $this->locator->getLocation($value);

        $json = array_merge($valid, $location);
        $title = "JSON IP Validator";
        return [$json];
    }

    /**
     * POST to see if input is a valid ipv4/ipv6 address
     *
     * @return array    JSON Array
     */
    public function locateActionPost() : array
    {
        $title = "IP Validator";
        $request = $this->di->get("request");
        $ip = $request->getPost("ip_address");

        $valid = $this->validator->validateIp($ip);
        $location = $this->locator->getLocation($ip);

        $json = array_merge($valid, $location);

        return [$json];
    }
}
