<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard | MyAttendance</title>
  <link rel="stylesheet" href="../CSS/admin_dashboard.css">
</head>

<body>
  <?php include('../COMPONENTS/Navbar.php');
  if ($_SESSION['role'] !== 'admin') {
    header("Location: ./login.php");
  }
  ?>
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
    echo "<a href='view_students.php' class='card'>Total Students<br><span>$rows</span></a>";
    $sql = "select * from teachers";
    $result = mysqli_query($conn, $sql);
    $rows = $result->num_rows;
    echo "<a href='view_teachers.php' class='card'>Total Teachers<br><span>$rows</span></a>";
    $sql = "select * from subjects";
    $result = mysqli_query($conn, $sql);
    $rows = $result->num_rows;
    echo "<a href='view_subjects.php' class='card'>Total Subjects<br><span>$rows</span></a>";
    $sql = "select * from attendance";
    $result = mysqli_query($conn, $sql);
    $rows = $result->num_rows;
    echo "<a href='view_attendance.php' class='card'>Attendance Records<br><span>$rows</span></a>";
    ?>

  </section>
  <section class="container">

    <div class="box">
      <h2>Manage Teachers</h2>
      <a href="admin_add_student.php?type=teacher">Add Teacher</a>
      <button>Edit Teacher</button>
    </div>

    <div class="box">
      <h2>Manage Students</h2>
      <a href="admin_add_student.php?type=student">Add Student</a>
      <button>Edit Student</button>
      <!-- <button>Delete Student</button> // in same page as view students
      <button>Filter by Division & Semester</button> -->
    </div>

    <div class="box">
      <h2>Manage Subjects</h2>
      <a href="admin_add_student.php?type=subject">Add Subject</a>
      <button>Edit Subject</button>
      <!-- <button>Delete Subject</button> // in same page as view subjects
      <button>Assign Teacher</button> -->
    </div>

    <div class="box">
      <h2>Attendance Reports</h2>
      <a href="view_attendance.php?type=dwa">Date-wise Attendance</a>
      <a href="view_attendance.php?type=swa">Subject-wise Attendance</a>
      <a href="view_attendance.php?type=sda">Student-wise Attendance</a>
      <button href="view_attendance.php?type=dl">Defaulter List (&lt;75%)</button>
      <!-- <a href="view_attendance.php?type=dl">Defaulter List (&lt;75%)</a> -->
    </div>

  </section>

  <section class="container-mobile" id="mobilePanel"></section>
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const panel = document.getElementById("mobilePanel");

      panel.innerHTML = `
    <div class="mobile-box">
      <h2>Management Panel</h2>

      <select id="manageSelect">
        <option value="">-- Select Module --</option>
        <option value="teachers">Teachers</option>
        <option value="students">Students</option>
        <option value="subjects">Subjects</option>
        <option value="attendance">Attendance</option>
      </select>

      <div id="actionButtons" class="mobile-actions"></div>
    </div>
  `;

      document.getElementById("manageSelect").addEventListener("change", updateActions);
    });

    function updateActions() {
      const value = document.getElementById("manageSelect").value;
      const actions = document.getElementById("actionButtons");

      const map = {
        teachers: `
      <button>Add Teacher</button>
      <button>View Teachers</button>
      <button>Edit Teacher</button>
    `,
        students: `
      <button>Add Student</button>
      <button>View Students</button>
      <button>Edit Student</button>
      <button>Delete Student</button>
      <button>Filter by Division & Semester</button>
    `,
        subjects: `
      <button>Add Subject</button>
      <button>View Subjects</button>
      <button>Edit Subject</button>
      <button>Delete Subject</button>
      <button>Assign Teacher</button>
    `,
        attendance: `
      <button>Date-wise Attendance</button>
      <button>Subject-wise Attendance</button>
      <button>Student-wise Attendance</button>
      <button>Defaulter List (&lt;75%)</button>
    `
      };

      actions.innerHTML = map[value] || "";
    }
  </script>

</body>

</html>