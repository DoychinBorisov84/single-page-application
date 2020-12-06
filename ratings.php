<?php
session_start();

// include 'customFunctions/db_config.php';
include 'customFunctions/config.php';
include 'classes/Database.class.php';

$data = $_POST;
$action = $data['action'];

// $sql = "INSERT INTO user_counter";
// echo $data['liked'];
// echo $data['who_clicked'];

$db = new Database();

// TODO: limit the user to have only 1 reaction to be saved <> Database.class.php
// - update the record only OR remove if unlike
switch($action){
	case 'like' :
		$result =  $db->likeUser($data['name'], $data['visitor_id']);
		if ($result == 1){
			echo 'success';
		}
		break;
	case 'dislike' :	
		$result = $db->unLikeUser($data['name'], $data['visitor_id']);
		if ($result == 1){
			echo 'success'; 
		}
		break;
}



// var_dump($db->likeUser($data['liked'], $data['who_clicked']));

