<?php
session_start();

include 'customFunctions/db_config.php';
include 'customFunctions/config.php';
include 'classes/Database.class.php';

// Database Instance
$db = new Database();

// var_dump($_FILES);
// var_dump($_SESSION); die;

// TODO: Handle the file upload
$target_dir = 'images/users/'; // OK if given permissions
// $target_dir = '/www/html/single-page-application/images/users/'; // what the abs path struct will be
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);  
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// $size = getimagesize($_FILES["fileToUpload"]["tmp_name"]); // width, height etc

$uploadOk = 1;  
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
	// Check if file already exists
	if(file_exists($target_file)) {
	  echo "Sorry, file already exists.";
	  $uploadOk = 0;
	}else if ($_FILES["fileToUpload"]["size"] > 2000000) { // Check file size		
	  echo "Sorry, up to 2MB for image is allowed";
	  $uploadOk = 0;
	}else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"	&& $imageFileType != "gif" ) {  // Allow certain file formats
	  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	  $uploadOk = 0;
	}

}	

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    // Upload the img-path
    $db->saveImg($target_file, $_SESSION['email']);
	header("Location: profile_edit.php?msg=img_uploaded");	    
  } else {
    echo "Sorry, your file is ok. But there was an error uploading your file.";
  }
}

