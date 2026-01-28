<!-- CREATE TABLE teachers ( 
teacher_id INT AUTO_INCREMENT PRIMARY KEY, 
name VARCHAR(100) NOT NULL, 
email VARCHAR(100) UNIQUE NOT NULL, 
password VARCHAR(255) NOT NULL 
); -->
<?php
include('connectionToDb.php');

// Allow only POST requests
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../VIEW_HTML_PAGES/admin_add_student.php");
    exit();
}

// Get form data safely
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

// Validation
if (empty($name) || empty($email) || empty($password)) {
    header("Location: ../VIEW_HTML_PAGES/admin_add_student.php?error=empty");
    exit();
}

// Hash password (VERY IMPORTANT)
// $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Prepare SQL (NO teacher_id because AUTO_INCREMENT)
$sql = "INSERT INTO teachers (name, email, password) VALUES (?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    die("Prepare failed: " . mysqli_error($conn));
}

// Bind parameters
mysqli_stmt_bind_param($stmt, "sss", $name, $email, $password);

// Execute
if (mysqli_stmt_execute($stmt)) {
    header("Location: ../VIEW_HTML_PAGES/admin_dashboard.php");
    exit();
} else {
    header("Location: ../VIEW_HTML_PAGES/admin_add_student.php?error=duplicate");
    exit();
}

// Close
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>