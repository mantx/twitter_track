<?php

class MiniMVC_Controller_Front extends MiniMVC_Controller_Front_Abstract {
    protected $router;

    public function __construct() {
        $this->router = new MiniMVC_Controller_Router();
    }

    public function dispatch() {
        $this->router->dispatch();
        $this->getResponse()->sendResponse();
        return $this;
    }


}


?>
