<?php
session_start();

include_once 'customFunctions/config.php';
require_once 'classes/Database.class.php';

// Database Instance
$db = new Database();

$all_users = $db->selectUsersAll();

$top_user = $db->selectUsersAll($topUser=true);

if( isset($_SESSION['email']) ){
  $user_exist_db = $db->selectUserFromDatabase($_SESSION['email']);
  $logged_user = $db->checkUserLogged($_SESSION['email'], $_SESSION['logged']);
}

if(isset($_GET['url_action']) && !empty($_GET['url_action'])){
  $url_action = $_GET['url_action'];

  $help_msg = '';
  switch($url_action){
    case 'error_incorrect_data';
      $help_msg = 'Enter your credentials to access that page!';
      break;
    case 'error_credentials';
      $help_msg = 'Please enter your email and password correctly';
      break;
    case 'restricted';
      $help_msg = 'Unauthorized Access';
      break;
    case 'logout';
      $help_msg = 'Successfully logged out';
      break;
    case 'incorrect_data';
      $help_msg = 'Please fill all the fields correctly';
      break;
    case 'user_exist';
      $help_msg = 'There is a registration with that email';
      break;
    case 'user_registered';
      $help_msg = 'Please login with your credentials';
      break;
    case 'error_exists';
      $help_msg = 'Email not found';
      break;
    case 'profile_deleted';
      $help_msg = 'The Profile has been successfully deleted';
      break;
    case 'profile_created';
      $help_msg = 'The Profile has been successfully created';
      break;
    case 'db_fail';
      $help_msg = 'Sorry. There is a problem with the database!';
      break;
    case 'message_sent';
      $help_msg = 'Message sent';
      break;
    case 'reset_password';
      $help_msg = 'Check your email, and reset the password';
      break;
    case 'mailNotFound';
      $help_msg = 'Not existing email, please check, or try login!';
      break;
    case 'password_changed':
      $help_msg = 'password_changed';
      break;
    default: 
      $help_msg = '';
  }
}
?>

<!-- header -->
<?php include 'includes/header.php'; ?>

      <div class="ml-auto w-25">
        <nav class="site-navigation position-relative text-right" role="navigation">
          <ul class="site-menu main-menu site-menu-dark js-clone-nav mr-auto d-none d-lg-block m-0 p-0">                  
            <?php if(!isset($_SESSION['logged']) && empty($_SESSION['logged'])){
                echo '<li class="cta cta_login"><a href="#formLogin" class=""><span>Log in</span></a></li>';
                echo '<li class="cta"><a href="#contact-section" class=""><span>Register</span></a></li>';
            }else{
              echo '<li class="cta cta_email"><a href="logout.php" class="nav-link"><span>Log Out</span></a></li>';                  
            }
            ?>
          </ul>
        </nav>
        <a href="#" class="d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black float-right"><span class="icon-menu h3"></span></a>
      </div>
    </div>
  </div>      
</header>

<div class="intro-section" id="home-section">      
  <div class="slide-1" style="background-image: url('images/home.jpg');" data-stellar-background-ratio="0.5">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-12">
          <div class="row align-items-center">
            <div class="col-lg-6 mb-4">
              <?php
              if(!isset($_SESSION['logged']) && empty($_SESSION['logged'])){
                echo '<h1  data-aos="fade-up" data-aos-delay="100">Register here</h1>
                <p class="mb-4"  data-aos="fade-up" data-aos-delay="200">Join our forces...</p>
              <p data-aos="fade-up" data-aos-delay="300"><a href="#contact-section" class="btn btn-primary py-3 px-5 btn-pill">Register</a></p>';
              }
              else{
                echo '<h1  data-aos="fade-up" data-aos-delay="100">Hello, '.$_SESSION['firstName'].'</h1>
              ';
              } 
              ?>
            </div>
            
            <?php
            if(!isset($_SESSION['logged']) && empty($_SESSION['logged'])){
              echo '<div class="col-lg-5 ml-auto" data-aos="fade-up" data-aos-delay="500">                  
              <form action="logged.php" method="post" class="form-box" id="formLogin">
                <h5 id="login_info"></h5>
                <h3 class="h4 text-black mb-4">Sign In</h3>
                <span id="pass_reset" style="color:red;display:none;">Password Changed, please login</span>
                <div class="form-group">
                  <input type="email" class="form-control" placeholder="Email" id="email_login" name="email_login" required>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" placeholder="Password" id="password_login" name="password_login" required>
                </div>                    
                <div class="form-group">
                  <input type="submit" class="btn btn-primary btn-pill" value="Sign up" id="submit"> 
                <a href="forgot_password.php" class="btn btn-link" value="Forgot password" id="forgot_pass">Forgot password</a>
                </div>

              </form>                  
            </div>';
            }else{
              $user_img = $user_exist_db["image"] != '' && file_exists($user_exist_db["image"]) ? $user_exist_db["image"] : "images/users/default.png";
              echo'<div class="col-lg-5 ml-auto" data-aos="fade-up" data-aos-delay="500" style="display: table;"> 
                <a href="profile.php"><img src="'.$user_img.'" alt="Profile img" style="display: table-cell; width: 100%; border-radius: 10%;"></a>
                </div>';
            }
            ?>               
          </div>
        </div>
        
      </div>
    </div>
  </div>
