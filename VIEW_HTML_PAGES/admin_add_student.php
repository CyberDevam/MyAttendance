<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add User | MyAttendance</title>
  <link rel="stylesheet" href="../CSS/admin_add_student.css">
</head>

<body>
  <?php 
  session_start();
  if ($_SESSION['role'] !== 'admin') {
    header("Location: ./login.php");
  }
  ?>
  <div class="main">
    <h1>MyAttendance</h1>
    <h2 id="formTitle">Add Student Details</h2>

    <div class="toggle">
      <button type="button" class="active" id="studentBtn">Student</button>
      <button type="button" id="teacherBtn">Teacher</button>
      <button type="button" id="subjectBtn">Subject</button>
    </div>

    <form id="mainForm" action="../CONTROLLER_PHP/add_student.php" method="POST">

      <!-- NAME (Student & Teacher) -->
      <div class="labelInput" id="nameField">
        <label>Name</label>
        <input type="text" name="name">
      </div>

      <!-- STUDENT FIELDS -->
      <div id="studentFields">
        <div class="labelInput">
          <label>Roll Number</label>
          <input type="text" name="roll_no">
        </div>

        <div class="labelInput">
          <label>Division</label>
          <input type="text" name="division">
        </div>

        <div class="labelInput">
          <label>Semester</label>
          <input type="number" name="semester" min="1" max="12">
        </div>
      </div>

      <!-- EMAIL & PASSWORD (Student & Teacher) -->
      <div id="authFields">
        <div class="labelInput">
          <label>Email</label>
          <input type="email" name="email">
        </div>

        <div class="labelInput">
          <label>Password</label>
          <input type="password" name="password">
        </div>
      </div>

      <!-- SUBJECT FIELDS -->
      <div id="subjectFields" style="display:none;">
        <div class="labelInput">
          <label>Subject Name</label>
          <input type="text" name="subject_name">
        </div>

        <div class="labelInput">
          <label>Semester</label>
          <input type="number" name="semester" min="1" max="12">
        </div>

        <div class="labelInput">
          <label>Teacher ID</label>
          <input type="number" name="teacher_id" min="1">
        </div>
      </div>

      <button type="submit">Add</button>
    </form>
  </div>

  <script>
    const studentBtn = document.getElementById('studentBtn');
    const teacherBtn = document.getElementById('teacherBtn');
    const subjectBtn = document.getElementById('subjectBtn');

    const studentFields = document.getElementById('studentFields');
    const subjectFields = document.getElementById('subjectFields');
    const authFields = document.getElementById('authFields');
    const nameField = document.getElementById('nameField');

    const formTitle = document.getElementById('formTitle');
    const form = document.getElementById('mainForm');

    function resetButtons() {
      studentBtn.classList.remove('active');
      teacherBtn.classList.remove('active');
      subjectBtn.classList.remove('active');
    }

    studentBtn.onclick = () => {
      resetButtons();
      studentBtn.classList.add('active');

      studentFields.style.display = 'block';
      subjectFields.style.display = 'none';
      authFields.style.display = 'block';
      nameField.style.display = 'block';

      formTitle.innerText = 'Add Student Details';
      form.action = '../CONTROLLER_PHP/add_student.php';
    };

    teacherBtn.onclick = () => {
      resetButtons();
      teacherBtn.classList.add('active');

      studentFields.style.display = 'none';
      subjectFields.style.display = 'none';
      authFields.style.display = 'block';
      nameField.style.display = 'block';

      formTitle.innerText = 'Add Teacher Details';
      form.action = '../CONTROLLER_PHP/add_teacher.php';
    };

    subjectBtn.onclick = () => {
      resetButtons();
      subjectBtn.classList.add('active');

      studentFields.style.display = 'none';
      subjectFields.style.display = 'block';
      authFields.style.display = 'none';
      nameField.style.display = 'none';

      formTitle.innerText = 'Add Subject Details';
      form.action = '../CONTROLLER_PHP/add_subject.php';
    };
  </script>
</body>
</html>
