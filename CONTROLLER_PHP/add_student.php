<!-- student_id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  roll_no VARCHAR(20) UNIQUE NOT NULL,
  division VARCHAR(10),
  semester INT,
  email VARCHAR(100) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL -->

<?php
include('connectionToDb.php');

// Allow only POST requests
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../VIEW_HTML_PAGES/admin_add_student.php");
    exit();
}
$name = $_POST['name'];
$roll_no = $_POST['roll_no'];
$division = $_POST['division'];
$semester = $_POST['semester'];
$email = $_POST['email'];
$password = $_POST['password'];
if (empty($name) || empty($roll_no) || empty($email) || empty($password)) {
  die("Name, Roll Number, Email, and Password are required fields.");
  header("Location: ../VIEW_HTML_PAGES/admin_add_student.php");
  exit();
}
$sql = "INSERT INTO students (name, roll_no, division, semester, email, password) VALUES ('$name', '$roll_no', '$division', '$semester', '$email', '$password')";
$result = mysqli_query($conn, $sql);

if ($result) {
  echo "Student added successfully";
  $name = $_POST['name'];
  $roll_no = null;
  $division = null;
  $semester = null;
  $email = null;
  $password = null;
  header("Location: ../VIEW_HTML_PAGES/admin_dashboard.php");

  exit();
} else {
  echo "Error: " . mysqli_error($conn);
}
mysqli_close($conn);
?>