</div>
    
<div class="site-section users-title" id="courses-section">
  <div class="container">
    <div class="row mb-5 justify-content-center">
      <div class="col-lg-7 text-center" data-aos="fade-up" data-aos-delay="">
        <h2 class="section-title">Registered Users</h2>
      </div>
    </div>
  </div>
</div>

<div class="site-section courses-entry-wrap"  data-aos="fade-up" data-aos-delay="100">
  <div class="container">
    <div class="row">
      <div class="owl-carousel col-12 nonloop-block-14">              
          <?php foreach ($all_users as $user) { ?>
            <div class="course bg-white h-100 align-self-stretch user-profile">
              <figure class="m-0">
                <a href="course-single.php?character=<?php echo $user['firstName']; ?>"><img src="<?php echo ($user["image"] != '' && file_exists($user['image']) ? $user['image'] : '/images/users/default.png' ); ?>" alt="Image Failed" class="img-fluid"></a>
              </figure>
              <div class="course-inner-text py-4 px-4">
                <div class="meta"><span class="fa fa-user-o"></span><span id="user_name"><?php echo $user["firstName"]; ?></span></div>
                <!-- <h3><a href="#">User data</a></h3> -->
                <!-- <p>User data</p> -->
              </div>
              <div class="d-flex border-top stats">                    
                <i class="fa-like fa fa-thumbs-up liker"></i>
                <div class="py-3 px-4"><span class="icon-users"></span><span id="num_likes" style="font: italic bold 26px Georgia, serif; color: #009973;"><?php echo "\t".$user['likes'];?></span> like(s)</div>
                <!-- <div class="py-3 px-4 w-25 ml-auto border-left"><span class="icon-chat"></span> 2</div> -->
              </div>
            </div>
          <?php } ?>   
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col-7 text-center">
        <button class="customPrevBtn btn btn-primary m-1">Prev</button>
        <button class="customNextBtn btn btn-primary m-1">Next</button>
      </div>
    </div>

  </div>
</div> 

<div class="site-section bg-image overlay" id="user-section" style="background-image: url('images/top_usr_bgr.jpg');">
  <div class="container">
    <div class="row justify-content-center align-items-center">
      <div class="col-md-8 text-center testimony">
        <!-- TODO: update changes top-user without reload -->
        <img src="<?php echo ($top_user[0]["image"] != '' && file_exists($top_user[0]['image']) ? $top_user[0]['image'] : '/images/users/default.png' ); ?>" alt="Image" class="img-fluid w-25 mb-4 rounded-circle">
        <!-- <h3 class="mb-4">Most Liked User</h3> -->
        <blockquote>
          <p>&ldquo; Current Top User : <strong><?php echo ($top_user[0]['firstName'] ? $top_user[0]['firstName'] : 'Unknown'); ?></strong> &rdquo;</p>
        </blockquote>
      </div>
    </div>
  </div>
</div>

