<?php

class Post {
  private $con;
  private $user_obj;

  public function __construct($con, $user) {
    $this->con = $con;
    $this->user_obj = new User($con, $user);
  }

  public function submitPost($body, $usre_to) {
    $body = strip_tags($body); //Removes html tags
    $body = mysqli_real_escape_string($this->con, $body);
    $check_empty = preg_replace('/\s+/', '', $body); //Deletes all spaces

    if($check_empty != "") {
      //Current data and time
      $date_added = date("Y-m-d H:i:s");

      //Get username
      $added_by = $this->user_obj->getUsername();

      //If user is not on own profile, user_to is 'none'
      if($user_to == $added_by) {
        $user_to = "none";
      }
    }
  }
}

?>
