<?php

class MiniMVC_Model_Application {
    /**
     * Request object
     *
     * @var Zend_Controller_Request_Http
     */
    protected $_request;

    /**
     * Response object
     *
     * @var Zend_Controller_Response_Http
     */
    protected $_response;

    /**
     * Application front controller
     *
     * @var MiniMVC_Controller_Varien_Front
     */
    protected $_frontController;


    protected static $_app;

    public static function getInstance() {
      if (!MiniMVC_Model_Application::$_app) {
        MiniMVC_Model_Application::$_app = new MiniMVC_Model_Application();
      }
      return MiniMVC_Model_Application::$_app;
    }

    /**
     * Retrieve request object
     *
     * @return MiniMVC_Controller_Request_Http
     */
    public function getRequest()
    {
        if (empty($this->_request)) {
            $this->_request = new MiniMVC_Controller_Request_Http();
        }
        return $this->_request;
    }

    /**
     * Request setter
     *
     * @param MiniMVC_Controller_Request_Http $request
     * @return MiniMVC_Model_App
     */
    public function setRequest(MiniMVC_Controller_Request_Http $request)
    {
        $this->_request = $request;
        return $this;
    }

    /**
     * Retrieve response object
     *
     * @return Zend_Controller_Response_Http
     */
    public function getResponse()
    {
        if (empty($this->_response)) {
            $this->_response = new MiniMVC_Controller_Response_Http();
            $this->_response->setHeader("Content-Type", "text/html; charset=UTF-8");
        }
        return $this->_response;
    }

    /**
     * Response setter
     *
     * @param MiniMVC_Controller_Response_Http $response
     * @return MiniMVC_Model_App
     */
    public function setResponse(MiniMVC_Controller_Response_Http $response)
    {
        $this->_response = $response;
        return $this;
    }

    /**
     * Retrieve front controller object
     *
     * @return MiniMVC_Controller_Router
     */
    public function getFrontController()
    {
        if (!$this->_frontController) {
            $this->_initFrontController();
        }

        return $this->_frontController;
    }

    /**
     * Init request object
     *
     * @return MiniMVC_Model_App
     */
    protected function _initRequest()
    {
        $this->getRequest()->setPathInfo();
        return $this;
    }

    /**
     * Initialize application front controller
     *
     * @return MiniMVC_Model_App
     */
    protected function _initFrontController()
    {
        $this->_frontController = new MiniMVC_Controller_Front(); 
        return $this;
    }

    /**
     * Run application. Run process responsible for request processing and sending response.
     */
    public function run()
    {
        $this->getFrontController()->dispatch();
        return $this;
    }

}

?>
