<?php

class MiniMVC_Controller_Front_Action extends MiniMVC_Controller_Front_Abstract {
    protected $view_data;

    public function dispatch() {
        $request = $this->getRequest();
        $actionMethodName = $this->getActionMethodName($request->getActionName());
        $this->$actionMethodName();
        return $this->view_data;
    }

    public function getActionMethodName($name) {
        return $this->getClassName($name).'Action';
    }
}

?>
