<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MyAttendence | View Details</title>
</head>

<body>
  <?php
  session_start();
  if (!isset($_SESSION['logged_in'])) {
    header('Location: login.php');
    exit;
  }
  ?>

</body>

</html>