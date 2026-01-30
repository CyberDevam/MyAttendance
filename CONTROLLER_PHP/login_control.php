<?php
session_start();
require 'connectionToDb.php';

if (empty($_POST['email']) || empty($_POST['password'])) {
    header("Location: ../VIEW_HTML_PAGES/login.php?error=empty");
    exit();
}

$email = $_POST['email'];
$password = $_POST['password'];
echo "Email: $email, Password: $password";
/* ---------- ADMIN ---------- */
$stmt = $conn->prepare("SELECT admin_id, password FROM admin WHERE username = ? LIMIT 1");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    if ($password === $row['password']) {
        session_regenerate_id(true);
        $_SESSION['logged_in'] = true;
        $_SESSION['user_id'] = $row['admin_id'];
        $_SESSION['role'] = 'admin';
        header("Location: ../VIEW_HTML_PAGES/admin_dashboard.php");
        exit();
    }
}

/* ---------- TEACHER ---------- */
$stmt = $conn->prepare("SELECT teacher_id, name, password FROM teachers WHERE email = ? LIMIT 1");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    if ($password === $row['password']) {
        session_regenerate_id(true);
        $_SESSION['logged_in'] = true;
        $_SESSION['user_id'] = $row['teacher_id'];
        $_SESSION['role'] = 'teacher';
        $_SESSION['name'] = $row['name'];
        header("Location: ../VIEW_HTML_PAGES/teacher_dashboard.php");
        exit();
    }
}

/* ---------- STUDENT ---------- */
$stmt = $conn->prepare("SELECT student_id, name, password FROM students WHERE email = ? LIMIT 1");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    if ($password === $row['password']) {
        session_regenerate_id(true);
        $_SESSION['logged_in'] = true;
        $_SESSION['user_id'] = $row['student_id'];
        $_SESSION['role'] = 'student';
        $_SESSION['name'] = $row['name'];
        header("Location: ../VIEW_HTML_PAGES/student_dashboard.php");
        exit();
    }
}

/* ---------- FAILED LOGIN ---------- */
header("Location: ../VIEW_HTML_PAGES/login.php?error=invalid");
exit();
?>