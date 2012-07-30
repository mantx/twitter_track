<?php
require_once('config/config.php');
MiniMVC_Model_Application::getInstance()->getFrontController()->setSmartyTemplate(new Smarty_Template());
MiniMVC_Model_Application::getInstance()->run();
?>
