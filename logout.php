<?php
session_start();
session_unset();
session_destroy();

$login_error = 'logout';
// header("Location: index.php?error=".$login_error);
// header("Location: http://user-administration.lan/index.php?error=".$login_error);
header("Location: index.php?error=".$login_error);
die('Logged Out');

?>