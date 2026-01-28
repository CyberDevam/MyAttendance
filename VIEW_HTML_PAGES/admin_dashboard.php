<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MyAttendence | Admin Dashboard</title>
  <link rel="stylesheet" href="../CSS/admin_dashboard.css">
</head>

<body>
  <?php include('../COMPONENTS/Navbar.php');
  if ($_SESSION['role'] !== 'admin') {
    header("Location: ./login.php");
  }
  ?>
  <!-- <h1>Welcome to Admin Dashboard!</h1> -->
  <!-- Total Students -->
  <!-- Total Teachers -->
  <!-- Total Subjects -->
  <!-- Total Attendance Records -->
  <!-- ➕ Add Teacher -->
  <!-- 👁 View All Teachers -->
  <!-- ✏ Edit Teacher -->
  <!-- cannot Delete Teacher -->
  <!-- ➕ Add Student 👁 View All Students ✏ Edit Student ❌ Delete Student 🔍 Filter by Division & Semester -->
  <!-- ➕ Add Subject

👁 View Subjects

✏ Edit Subject

❌ Delete Subject

👨‍🏫 Assign Teacher to Subject -->
  <!-- 📅 Date-wise attendance

📘 Subject-wise attendance

👨‍🎓 Student-wise attendance

🚨 Defaulter list (<75%) -->


  <!-- Header -->
  <header class="header">
    <h1>Admin Dashboard</h1>
    <!-- <p>Attendance Management System</p> -->
  </header>

  <!-- Stats Section -->
  <section class="stats">
    <?php
    include('../CONTROLLER_PHP/connectionToDb.php');
    $sql = "select * from students";
    $result = mysqli_query($conn, $sql);
    $rows = $result->num_rows;
    echo "<div class='card'>Total Students<br><span>$rows</span></div>";
    $sql = "select * from teachers";
    $result = mysqli_query($conn, $sql);
    $rows = $result->num_rows;
    echo "<div class='card'>Total Teachers<br><span>$rows</span></div>";
    $sql = "select * from subjects";
    $result = mysqli_query($conn, $sql);
    $rows = $result->num_rows;
    echo "<div class='card'>Total Subjects<br><span>$rows</span></div>";
    $sql = "select * from attendance";
    $result = mysqli_query($conn, $sql);
    $rows = $result->num_rows;
    echo "<div class='card'>Attendance Records<br><span>$rows</span></div>";
    ?>

  </section>
  <section class="container">

    <div class="box">
      <h2>Manage Teachers</h2>
      <button>Add Teacher</button>
      <button>View Teachers</button>
      <button>Edit Teacher</button>
    </div>

    <div class="box">
      <h2>Manage Students</h2>
      <button>Add Student</button>
      <button>View Students</button>
      <button>Edit Student</button>
      <button>Delete Student</button>
      <button>Filter by Division & Semester</button>
    </div>

    <div class="box">
      <h2>Manage Subjects</h2>
      <button>Add Subject</button>
      <button>View Subjects</button>
      <button>Edit Subject</button>
      <button>Delete Subject</button>
      <button>Assign Teacher</button>
    </div>

    <div class="box">
      <h2>Attendance Reports</h2>
      <button>Date-wise Attendance</button>
      <button>Subject-wise Attendance</button>
      <button>Student-wise Attendance</button>
      <button>Defaulter List (&lt;75%)</button>
    </div>

  </section>

</body>

</html>