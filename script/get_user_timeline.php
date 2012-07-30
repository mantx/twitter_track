<?php
require "../config/config.php";
require "class.twitter.php";

$tt = new twitter();
//$tt->userid = false;
//$tt->password = false;
//$tt->type = "xml";
//$tt->debug = true;

$db = Database::getInstance();

//get all twitter users from database
$sql = "select tu.id, tu.userid, max(t.tweet_id_str) as last_id from twitter_user tu left join tweet t on tu.id=t.twitter_user_id group by tu.userid order by tu.id";
$rs = $db->query($sql);
foreach ($rs as $row) {
  $id = $row['id'];
  $userid = $row['userid'];
  $last_tweet_id = $row['last_id']; 
  $json = $tt->userTimeline($userid, false, false, $last_tweet_id);

  foreach (parseData($json) as $tweet) {
    $sql = sprintf("insert into tweet(tweet_id_str, text, twitter_user_id) values('%s', '%s', {$id})", 
              mysql_real_escape_string($tweet['id']),
              mysql_real_escape_string($tweet['text']));
    $db->execute($sql);
  }
}


function parseData($json) {
  $data = array();
  foreach ($json as $tweet) {
    $data[] = array('id'=>$tweet->id_str, 'text'=>$tweet->text);
  }
  return array_reverse($data);
}


?>
