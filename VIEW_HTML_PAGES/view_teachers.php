<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Teachers | MyAttendance</title>
  <link rel="stylesheet" href="../CSS/Views/teachers.css">
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
    <h1>Teachers List</h1>
  </header>

  <section class="table-container">
    <table>
      <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
        </tr>
      </thead>

      <tbody>
        <?php
        include('../CONTROLLER_PHP/connectionToDb.php');

        $sql = "SELECT name, email FROM teachers";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                  <td data-label='Name'>{$row['name']}</td>
                  <td data-label='Email'>{$row['email']}</td>
                </tr>";
          }
        } else {
          echo "<tr>
                <td colspan='2' style='text-align:center;'>No teachers found</td>
              </tr>";
        }

        mysqli_close($conn);
        ?>
      </tbody>
    </table>
  </section>

</body>

</html>