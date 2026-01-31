<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Student Dashboard | MyAttendance</title>

  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Delius+Swash+Caps&display=swap" rel="stylesheet">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="../../CSS/student-dashboard.css">
  <link rel="stylesheet" href="../../CSS/navbar.css">
  <link rel="stylesheet" href="../../CSS/theme.css">
</head>

<body>

  <?php include('../COMPONENTS/Navbar.php');
  session_start();
  if ($_SESSION['role'] !== 'student') {
    header("Location: ./login.php");
  }
  ?>

  <div class="dashboard-container">
    <h1>Student Dashboard</h1>

    <div class="grid">

      <div class="card profile-card">
        <h3>Profile</h3>

        <div class="profile-grid">
          <div class="profile-column">
            <p class="profile-item"><strong>Name:</strong> John Doe</p>
            <p class="profile-item"><strong>Roll:</strong> 21CS045</p>
          </div>

          <div class="profile-column">
            <p class="profile-item"><strong>Semester:</strong> 5</p>
            <p class="profile-item"><strong>Division:</strong> A</p>
          </div>
        </div>
      </div>


      <div class="card center">
        <h3>Status</h3>
        <p class="success">Logged In</p>
        <p>Welcome back 📚</p>
      </div>

      <div class="card center">
        <h3>Overall Attendance</h3>
        <span class="big-text">85%</span>
      </div>

      <div class="card center">
        <h3>Present</h3>
        <span class="count green">120</span>
      </div>

      <div class="card center">
        <h3>Absent</h3>
        <span class="count red">20</span>
      </div>

      <div class="card">
        <h3>Progress</h3>
        <div class="progress-bar">
          <div class="progress-fill" style="width:85%">85%</div>
        </div>
      </div>

      <div class="card table-card">
        <h3>Subject-wise Attendance</h3>
        <div class="table-wrapper">
          <table>
            <tr>
              <th>Subject</th>
              <th>Total</th>
              <th>P</th>
              <th>A</th>
              <th>%</th>
            </tr>
            <tr>
              <td>Maths</td>
              <td>30</td>
              <td>28</td>
              <td>2</td>
              <td>93</td>
            </tr>
            <tr>
              <td>Physics</td>
              <td>30</td>
              <td>25</td>
              <td>5</td>
              <td>83</td>
            </tr>
            <tr>
              <td>Chemistry</td>
              <td>30</td>
              <td>24</td>
              <td>6</td>
              <td>80</td>
            </tr>
          </table>
        </div>
      </div>

      <div class="card chart-card">
        <h3>Monthly Attendance</h3>
        <canvas id="attendanceChart"></canvas>
      </div>

    </div>
  </div>

  <script>
    const ctx = document.getElementById('attendanceChart');

    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
        datasets: [{
          label: 'Attendance %',
          data: [85, 90, 78, 88, 92],
          backgroundColor: '#9CAB84',
          borderRadius: 6
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true,
            max: 100
          }
        }
      }
    });
  </script>

</body>

</html>



<div class="dashboard-container">
  <!-- Greet Message -->
  <!-- <h1>Welcome, Devam! 🙌🏻</h1> -->
  <!-- Profile info (Name, Roll Number, Division/Semester) -->

  <!-- Personal Touch Is Logged In -->

  <!-- Attendance Summary -->

  <!-- Total attendance percentage(85% overall attendance) -->

  <!-- Present / Absent counts (colored progress bar representing attendance %) -->

  <!-- Subject-Wise Attendance List in table format (Subject Total Classes Present Absent %Attendance) -->

  <!-- Breaking down attendance by subject helps students know where they are weak. -->

  <!-- Recent / Recent Dates Attendance -->


  <!-- Graphical Chart (Optional but Scoring) Main work -->


  <!-- 🔍 Filters / View Selectors (Optional) Optional tools like Choose date range See attendance by semester/subject This makes the dashboard more interactive. -->
</div>