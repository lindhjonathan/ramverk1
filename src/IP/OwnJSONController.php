<?php

namespace Anax\IP;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Jodn14\Models\Validator;

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
    private $validator;

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
        $data = $this->validator->validateIp($value);
        // Deal with the action and return a response.
        $title = "JSON IP Validator";
        $info = [
            "title" => $title,
        ];
        $json = array_merge($info, $data);
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
        $data = $this->validator->validateIp($key);

        $info = [
            "title" => $title,
        ];

        $json = array_merge($info, $data);

        return [$json];
    }
}
