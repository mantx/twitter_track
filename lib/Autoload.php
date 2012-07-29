<?php
  /**
   * simple autoload 
   */
  function __autoload($class_name)
  {
    $class_File = str_replace(' ', DS, ucwords(str_replace('_', ' ', $class_name))) . '.php';
    return include $class_File;
  }

?>
