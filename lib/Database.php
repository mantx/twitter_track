<?php
/*
 * Database Utility
 * Design Pattern: Singleton
*/
class Database {
  // class Database extends Zend_Db_Adapter_Pdo_Mysql {
  private static $_db;
  private $conn;
  private $_inTransaction;

  public function __construct($user, $password = '', $host='localhost') {
    if (Database::$_db) {
      throw new Exception("use GetInstance method");
    }
    
    $conn = mysql_connect("localhost","peter","abc123");
    if (!$conn) {
      throw new Exception('Could not connect: ' . mysql_error());
    }
    mysql_select_db("tiwtter_track", $conn);   
  }

  public static function getInstance() {
    if (Database::$_db == null) {
      //$env = Environment::getInstance();
      Database::$_db = new Database("tiwtter_track", "tiwtter_track");
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
    return execute($sql, true)
  }
}

