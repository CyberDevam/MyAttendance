<?php
$host = "localhost";
$username = "root";
$password = "@Dld1809";
$dbname = "attendance_system";

$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
} else {
  // echo "Connection successful";
}
?>