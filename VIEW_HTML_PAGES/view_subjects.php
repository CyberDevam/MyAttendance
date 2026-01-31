<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Subjects | MyAttendance</title>
  <link rel="stylesheet" href="../CSS/Views/subjects.css">
</head>

<body>

  <?php
  session_start();
  if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
  }
  ?>

  <header class="page-header">
    <h1>Subjects List</h1>
  </header>

  <section class="table-container">
    <table>
      <thead>
        <tr>
          <th>Subject Name</th>
          <th>Semester</th>
          <th>Assigned Teacher</th>
        </tr>
      </thead>

      <tbody>
        <?php
        include('../CONTROLLER_PHP/connectionToDb.php');

        $sql = "
        SELECT 
          s.subject_name,
          s.semester,
          t.name AS teacher_name
        FROM subjects s
        LEFT JOIN teachers t ON s.teacher_id = t.teacher_id
      ";

        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {

            $teacher = $row['teacher_name'] ?? 'Not Assigned';

            echo "<tr>
                  <td data-label='Subject Name'>{$row['subject_name']}</td>
                  <td data-label='Semester'>{$row['semester']}</td>
                  <td data-label='Assigned Teacher'>{$teacher}</td>
                </tr>";
          }
        } else {
          echo "<tr>
                <td colspan='3' style='text-align:center;'>No subjects found</td>
              </tr>";
        }

        mysqli_close($conn);
        ?>
      </tbody>
    </table>
  </section>

</body>

</html>