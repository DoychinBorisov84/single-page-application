<?php

//Validate data
function validateData($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data, ENT_QUOTES);
  return $data;
}

// function outputData($data){
// 	$data = htmlentities($data, ENT_QUOTES);
//  return $data;
// }

