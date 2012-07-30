<?php

abstract class MiniMVC_Controller_Front_Abstract {

    public function dispatch() {
    }

    /**
     * Retrieve request object
     *
     * @return MiniMVC_Controller_Request_Http
     */
    public function getRequest()
    {
        return MiniMVC_Model_Application::getInstance()->getRequest();
    }

    /**
     * Retrieve response object
     *
     * @return Zend_Controller_Response_Http
     */
    public function getResponse()
    {
        return MiniMVC_Model_Application::getInstance()->getResponse();
    }

    public function getClassName($name)
    {
        return str_replace(' ', '', ucwords(str_replace('_', ' ', $name)));
    }
}


?>
