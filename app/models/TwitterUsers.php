<?php

class TwitterUsers {

  public function getAllUsers() {
    $db = Database::getInstance();

    //get all twitter users from database
    $sql = "select id, userid, username from twitter_user";
    return $db->query($sql);
  }
}

?>

