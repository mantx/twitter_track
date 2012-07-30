<?php
  /**
   * simple autoload 
   */
  function __autoload($class_name)
  {
    $class_File = str_replace(' ', DS, ucwords(str_replace('_', ' ', $class_name))) . '.php';
    return include $class_File;
  }

  class autoload {
    public static function load($class_name)
    {
      $class_File = str_replace(' ', DS, ucwords(str_replace('_', ' ', $class_name))) . '.php';
      $include_paths = explode(PATH_SEPARATOR, ini_get('include_path'));
      foreach ($include_paths as $path) {
        $include = $path . DIRECTORY_SEPARATOR . $class_File;
        if (is_file($include) && is_readable($include)) {
          return include $class_File;
        }
      }
    }
  }

  spl_autoload_register('autoload::load');

?>
