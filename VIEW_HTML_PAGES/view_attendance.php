<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MyAttendence | View Attendance</title>
  <link rel="stylesheet" href="../CSS/Views/attendance.css">
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
    <h1>Attendance Records</h1>
  </header>

  <section class="table-container">
    <table>
      <thead>
        <tr>
          <th>Student Name</th>
          <th>Roll No</th>
          <th>Subject</th>
          <th>Date</th>
          <th>Status</th>
        </tr>
      </thead>

      <tbody>
        <?php
        include('../CONTROLLER_PHP/connectionToDb.php');

        $sql = "
        SELECT 
          st.name AS student_name,
          st.roll_no,
          sub.subject_name,
          a.date,
          a.status
        FROM attendance a
        INNER JOIN students st ON a.student_id = st.student_id
        INNER JOIN subjects sub ON a.subject_id = sub.subject_id
        ORDER BY a.date DESC
      ";

        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {

            $statusText = ($row['status'] === 'P') ? 'Present' : 'Absent';
            $statusClass = ($row['status'] === 'P') ? 'present' : 'absent';

            echo "<tr>
                  <td data-label='Student'>{$row['student_name']}</td>
                  <td data-label='Roll No'>{$row['roll_no']}</td>
                  <td data-label='Subject'>{$row['subject_name']}</td>
                  <td data-label='Date'>{$row['date']}</td>
                  <td data-label='Status' class='{$statusClass}'>{$statusText}</td>
                </tr>";
          }
        } else {
          echo "<tr>
                <td colspan='5' style='text-align:center;'>No attendance records found</td>
              </tr>";
        }

        mysqli_close($conn);
        ?>
      </tbody>
    </table>
  </section>

</body>

</html>