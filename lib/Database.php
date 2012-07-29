<?php
/*
 * Database Utility
 * Design Pattern: Singleton
*/
class Database {
  private static $_db;
  private $conn;
  private $_inTransaction;

  public function __construct() {
    if (Database::$_db) {
      throw new Exception("This is a singleton class, use GetInstance method instead");
    }
    
    $cfg = Config::getInstance();
    $conn = mysql_connect($cfg->host, $cfg->username, $cfg->password);
    if (!$conn) {
      throw new Exception('Could not connect: ' . mysql_error());
    }
    mysql_select_db($cfg->dbname, $conn);   
  }

  public static function getInstance() {
    if (Database::$_db == null) {
      Database::$_db = new Database();
    }
    return Database::$_db;
  }

  public function __destruct() {
  }

  public function beginTransaction() {
    $this->_inTransaction = $this->execute("begin transaction");
    return $this->_inTransaction;
  }

  public function commit() {
    $this->_inTransaction = false;
    return $this->execute("commit");
  }

  public function rollBack() {
    if ($this->_inTransaction) {
      $this->_inTransaction = false;
      return $this->execute("rollback");
    } else {
      return true;
    }
  }

  public function isInTransaction() {
    return $this->_inTransaction;
  }

  public function query($sql, $execute=false) {
    $rowset = array();
    
    $time = microtime();

    // execute a query
    $result = mysql_query($sql);
    
    // check slowness query
    $time2 = microtime();
    $interval = ($time2 - $time) * 1000;
    if ($interval > 50) {
      print("SLOW: " . $interval . " msec: " . $sql);
    }
    
    //check if there is an error
    if (!$result) {
      throw new Exception('Invalid query: ' . mysql_error());
    } else if ($execute) {
      return true;
    }
    
    while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
      $rowset[] = $row;
    }
    
    mysql_free_result($result);    

    return $rowset;
  }
  
  public function execute($sql) {
    return $this->query($sql, true);
  }
}

