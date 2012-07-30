<?php
require_once("Smarty/libs/Smarty.class.php");

class Smarty_Template extends Smarty {

  public function __construct($data=null) {
    parent::__construct();

    $cfg = Config::getInstance();
    $this->setTemplateDir($cfg->dir_smarty . DS . 'templates');
    $this->setCompileDir($cfg->dir_smarty . DS . 'templates_c');
    //$this->setConfigDir($cfg->dir_smarty . DS . 'configs');
    $this->setCacheDir($cfg->dir_smarty . DS . 'cache');

    $this->setData($data);
  }

  public function escapeHtmlEntities($text) {
    return htmlspecialchars($text, ENT_QUOTES, $this->charset);
  }

  public function escapeJSLiteral($text) {
    return preg_replace('/[\\x00-\\x1f]/e', 'sprintf("\\x%02x", ord("$0"))', addcslashes($text, "\b\f\n\r\t\v'\"\\\x7f"));
  }

  public function fetch($skin) {
    $this->assign("this_file", $skin);
    $this->assign("this_dir", dirname($skin));
    return parent::fetch($skin);
  }

  public function display($skin) {
    print $this->fetch($skin);
  }

  public function setData($data) {
    $this->assign($data);
  }
}
?>
