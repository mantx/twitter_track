<?php
require "../config/config.php";
require "class.twitter.php";

$tt = new twitter();
//$tt->username = false;
//$tt->password = false;
//$tt->type = "xml";
//$tt->debug = true;
$json = $tt->userTimeline("lemaistre", false, false, '225158705291866112');

foreach ($json as $item_twitter) {
  echo $item_twitter->id_str, ": ", $item_twitter->text, "\n";
}


?>
