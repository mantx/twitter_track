<?php
require "define.inc";

/**
 * Set include path
 */
if (true) {
  $paths[] = APP_ROOT . DS . 'app' . DS . 'controllers';
  $paths[] = APP_ROOT . DS . 'app' . DS . 'models';
  $paths[] = APP_ROOT . DS . 'lib';
  $paths[] = APP_ROOT . DS . 'vendor';

  $appPath = implode(PS, $paths);
  set_include_path($appPath . PS . get_include_path());
}
require_once "Autoload.php";

class Config {
  private static $cfg;
  private $_values;

  public static function getInstance() {
    if (!Config::$cfg) {
      Config::$cfg = new Config();
    }
    return Config::$cfg;
  }

  private function __construct() {
    if (Config::$cfg) {
      throw new Exception("This is a singleton class, use GetInstance method instead");
    }
    $this->loadEnv();
  }

  public function isLiveMode() {
    return $this->mode == 'live';
  }

  public function isDevMode() {
    return $this->mode == 'development';
  }

  public function isTestMode() {
    return $this->mode == 'test';
  }

  private function _createVariable($env, $key, $default) {
    if (isset($env[$key])) {
      return $env[$key];
    } else {
      return $default;
    }
  }

  private function loadEnv() {
    $env = array();
    $db = array();
    require_once('environment.inc');
    require_once('database' . DS . $env['mode'] . '.inc');
    $this->_values = array_merge($env, $db);
    //error_reporting($this->_values['error_reporting']);
  }

  public function __get($key) {
    if (array_key_exists($key, $this->_values)) {
      return $this->_values[$key];
    } else {
      return null;
    }
  }

  public function getServerName() {
    $protocol = 'http';
    if (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443') {
      $protocol = 'https';
    }
    $host = $_SERVER['HTTP_HOST'];
    $baseUrl = $protocol . '://' . $host;
    if (substr($baseUrl, -1)=='/') {
      $baseUrl = substr($baseUrl, 0, strlen($baseUrl)-1);
    }
    return $baseUrl;
  }
  
}
?>

