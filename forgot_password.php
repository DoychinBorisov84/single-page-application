<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Reset password</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">        
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>   

	<link rel="stylesheet" href="css/resetPassword.css">
</head>

<body>  
<div id="login-button">
  <img src="https://dqcgrsy5v35b9.cloudfront.net/cruiseplanner/assets/img/icons/login-w-icon.png">
  </img>
</div>

<div id="forgotten-container">
<h1>Forgotten Account ?</h1>  

<form method="post" action="reset_email.php">
	<input type="email" name="email" placeholder="E-mail" required>	
	<a href="index.php" class="green-btn">Home</a>    
  <!-- <a href="submit" class="red-btn">Get new password</a> -->
    <input type="submit" class="btn btn-primary py-3 px-5 btn-block btn-pill red-btn" value="Reset password">
</form>
</div>  

<script type="text/javascript" charset="utf-8" >
$('#login-button').click(function(){
  $('#login-button').fadeOut("slow",function(){
    // $("#container").fadeIn();
    $("#forgotten-container").fadeIn();
    TweenMax.from("#forgotten-container", .4, { scale: 0, ease:Sine.easeInOut});
    TweenMax.to("#forgotten-container", .4, { scale: 1, ease:Sine.easeInOut});
  });
});

</script>
</body>
</html>
