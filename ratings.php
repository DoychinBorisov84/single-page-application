<?php
session_start();

// include 'customFunctions/db_config.php';
include 'customFunctions/config.php';
include 'classes/Database.class.php';

$data = $_POST;
$action = $data['action'];
$logged_user_id = $data['logged_user_id'];
// var_dump($data);


// $sql = "INSERT INTO user_counter";
// echo $data['liked'];
// echo $data['who_clicked'];

$db = new Database();

if(isset($action)){
	switch($action){
		case 'like' :
			$result =  $db->likeUser($data['name'], $data['visitor_id']);
			if ($result == 1){
				echo 'liked';
			}
			break;
		case 'dislike' :	
			$result = $db->unLikeUser($data['name'], $data['visitor_id']);
			if ($result == 1){
				echo 'unliked'; 
			}
			break;
	}
}else if(isset($logged_user_id)){
	$result = $db->checkUserReaction($logged_user_id);
	
	echo $result['user_liked'];
}


