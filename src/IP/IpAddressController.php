<?php

namespace Anax\ip;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Jodn14\Models\Validator;

/**
 * Style chooser controller loads available stylesheets from a directory and
 * lets the user choose the stylesheet to use.
 */
class IpAddressController implements ContainerInjectableInterface
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
     * Display index with input form
     *
     * @return object
     */
    public function indexAction() : object
    {
        $title = "IP Validator";

        $page = $this->di->get("page");

        $page->add("anax/ip/index");

        return $page->render([
            "title" => $title,
        ]);
    }

    /**
     * Display json with input form
     *
     * @return object
     */
    public function jsonAction() : object
    {
        $title = "JSON IP Validator";

        $page = $this->di->get("page");

        $page->add("anax/ip/json");

        return $page->render([
            "title" => $title,
        ]);
    }



    /**
     * POST to see if input is a valid ipv4/ipv6 address
     *
     * @return object
     */
    public function validateActionPost() : object
    {
        $title = "IP Validator";
        //$response = $this->di->get("response");
        $request = $this->di->get("request");
        $page = $this->di->get("page");
        $key = $request->getPost("ip_address");


        $data = $this->validator->validateIp($key);

        $page->add("anax/ip/validate", $data);

        return $page->render([
            "title" => $title,
        ]);
    }
}
