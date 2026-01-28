<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Profile</title>
</head>

<body>
  <?php
  session_start();
  if ($_SESSION['role'] !== 'student') {
    header("Location: ./login.php");
  }
  ?>
  <h1>Student Profile</h1>
</body>

</html>