<?php
session_start();
session_unset();
session_destroy();

// delete cookie
setcookie(session_name(), '', time() - 3600, '/');

header("Location: ../VIEW_HTML_PAGES/login.php");
exit;
