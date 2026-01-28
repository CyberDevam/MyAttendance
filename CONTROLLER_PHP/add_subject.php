<!-- CREATE TABLE subjects (
    subject_id INT AUTO_INCREMENT PRIMARY KEY,
    subject_name VARCHAR(100) NOT NULL,
    semester INT NOT NULL,
    teacher_id INT,
    FOREIGN KEY (teacher_id) REFERENCES teachers(teacher_id)
        ON DELETE SET NULL
); -->

<?php
include('connectionToDb.php');

$subject_name = $_POST['subject_name'];
$semester = $_POST['semester'];
$teacher_id = $_POST['teacher_id'];
if(empty($subject_name) || empty($semester) || empty($teacher_id)) {
  die("Subject Name, Semester, and Teacher ID are required fields.");
  header("Location: ../VIEW_HTML_PAGES/admin_add_student.php");
  exit();
}
$stmt = $conn->prepare(
  "INSERT INTO subjects (subject_name, semester, teacher_id)
   VALUES (?, ?, ?)"
);

$stmt->bind_param("sii", $subject_name, $semester, $teacher_id);

$stmt->execute();
$stmt->close();
$conn->close();

header("Location: ../VIEW_HTML_PAGES/admin_dashboard.php");
exit();
?>