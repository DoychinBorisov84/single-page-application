<?php
session_start();

require_once 'customFunctions/config.php';
require_once 'classes/Database.class.php';

// Database Instance
$db = new Database();

$target_file = USER_IMAGES_DIR . basename($_FILES["fileToUpload"]["name"]);  
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

$uploadOk = 1;  
// Check if image file is a actual image file
if( isset($_POST["submit"]) ){
	if( file_exists($target_file) ) {
	  $msg_upload = 'img_exist';
	  $uploadOk = 0;
	}elseif( $_FILES["fileToUpload"]["size"] > 1900000 || $_FILES["fileToUpload"]["size"] == 0) {
	  $msg_upload = 'img_size_err';
	  $uploadOk = 0;
	}elseif( $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
	  $msg_upload = 'img_type_err';
	  $uploadOk = 0;
	}else{
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			// Upload the img-path
			$db->saveImg($target_file, $_SESSION['email']);
			$msg_upload = 'img_success';
		} else {
			$msg_upload = 'img_fail';
			$uploadOk = 0;
		}
	}
 header("Location: profile_edit.php?msg=$msg_upload");
}	


