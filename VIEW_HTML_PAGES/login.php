<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login | MyAttendance</title>
  <link rel="stylesheet" href="../CSS/login.css" />
</head>

<body>
  <?php include('../COMPONENTS/Navbar.php') ?>

  <div class="login-wrapper">

    <!-- Big Background Text -->
    <h1 class="bg-title">MyAttendance</h1>

    <!-- Login Card -->
    <div class="main">
      <h2>Login</h2>

      <form action="../CONTROLLER_PHP/login_control.php" method="POST">
        <div class="labelInput">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="name@gmail.com" required />
        </div>

        <div class="labelInput">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="Enter password" required />
        </div>

        <button type="submit">Login</button>
      </form>
    </div>

  </div>

  <?php include('../COMPONENTS/Footer.php') ?>
</body>

</html>