<?php if(!isset($_SESSION['logged']) && empty($_SESSION['logged'])){
    if(!isset($_GET['reset_password'])){
      echo '<div class="site-section bg-light" id="contact-section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-7">            
            <h2 class="section-title mb-3">Registration Form</h2>
            <form action="register.php" method="post" data-aos="fade" id="formRegister">
            <h5 id="register_info"></h5>
              <div class="form-group row">
                <div class="col-md-6 mb-3 mb-lg-0">
                  <input type="text" class="form-control" placeholder="First name" id="firstName" name="firstName" required>
                </div>
                <div class="col-md-6">
                  <input type="text" class="form-control" placeholder="Last name" id="lastName" name="lastName" required>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-12">
                  <input type="email" class="form-control" placeholder="Email" id="email_reg" name="email_reg" required>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-12">
                  <input type="password" class="form-control" placeholder="Password" id="password_reg" name="password_reg" required>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-12">                
                  <input type="password" class="form-control" placeholder="Re Password" id="repassword" name="repassword" required>
                </div>
              </div>
                    <span id="message"></span>
              <div class="form-group row">
                <div class="col-md-6">                  
                  <input type="submit" name="submit" class="btn btn-primary py-3 px-5 btn-block btn-pill" value="Register">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>';
    }else{
    $reset_password = $_GET['reset_password'] != '' ? $_GET['reset_password'] : '';        
      echo '<div class="site-section bg-light" id="contact-section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-7">            
            <h2 class="section-title mb-3">Reset your password</h2>
            <form method="post" action="reset_password.php" data-aos="fade" id="formReset">
            <h5 id="reset_info"></h5>                
              <div class="form-group row">
                <div class="col-md-12">
                  <input type="password" class="form-control" placeholder="New Password" id="resetpassword" name="resetpassword" required>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-12">                
                  <input type="password" class="form-control" placeholder="Re-type New Password" id="reresetpassword" name="reresetpassword" required>
                </div>
              </div>
              <span id="message"></span>
              <input type="hidden" name="reset_password" value="'.$reset_password.'">

              <div class="form-group row">
                <div class="col-md-6">                  
                  <input type="submit" class="btn btn-primary py-3 px-5 btn-block btn-pill" value="Reset password">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>';
    }
  }
?>    
   
<!-- footer  -->
<?php require_once 'includes/footer.php'; ?>

