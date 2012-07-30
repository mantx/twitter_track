<?php

class MiniMVC_Controller_Router extends MiniMVC_Controller_Front_Abstract {
    public function dispatch()
    {
        $request = $this->getRequest();
        //$this->fetchDefault();

        //$front = $this->getFront();
        $path = trim($request->getPathInfo(), '/');

        if ($path) {
            $p = explode('/', $path);
        } else {
            $p = explode('/', 'index/index');//$this->_getDefaultPath());
        }


        // get controller name
        if ($request->getControllerName()) {
            $controller = $request->getControllerName();
        } else {
            if (!empty($p[0])) {
                    $controller = $p[0];
            } else {
                $controller = 'index';//$front->getDefault('controller');
            }
        }

        // get action name
        if ($request->getActionName()) {
            $action = $request->getActionName();
        } else {
            $action = !empty($p[1]) ? $p[1] : 'index';//$front->getDefault('action');
        }

        $controllerClassName = $this->getControllerClassName($controller);
        // instantiate controller class
        $controllerInstance = new $controllerClassName();

        // set values only after all the checks are done
        $request->setControllerName($controller);
        $request->setActionName($action);

        // set parameters from pathinfo
        for ($i = 2, $l = sizeof($p); $i < $l; $i += 2) {
            $request->setParam($p[$i], isset($p[$i+1]) ? urldecode($p[$i+1]) : '');
        }

        // dispatch action
        return $controllerInstance->dispatch();
    }

    public function getControllerClassName($name)
    {
        return $this->getClassName($name).'Controller';
    }
}

?>
