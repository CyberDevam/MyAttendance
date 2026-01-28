<?php
session_start();
include('connectionToDb.php');
$email = $_POST['email'];
$password = $_POST['password'];
if (empty($email) || empty($password)) {
  die("Email, Password are required fields.");
  header("Location: ../VIEW_HTML_PAGES/login.php");
  exit();
}
// find admin
$sql_admin = "SELECT * FROM admin
WHERE username = '$email' AND password = '$password'";
$result = mysqli_query($conn, $sql_admin);

if ($result->num_rows === 1) {
  $row = $result->fetch_assoc();
  $_SESSION['logged_in'] = true;
  $_SESSION['user_id'] = $row['admin_id'];
  $_SESSION['role'] = 'admin';
  header("Location: ../VIEW_HTML_PAGES/admin_dashboard.php");
  exit();
} else {
  header("Location: ../VIEW_HTML_PAGES/login.php");
  echo "Error: " . mysqli_error($conn);
}
// find teacher 
$sql_teacher = "SELECT * FROM teachers
WHERE email = '$email' AND password = '$password';";
$result = mysqli_query($conn, $sql_teacher);
if ($result->num_rows === 1) {
  $row = $result->fetch_assoc();
  $_SESSION['logged_in'] = true;
  $_SESSION['user_id'] = $row['teacher_id'];
  $_SESSION['role'] = 'teacher';
  $_SESSION['name'] = $row['name'];
  header("Location: ../VIEW_HTML_PAGES/teacher_dashboard.php");
  exit();
} else {
  header("Location: ../VIEW_HTML_PAGES/login.php");
  echo "Error: " . mysqli_error($conn);
}
// find student
$sql_student = "SELECT * FROM students
WHERE email = '$email' AND password = '$password';";
$result = mysqli_query($conn, $sql_student);
if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $_SESSION['logged_in'] = true;
  $_SESSION['user_id'] = $row['student_id'];
  $_SESSION['role'] = 'student';
  $_SESSION['name'] = $row['name'];
  header("Location: ../VIEW_HTML_PAGES/student_dashboard.php");
  exit();
} else {
  header("Location: ../VIEW_HTML_PAGES/login.php");
  echo "Error: " . mysqli_error($conn);
}
mysqli_close($conn);
?>
