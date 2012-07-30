<?php

class MiniMVC_Controller_Front extends MiniMVC_Controller_Front_Abstract {
    protected $router;
    protected $smarty_template;

    public function __construct() {
        $this->router = new MiniMVC_Controller_Router();
    }

    public function dispatch() {
        $data = $this->router->dispatch();
        $this->renderView($data);
        $this->getResponse()->sendResponse();
        return $this;
    }

    public function setSmartyTemplate($template) {
      $this->smarty_template = $template;
    }

    public function getSmartyTemplate() {
      return $this->smarty_template;
    }

    protected function renderView($data=null) {
      $action = $this->getRequest()->getActionName();
      $controller = str_replace('_', DS, $this->getRequest()->getControllerName());
      $fullpath = APP_ROOT . DS . 'app' . DS . 'views' . DS . $controller . DS . $action;
      if ($this->checkFileExisted($fullpath . '.tpl')) {
        $fullpath .= '.tpl';
      } else if ($this->checkFileExisted($fullpath . '.html')) {
        $fullpath .= '.html';
      } else {
        return;
      }

      if ($this->getSmartyTemplate()) {
        $template = $this->getSmartyTemplate();
        $template->setData($data);
        $body = $template->display($fullpath);
        $this->getResponse()->setBody($body);
      } else {
        //todo: render html without smarty template
      }  
    }

    public function checkFileExisted($fileName) {
        if ($fileName && is_readable($fileName) && false===strpos($fileName, '//')) {
            return true;
        }
        return false;
    }

}


?>
