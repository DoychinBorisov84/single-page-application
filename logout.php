<?php
session_start();
session_unset();
session_destroy();

$login_error = 'logout';
header("Location: index.php?url_action=".$login_error);
die('Logged Out');
