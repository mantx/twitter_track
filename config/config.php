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
  //$paths[] = APP_ROOT . DS . 'vendor' . DS . 'php-twitter';

  $appPath = implode(PS, $paths);
  set_include_path($appPath . PS . get_include_path());
}
require_once "Autoload.php";

class Config {
  private static $_config;
  private $_values;

  public static function getInstance() {
    if (!Config::$_config) {
      Config::$_config = new Config();
    }
    return Config::$_config;
  }

  private function __construct() {
    if (Config::$_config) {
      throw new Exception("");
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

  private function _loadEnv() {
    $env = array();
    require_once('environment.inc');
    require_once('database' . DS . $env->mode . '.inc');
    $this->_values = $env;
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