<!-- JS section -->
<script type="text/javascript">
$(document).ready(function(){  
  // var helpMsg = '<?php// echo $help_msg; ?>';  // get the $_GET url-param
  var helpMsg = '<?php echo isset($help_msg) ? $help_msg : ''; ?>';  // get the $_GET url-param


  //add the text to the empty input-field for the error message
  if( helpMsg || helpMsg.length != 0 ){
    switch (helpMsg) {
      case 'There is a registration with that email':
        $('#register_info').text(helpMsg);
        break;

      case 'Message sent':
        $('#message_info').text(helpMsg);          
        break;

      case 'Successfully logged out':
        $('#pass_reset').css('display', 'block');
        $('#pass_reset').text(helpMsg);
        sessionStorage.clear();
        break;
      
      case 'password_changed':
        $('#pass_reset').css('display', 'block');
        break;

      default:
        $('#login_info').text(helpMsg);
        break;
    }
  }

  var email_login_session = (sessionStorage.getItem('email_login') != 'undefined') ? sessionStorage.getItem('email_login') : '';  
  var firstName_session = (sessionStorage.getItem('firstName') != 'undefined') ? sessionStorage.getItem('firstName') : '';  
  var lastName_session = (sessionStorage.getItem('lastName') != 'undefined') ? sessionStorage.getItem('lastName') : '';        
  var email_session = (sessionStorage.getItem('email_reg') != 'undefined') ? sessionStorage.getItem('email_reg') : '';
  
  //Retype the 2-forms-fields with the sessionStorage      
    $('#email_login').val(email_login_session);
    $('#firstName').val(firstName_session);
    $('#lastName').val(lastName_session);      
    $('#email_reg').val(email_session);      

  //save the send-email-field-data for the session on input-change
  $('#email_login, #firstName, #lastName, #subject, #email_reg, #textarea').on('change', function(){
    sessionStorage.setItem('email_login', $('#email_login').val());
    sessionStorage.setItem('firstName', $('#firstName').val());
    sessionStorage.setItem('lastName', $('#lastName').val());        
    sessionStorage.setItem('email_reg', $('#email_reg').val());        
  });

  // Function for comparing pass/repass, set msg, set reg_check for form to enable        
  function passwordCompare(pass, repass){
    var pass_check = false;
    
    if ( pass == repass ) {
      if( pass.length < 6){
        $('#message').html('Password must be at least 6 characters').css('color', 'red');
        pass_check = false;
      }else{
        $('#message').html('').css('color', '');
        pass_check = true;
      }
    } else {
      pass_check = false;
      $('#message').html('Passwords don\'t match').css('color', 'red');
    }

    return pass_check;
  }

  // Register Form
  var register_pass_check = false;
  $('#password_reg, #repassword').on('keyup', function(){
    var check = passwordCompare($('#password_reg').val(), $('#repassword').val());
    
    register_pass_check = check;
  });      
    $('#formRegister').submit(function(event){
    if(register_pass_check === false){
      event.preventDefault();
    }
  });

  // Reset pass form
  var reset_pass_check = false;
  $('#resetpassword, #reresetpassword').on('keyup', function(){
    var check = passwordCompare($('#resetpassword').val(), $('#reresetpassword').val());
    reset_pass_check = check;
  });
  $('#formReset').submit(function(event){
    if(reset_pass_check == false){
      event.preventDefault();
    }
  });


  // Sesssion user data
  // var logged = '<?php //echo json_encode($logged_user); ?>';
  var logged = '<?php echo ( isset($logged_user) ? json_encode($logged_user) : ''); ?>';

  var logged_arr = JSON.parse(logged);
  
  // Detect logged user has already liked someone      
  if(logged_arr.length !== 0){
    var user_id = logged_arr[0].id;

    // Extract the liked data from the DB
    $.ajax({
      method: "POST",
      url: "ratings.php" ,
      data:{
        logged_user_id: user_id
      },
      success: function(response){
        var name_liked = response; // the name returned from the db query 

        if(name_liked){
        $("span:contains('"+name_liked+"')" ).parent().parent().next().find('.liker').addClass('fa-active'); // set the active class for the db-liked name
        }
        
      }
    });
  }

  
  // Like/Dislike functionality
  $(".container").on('click', '.liker', function(){ 
      // console.log(logged_arr[0].email);
    if(logged_arr.length == 0 || logged_arr == undefined ){
      // alert('Only registered users allowed to vote');
      bootbox.alert({
          message: "Only registered users are allowed to vote!",
          size: 'small',
          className: 'rubberBand animated'
      });
      return;
    }
      var logged_user_id = logged_arr[0].id;
                
      var clickedBtn = $(this);
      var currentClickedName = clickedBtn.closest(".owl-item").find("#user_name").text();      
      var currentClickedLikes = parseInt(clickedBtn.next().find('#num_likes').text());

      if( clickedBtn.hasClass('fa-active') ){
        action = 'dislike';
      }else if( !clickedBtn.hasClass('fa-active') ){
        action = 'like';
      }
  
      // Save the data
      $.ajax({
        method: "POST",
        url: "ratings.php",
        data:{
          name: currentClickedName,
          visitor_id: logged_user_id,
          action: action
        },
        success: function(data){
          if( action == 'like' ){
              if(data == 'liked'){
                
                // reduce the current liked-user count
                var currentLikedCount = parseInt($('i.fa-active').next().find('#num_likes').first().text());
                var reducer = currentLikedCount-1;
                var currentLikedName = $('i.fa-active').parent().parent().find('#user_name').first().text();
                $('span:contains('+currentLikedName+')').parent().parent().next().find('#num_likes').text(reducer);

                // increment the clicked user count
                var incr = currentClickedLikes+1;
                $('.fa-like').removeClass('fa-active');
                clickedBtn.addClass('fa-active');
                clickedBtn.next().find('#num_likes').text(incr);
                // alert("You liked" + ": " +  currentClickedName);
                bootbox.alert({
                    message: "You liked" + ": " +  currentClickedName,
                    size: 'small',
                    className: 'rubberBand animated'
                });
                
              }
          }else if( action == 'dislike' ){
            if(data == 'unliked'){
              var decr = currentClickedLikes-1;
              clickedBtn.removeClass('fa-active');
              clickedBtn.next().find('#num_likes').text(decr);
              // alert("You disLiked" + ": " +  currentClickedName);
              bootbox.alert({
                    message: "You disLiked" + ": " +  currentClickedName,
                    size: 'small',
                    className: 'rubberBand animated'
                });
            }

          }
        }
      });  
      
  });

});//document ready
        
</script>

  </body>
</html>