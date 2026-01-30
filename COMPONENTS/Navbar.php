<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../CSS/navbar.css">
  <title>Navbar</title>
</head>

<body>
  <nav class="navbar">
    <a style="text-decoration:none;cursor: pointer;" href="../VIEW_HTML_PAGES/home_page.php" class="headTitle">MyAttendance</a>
    <ul class="nav-links">
      <li><a href="../VIEW_HTML_PAGES/home_page.php" class="active">Home</a></li>
      <?php
      session_start();
      if (isset($_SESSION['role'])) {
        echo "<li><a href='../CONTROLLER_PHP/logout.php'>Logout</a></li>";
      }
      if(isset($_SESSION['role']) && $_SESSION['role'] === 'student') {
        echo "<li><a href='../VIEW_HTML_PAGES/student_dashboard.php'>Student Profile</a></li>";
      }
      ?>
    </ul>
  </nav>
</body>

</html>