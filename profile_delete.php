<?php 
session_start();
// error_reporting( E_ALL );
// ini_set( 'display_errors', 1 );
include 'customFunctions/db_config.php';

$user_email = $_SESSION['email'];
$user_firstName = $_SESSION['firstName'];
$user_lastName = $_SESSION['lastName'];
$user_logged = $_SESSION['logged'];	

  // $pdo_query = "SELECT logged FROM characters WHERE email=:user_email";
	$pdo_query = "SELECT logged FROM users WHERE email=:user_email";
	$pdo_query_request = $connection->prepare($pdo_query);
	$pdo_query_request->execute([':user_email' => $user_email]);

	$col_logged_assoc = $pdo_query_request->fetch(PDO::FETCH_ASSOC);
	$cell_logged = $col_logged_assoc['logged'];

// Compare the session vs DB record
if($user_logged != $cell_logged || $user_logged == 'undefined' || $user_logged == NULL){
	// echo 'buggg';
	$login_error = 'hacking';
	header("Location: index.php?error=".$login_error);
	session_unset();
	session_destroy();
	exit();
}

$sql_delete = "DELETE FROM users WHERE email=:user_email";
$sql_delete_request = $connection->prepare($sql_delete);
$sql_delete_request->execute([':user_email' => $user_email]);

session_unset();
session_destroy();
$login_error = 'profile_deleted';
header("Location: http://single-page-application.lan/index.php?error=".$login_error);

exit();

?>