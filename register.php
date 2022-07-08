<?php
session_start();
$con = mysqli_connect("localhost", "root", "root", "social");

if(mysqli_connect_errno()) {
  echo "Failed to connect: " . mysqli_connect_errno();
}

//Declaring variables to prevent errors
$fname = "";
$lname = "";
$em = "";
$em2 = "";
$password = "";
$password2 = "";
$date = "";
$error_array = array();

if(isset($_POST['register_button'])) {
  //Registration form values

  //First name
  $fname = strip_tags($_POST['reg_fname']); //Remove html tags
  $fname = str_replace(' ', '', $fname); //Remove spaces
  $fname = ucfirst(strtolower($fname)); //Uppercase first letter
  $_SESSION['reg_fname'] = $fname;

  //Last name
  $lname = strip_tags($_POST['reg_lname']); //Remove html tags
  $lname = str_replace(' ', '', $lname); //Remove spaces
  $lname = ucfirst(strtolower($lname)); //Uppercase first letter
  $_SESSION['reg_lname'] = $fname;

  //Email
  $em = strip_tags($_POST['reg_email']); //Remove html tags
  $em = str_replace(' ', '', $em); //Remove spaces
  $em = ucfirst(strtolower($em)); //Uppercase first letter
  $_SESSION['reg_email'] = $em;

  //Email2
  $em2 = strip_tags($_POST['reg_email2']); //Remove html tags
  $em2 = str_replace(' ', '', $em2); //Remove spaces
  $em2 = ucfirst(strtolower($em2)); //Uppercase first letter
  $_SESSION['reg_email2'] = $em2;

  //Password
  $password = strip_tags($_POST['reg_password']); //Remove html tags
  $password2 = strip_tags($_POST['reg_password2']); //Remove html tags

  //Date
  $date = date("Y-m-d");

  if($em == $em2) {
    //Check if email is in valid format
    if(filter_var($em, FILTER_VALIDATE_EMAIL)) {
      $em = filter_var($em, FILTER_VALIDATE_EMAIL);

      //Check if email already exists
      $e_check = mysqli_query($con, "SELECT email FROM users WHERE email='$em'");

      //Count the number of rows returned
      $num_rows = mysqli_num_rows($e_check);

      if($num_rows > 0) {
        array_push($error_array, 'Email already in use'); 
      }
    } else {
      array_push($error_array, "Invalid email format<br />");
    }
  } else {
    array_push($error_array, "Emails don't match<br />");
  }

  if(strlen($fname) > 25 || strlen($fname) < 2) {
    array_push($error_array, "Your first name must be between 2 and 25 characters");
  }

  if(strlen($lname) > 25 || strlen($lname) < 2) {
    array_push($error_array, "Your last name must be between 2 and 25 characters");
  }

  if($password != $password2) {
    array_push($error_array, "Your passwords do not match");
  } else {
    if(preg_match('/[^A-Za-z0-9]/', $password)) {
      array_push($error_array, "Your password can only contain english characters or numbers");
    }
  }
  if(strlen($password) > 30 || strlen($password) < 5) {
    array_push($error_array, "Your password must be between 5 and 30 characters");
  }
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta>
  <title>Welcome to Swirlfeed!</title>
</head>
<body>
  <form action="register.php" method="POST">
    <input type="text" name="reg_fname" placeholder="First Name" value="<?php if(isset($_SESSION['reg_fname'])) {
      echo $_SESSION['reg_fname'];
    } ?>" required>
    <br />
    <input type="text" name="reg_lname" placeholder="Last Name" value="<?php if(isset($_SESSION['reg_lname'])) {
      echo $_SESSION['reg_fname'];
    } ?>" required>
    <br />
    <input type="email" name="reg_email" placeholder="Email" value="<?php if(isset($_SESSION['reg_email'])) {
      echo $_SESSION['reg_email'];
    } ?>" required>
    <br />
    <input type="email" name="reg_email2" placeholder="Confirm Email" value="<?php if(isset($_SESSION['reg_email2'])) {
      echo $_SESSION['reg_email2'];
    } ?>" required>
    <br />
    <input type="password" name="reg_password" placeholder="Password" required>
    <br />
    <input type="password" name="reg_password2" placeholder="Confirm Password" required>
    <br />
    <input type="submit" name="register_button" value="Register">
  </form>
</body>
</html>
