<?php
include('../CONTROLLER_PHP/connectionToDb.php');

$subject_id = $_POST['subject_id'];
$date       = $_POST['date'];
$attendance = $_POST['att'];

foreach ($attendance as $student_id => $status) {

  $sql = "INSERT INTO attendance (student_id, subject_id, date, status)
          VALUES ('$student_id', '$subject_id', '$date', '$status')
          ON DUPLICATE KEY UPDATE status='$status'";

  mysqli_query($conn, $sql);
}

header("Location: ../VIEW_HTML_PAGES/teacher_dashboard.php");
?>


