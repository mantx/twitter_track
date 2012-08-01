<?php

class IndexController extends MiniMVC_Controller_Front_Action {
  public function IndexAction() {
    $this->view_data = array();
    $twitter_users = new TwitterUsers();
    $this->view_data['users'] = $twitter_users->getAllUsers();
    
    $user = $this->getRequest()->getParam('user', $this->view_data['users'][0]['userid']);
    $tweets = new Tweets();
    $this->view_data['tweet'] = array('user'=>$user,'tweets'=>$tweets->getTweetsByUser($user));
  }
}

?>
