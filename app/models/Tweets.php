<?php

class Tweets {

  public function getTweetsByUser($userid) {
    $db = Database::getInstance();

    //get all twitter users from database
    $sql = "select t.id, t.tweet_id_str, t.text from tweet t join twitter_user tu on t.twitter_user_id=tu.id where tu.userid='{$userid}'";
    return $db->query($sql);
  }
}

?>

