<?php

namespace Anax\Geo;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\Models\Validator;
use Anax\Models\Locator;

/**
 * Style chooser controller loads available stylesheets from a directory and
 * lets the user choose the stylesheet to use.
 */
class GeoLocationController implements ContainerInjectableInterface
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
     * Display index with input form
     *
     * @return object
     */
    public function indexAction() : object
    {
        $title = "IP Locator";
        $request = $this->di->get("request");

        $data = [
            "userIp" => $request->getServer("REMOTE_ADDR"),
        ];

        $page = $this->di->get("page");
        $page->add("anax/geo/index", $data);

        return $page->render([
            "title" => $title,
        ]);
    }

    /**
     * Display index with json input form
     *
     * @return object
     */
    public function jsonAction() : object
    {
        $title = "JSON IP Locator";
        $request = $this->di->get("request");

        $data = [
            "userIp" => $request->getServer("REMOTE_ADDR"),
        ];

        $page = $this->di->get("page");
        $page->add("anax/geo/json", $data);

        return $page->render([
            "title" => $title,
        ]);
    }



    /**
     * POST form processing, get ip and lookup location
     *
     * @return object
     */
    public function locatorActionPost() : object
    {
        $title = "IP Locator";
        $request = $this->di->get("request");
        $page = $this->di->get("page");
        $ipAddress = $request->getPost("ip_address");

        $valid = $this->validator->validateIp($ipAddress);
        $location = $this->locator->getLocation($ipAddress);

        $data = array_merge($valid, $location);

        $page->add("anax/geo/locator", $data);

        return $page->render([
            "title" => $title,
        ]);
    }
}
