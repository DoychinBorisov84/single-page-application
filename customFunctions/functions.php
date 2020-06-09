<?php

//Validate data
function validateData($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
  return $data;
}

