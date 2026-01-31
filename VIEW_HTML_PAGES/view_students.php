<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Students | MyAttendance</title>
  <link rel="stylesheet" href="../CSS/Views/students.css">
</head>

<body>
  <?php
  session_start();
  if ($_SESSION['role'] !== 'admin') {
    header("Location: login.php");
  }
  ?>
  <header class="page-header">
    <h1>Students List</h1>
  </header>

  <section class="table-container">
    <table>
      <thead>
        <tr>
          <th>Name</th>
          <th>Roll No</th>
          <th>Division</th>
          <th>Semester</th>
        </tr>
      </thead>

      <tbody>
      <tbody>
        <?php
        include('../CONTROLLER_PHP/connectionToDb.php');

        $sql = "SELECT name, roll_no, division, semester FROM students order BY semester, division";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
            <td data-label='Name'>{$row['name']}</td>
            <td data-label='Roll No'>{$row['roll_no']}</td>
            <td data-label='Division'>{$row['division']}</td>
            <td data-label='Semester'>{$row['semester']}</td>
          </tr>";
          }
        } else {
          echo "<tr>
          <td colspan='4' style='text-align:center;'>No students found</td>
        </tr>";
        }

        mysqli_close($conn);
        ?>
      </tbody>
      </tbody>
    </table>
  </section>

</body>

</html>