<?php

class Tweets {

  public function getiTweetsByUser($userid) {
    $db = Database::getInstance();

    //get all twitter users from database
    $sql = "select id, tweet_id_str, text from tweet where twitter_user_id={$userid}";
    return $db->query($sql);
  }
}

?>

