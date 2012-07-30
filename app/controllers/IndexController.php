<?php

class IndexController extends MiniMVC_Controller_Front_Action {
  public function IndexAction() {
    $this->view_data = array();
    $twitter_users = new TwitterUsers();
    $this->view_data['users'] = $twitter_users->getAllUsers();
  }
}

?>
