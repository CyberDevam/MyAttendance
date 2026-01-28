<?php
include('../CONTROLLER_PHP/connectionToDb.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>MyAttendance | Teacher Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../CSS/teacher_dashboard.css">
</head>

<body>

  <div class="navbar">
    <h2>Teacher Dashboard</h2>
  </div>

  <div class="container">

    <!-- ================= FILTERS ================= -->
    <form method="POST">

      <div class="filters">

        <!-- Subject -->
        <select name="subject_id" required>
          <option value="">Select Subject</option>
          <?php
          session_start();
          if ($_SESSION['role'] !== 'teacher') {
            header("Location: ./login.php");
          }
          $selectedSubject = $_POST['subject_id'] ?? '';
          $res = mysqli_query($conn, "SELECT subject_id, subject_name FROM subjects");
          while ($row = mysqli_fetch_assoc($res)) {
            $selected = ($row['subject_id'] == $selectedSubject) ? 'selected' : '';
            echo "<option value='{$row['subject_id']}' $selected>
                    {$row['subject_name']}
                  </option>";
          }
          ?>
        </select>

        <!-- Semester -->
        <select name="semester" required>
          <option value="">Semester</option>
          <?php
          $selectedSemester = $_POST['semester'] ?? '';
          $res = mysqli_query($conn, "SELECT DISTINCT semester FROM students ORDER BY semester ASC");
          while ($row = mysqli_fetch_assoc($res)) {
            $selected = ($row['semester'] == $selectedSemester) ? 'selected' : '';
            echo "<option value='{$row['semester']}' $selected>
                    {$row['semester']}
                  </option>";
          }
          ?>
        </select>

        <!-- Division -->
        <select name="division" required>
          <option value="">Division</option>
          <?php
          $selectedDivision = $_POST['division'] ?? '';
          $res = mysqli_query($conn, "SELECT DISTINCT division FROM students");
          while ($row = mysqli_fetch_assoc($res)) {
            $selected = ($row['division'] == $selectedDivision) ? 'selected' : '';
            echo "<option value='{$row['division']}' $selected>
                    {$row['division']}
                  </option>";
          }
          ?>
        </select>

        <!-- Date -->
        <input type="date" name="date" value="<?= $_POST['date'] ?? '' ?>" required>

        <button type="submit" name="fetch">
          <?= isset($_POST['fetch']) ? 'Refresh Students' : 'Fetch Students' ?>
        </button>

      </div>
    </form>

    <!-- ================= STUDENT TABLE ================= -->
    <?php
    if (isset($_POST['fetch'])) {

      $subject_id = $_POST['subject_id'];
      $semester   = $_POST['semester'];
      $division   = $_POST['division'];
      $date       = $_POST['date'];

      $sql = "SELECT student_id, name, roll_no 
              FROM students
              WHERE semester='$semester' AND division='$division' 
              ORDER BY roll_no ASC";

      $students = mysqli_query($conn, $sql);

      if (mysqli_num_rows($students) > 0) {
    ?>

        <form method="POST" action="../CONTROLLER_PHP/submit_attendance.php">

          <!-- Hidden Fields -->
          <input type="hidden" name="subject_id" value="<?= $subject_id ?>">
          <input type="hidden" name="date" value="<?= $date ?>">

          <div class="table-wrapper">
            <table>
              <thead>
                <tr>
                  <th>Roll No</th>
                  <th>Name</th>
                  <th>✔</th>
                  <th>✖</th>
                </tr>
              </thead>

              <tbody>
                <?php while ($row = mysqli_fetch_assoc($students)) { ?>
                  <tr>
                    <td><?= htmlspecialchars($row['roll_no']) ?></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td>
                      <input type="radio" name="att[<?= $row['student_id'] ?>]" value="P" checked>
                    </td>
                    <td>
                      <input type="radio" name="att[<?= $row['student_id'] ?>]" value="A">
                    </td>
                  </tr>
                <?php } ?>
              </tbody>

            </table>
          </div>

          <button type="submit" id="submitBtn">Submit Attendance</button>

        </form>

    <?php
      } else {
        echo "<p>No students found for Semester <b>$semester</b> Division <b>$division</b>.</p>";
      }
    }
    ?>

  </div>

</body>

</html>