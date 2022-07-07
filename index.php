<?php
$con = mysqli_connect("localhost", "root", "root", "social");

if(mysqli_connect_errno()) {
  echo "Failed to connect: " . mysqli_connect_errno();
}

$query = mysqli_query($con, "INSERT INTO test VALUES(NULL, 'Optimus Prime')");

?>
<!DOCTYPE html>
<html>
<head>
  <title>Swirlfeed</title>
</head>
<body>
Hello D!!!!
</body>
</html>
