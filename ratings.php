<?php
session_start();

include_once 'customFunctions/config.php';
require_once 'classes/Database.class.php';

$data = $_POST;
$action = $data['action'];
$logged_user_id = $data['logged_user_id'];
// echo $data['liked'];

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


