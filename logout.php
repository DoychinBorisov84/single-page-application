<?php
session_start();
session_unset();
session_destroy();

$login_error = 'logout';
// header("Location: index.php?error=".$login_error);
header("Location: http://single-page-application.lan/index.php?error=".$login_error);

?>