<?php

namespace Anax\IP;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

/**
 * Style chooser controller loads available stylesheets from a directory and
 * lets the user choose the stylesheet to use.
 */
class OwnJSONController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     * @var string $db a sample member variable that gets initialised
     */
    private $db = "not active";

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
    }



    /**
     * Display index resultset in JSON format
     *
     * @return array
     */
    public function indexAction() : array
    {
        $title = "JSON IP Validator";
        $json = [
            "message" => "JSON REST API working",
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
    public function validateActionGet($value) : array
    {
        $hostname = "undefined host";

        if (filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            $result = $value . " is a valid IPv6 Address.";
            $hostname = gethostbyaddr($value);
        } else if (filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            $result = $value . " is a valid IPv4 Address.";
            $hostname = gethostbyaddr($value);
        } else {
            $result = $value . " is not a valid IP Address.";
        }
        // Deal with the action and return a response.
        $title = "JSON IP Validator";
        $json = [
            "title" => $title,
            "message" => $result,
            "hostname" => $hostname
        ];
        return [$json];
    }

    /**
     * POST to see if input is a valid ipv4/ipv6 address
     *
     * @return array    JSON Array
     */
    public function validateActionPost() : array
    {
        $title = "IP Validator";
        $request = $this->di->get("request");
        $key = $request->getPost("ip_address");
        $hostname = "undefined host";

        if (filter_var($key, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            $result = $key . " is a valid IPv6 Address.";
            $hostname = gethostbyaddr($key);
        } else if (filter_var($key, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            $result = $key . " is a valid IPv4 Address.";
            $hostname = gethostbyaddr($key);
        } else {
            $result = $key . " is not a valid IP Address.";
        }

        $json = [
            "title" => $title,
            "result" => $result,
            "hostname" => $hostname
        ];

        return [$json];
    }
}
