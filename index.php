<?php
session_start();

$password_changed = $_GET['password_changed'] != '' ? $_GET['password_changed'] : '';
if(isset($_GET['error']) && !empty($_GET['error'])){
$errorPost = $_GET['error'];
$error = '';
  
  switch($errorPost){
    case 'error_incorrect_data';
      $error = 'Enter your credentials, to access that page!';
      break;
    case 'error_credentials';
      $error = 'Please enter your email and password correctly';
      break;
    case 'hacking';
      $error = 'Please do not hack me, I am a simple website';
      break;
    case 'logout';
      $error = 'Successfully logged out';
      break;
    case 'incorrect_data';
      $error = 'Please fill all the fields correctly';
      break;
    case 'user_exist';
      $error = 'There is a registration with that email';
      break;
    case 'profile_deleted';
      $error = 'The Profile has been successfully deleted';
      break;
    case 'message_sent';
      $error = 'Message sent';
      break;
    case 'reset_password';
      $error = 'Check your email, and reset the password';
      break;
    case 'mailNotFound';
      $error = 'Not existing email, please check again';
      break;
    default: 
        $error = '';
  }
}else{
  $error = '';
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Cute Website</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">

    <link rel="stylesheet" href="css/jquery.fancybox.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">

    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet" href="css/customCss.css">    
  </head>
  <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300" id="home">
  
  <div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>
   
    
    <header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner">
      
      <div class="container-fluid">
        <div class="d-flex align-items-center">
          <div class="site-logo mr-auto w-25"><a href="index.php">Cartoons Co</a></div>

          <div class="mx-auto text-center">
            <nav class="site-navigation position-relative text-right" role="navigation">
              <ul class="site-menu main-menu js-clone-nav mx-auto d-none d-lg-block  m-0 p-0">
                <li><a href="index.php#home-section" class="nav-link">Home</a></li>
                <li><a href="index.php#courses-section" class="nav-link">Characters</a></li>
                <li><a href="index.php#programs-section" class="nav-link">Why cartoon?</a></li>
                <li><a href="index.php#teachers-section" class="nav-link">Top Heroes</a></li>
              </ul>
            </nav>
          </div>

          <div class="ml-auto w-25">
            <nav class="site-navigation position-relative text-right" role="navigation">
              <ul class="site-menu main-menu site-menu-dark js-clone-nav mr-auto d-none d-lg-block m-0 p-0">                  
                <?php if(!isset($_SESSION['logged']) && empty($_SESSION['logged'])){
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
      <div class="slide-1" style="background-image: url('images/home_1280.png');" data-stellar-background-ratio="0.5">
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
                    echo '<h1  data-aos="fade-up" data-aos-delay="100">Hello '.$_SESSION['firstName'].'</h1>
                    <p class="mb-4"  data-aos="fade-up" data-aos-delay="200">Send me a message</p>
                  <p data-aos="fade-up" data-aos-delay="300"><a href="#contact-section" class="btn btn-primary py-3 px-5 btn-pill">Send</a></p>';
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
                  echo'<div class="col-lg-5 ml-auto" data-aos="fade-up" data-aos-delay="500" style="display: table;"> 
                    <a href="profile.php"><img src="images/logged_1920.jpg" alt="Profile img" style="display: table-cell; width: 100%; border-radius: 10%;"></a>
                    </div>';
                }
                ?>               
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>

    
    <div class="site-section courses-title" id="courses-section">
      <div class="container">
        <div class="row mb-5 justify-content-center">
          <div class="col-lg-7 text-center" data-aos="fade-up" data-aos-delay="">
            <h2 class="section-title">Characters</h2>
          </div>
        </div>
      </div>
    </div>
    <!-- <div class="site-section courses-entry-wrap"  data-aos="fade-up" data-aos-delay="100"> -->
    <div class="site-section courses-entry-wrap"  data-aos="fade-up" data-aos-delay="1100">

      <div class="container">
        <div class="row">

          <div class="owl-carousel col-12 nonloop-block-14">

            <div class="course bg-white h-100 align-self-stretch">
              <figure class="m-0">
                <a href="course-single.php?character=bee"><img src="images/bee_1280.png" alt="Image" class="img-fluid"></a>
              </figure>
              <div class="course-inner-text py-4 px-4">
                <!-- <span class="course-price">$20</span> -->
                <div class="meta"><span class="icon-clock-o"></span>The Bee</div>
                <h3><a href="#">Gather honey</a></h3>
                <p>Super cool</p>
              </div>
              <div class="d-flex border-top stats">
                <!-- <div class="py-3 px-4"><span class="icon-users"></span> 2,193 students</div> -->
                <!-- <div class="py-3 px-4 w-25 ml-auto border-left"><span class="icon-chat"></span> 2</div> -->
              </div>
            </div>

            <div class="course bg-white h-100 align-self-stretch">
              <figure class="m-0">
                <a href="course-single.php?character=businessman"><img src="images/businessman_1280.png" alt="Image" class="img-fluid"></a>
              </figure>
              <div class="course-inner-text py-4 px-4">
                <!-- <span class="course-price">$99</span> -->
                <div class="meta"><span class="icon-clock-o"></span>The Boss</div>
                <h3><a href="#">Curiuos</a></h3>
                <p>Not a bad guy </p>
              </div>
              <div class="d-flex border-top stats">
                <!-- <div class="py-3 px-4"><span class="icon-users"></span> 2,193 students</div> -->
                <!-- <div class="py-3 px-4 w-25 ml-auto border-left"><span class="icon-chat"></span> 2</div> -->
              </div>
            </div>

            <div class="course bg-white h-100 align-self-stretch">
              <figure class="m-0">
                <a href="course-single.php?character=penguin"><img src="images/penguin_1280.png" alt="Image" class="img-fluid"></a>
              </figure>
              <div class="course-inner-text py-4 px-4">
                <!-- <span class="course-price">$99</span> -->
                <div class="meta"><span class="icon-clock-o"></span>Mr Penguin</div>
                <h3><a href="#">Love the ice</a></h3>
                <p>Walks funny</p>
              </div>
              <div class="d-flex border-top stats">
                <!-- <div class="py-3 px-4"><span class="icon-users"></span> 2,193 students</div> -->
                <!-- <div class="py-3 px-4 w-25 ml-auto border-left"><span class="icon-chat"></span> 2</div> -->
              </div>
            </div>



            <div class="course bg-white h-100 align-self-stretch">
              <figure class="m-0">
                <a href="course-single.php?character=pirate"><img src="images/pirate_1280.png" alt="Image" class="img-fluid"></a>
              </figure>
              <div class="course-inner-text py-4 px-4">
                <!-- <span class="course-price">$20</span> -->
                <div class="meta"><span class="icon-clock-o"></span>Pirate Joe</div>
                <h3><a href="#">Likes to drink Rum</a></h3>
                <p>Yo ho ho</p>
              </div>
              <div class="d-flex border-top stats">
                <!-- <div class="py-3 px-4"><span class="icon-users"></span> 2,193 students</div> -->
                <!-- <div class="py-3 px-4 w-25 ml-auto border-left"><span class="icon-chat"></span> 2</div> -->
              </div>
            </div>

            <div class="course bg-white h-100 align-self-stretch">
              <figure class="m-0">
                <a href="course-single.php?character=teacher"><img src="images/teacher_1280.png" alt="Image" class="img-fluid"></a>
              </figure>
              <div class="course-inner-text py-4 px-4">
                <!-- <span class="course-price">$99</span> -->
                <div class="meta"><span class="icon-clock-o"></span>The teacher</div>
                <h3><a href="#">Loves everyone</a></h3>
                <p>Always helping</p>
              </div>
              <div class="d-flex border-top stats">
                <!-- <div class="py-3 px-4"><span class="icon-users"></span> 2,193 students</div> -->
                <!-- <div class="py-3 px-4 w-25 ml-auto border-left"><span class="icon-chat"></span> 2</div> -->
              </div>
            </div>

            <div class="course bg-white h-100 align-self-stretch">
              <figure class="m-0">
                <a href="course-single.php?character=turtle"><img src="images/turtle_1280.png" alt="Image" class="img-fluid" height="335px"></a>
              </figure>
              <div class="course-inner-text py-4 px-4">
                <!-- <span class="course-price">$99</span> -->
                <div class="meta"><span class="icon-clock-o"></span>Franklin the Turtle</div>
                <h3><a href="#">Kind of slow</a></h3>
                <p>Great pal</p>
              </div>
              <div class="d-flex border-top stats">
                <!-- <div class="py-3 px-4"><span class="icon-users"></span> 2,193 students</div> -->
                <!-- <div class="py-3 px-4 w-25 ml-auto border-left"><span class="icon-chat"></span> 2</div> -->
              </div>
            </div>

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


    <div class="site-section" id="programs-section">
      <div class="container">
        <div class="row mb-5 justify-content-center">
          <div class="col-lg-7 text-center"  data-aos="fade-up" data-aos-delay="">
            <h2 class="section-title">Why cartoons?</h2>
            <p>Cartoons are super funny. Nothing more to be added. Just love them</p>
          </div>
        </div>
        <div class="row mb-5 align-items-center">
          <div class="col-lg-7 mb-5" data-aos="fade-up" data-aos-delay="100">
            <img src="images/dancing-dave-minion_1920.jpg" alt="Image" class="img-fluid">
          </div>
          <div class="col-lg-4 ml-auto" data-aos="fade-up" data-aos-delay="200">
            <h2 class="text-black mb-4">We Are Excellent In Education</h2>
            <p class="mb-4">You know these two guys :)</p>

            <div class="d-flex align-items-center custom-icon-wrap mb-3">
              <!-- <span class="custom-icon-inner mr-3"><span class="icon icon-graduation-cap"></span></span> -->
              <!-- <div><h3 class="m-0">22,931 Yearly Graduates</h3></div> -->
            </div>

            <div class="d-flex align-items-center custom-icon-wrap">
              <!-- <span class="custom-icon-inner mr-3"><span class="icon icon-university"></span></span> -->
              <!-- <div><h3 class="m-0">150 Universities Worldwide</h3></div> -->
            </div>

          </div>
        </div>

       <!--  <div class="row mb-5 align-items-center">
          <div class="col-lg-7 mb-5 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="100">
            <img src="images/undraw_teaching.svg" alt="Image" class="img-fluid">
          </div>
          <div class="col-lg-4 mr-auto order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
            <h2 class="text-black mb-4">Strive for Excellent</h2>
            <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem maxime nam porro possimus fugiat quo molestiae illo.</p>

            <div class="d-flex align-items-center custom-icon-wrap mb-3">
              <span class="custom-icon-inner mr-3"><span class="icon icon-graduation-cap"></span></span>
              <div><h3 class="m-0">22,931 Yearly Graduates</h3></div>
            </div>

            <div class="d-flex align-items-center custom-icon-wrap">
              <span class="custom-icon-inner mr-3"><span class="icon icon-university"></span></span>
              <div><h3 class="m-0">150 Universities Worldwide</h3></div>
            </div>

          </div>
        </div> -->

        <!-- <div class="row mb-5 align-items-center">
          <div class="col-lg-7 mb-5" data-aos="fade-up" data-aos-delay="100">
            <img src="images/undraw_teacher.svg" alt="Image" class="img-fluid">
          </div>
          <div class="col-lg-4 ml-auto" data-aos="fade-up" data-aos-delay="200">
            <h2 class="text-black mb-4">Education is life</h2>
            <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem maxime nam porro possimus fugiat quo molestiae illo.</p>

            <div class="d-flex align-items-center custom-icon-wrap mb-3">
              <span class="custom-icon-inner mr-3"><span class="icon icon-graduation-cap"></span></span>
              <div><h3 class="m-0">22,931 Yearly Graduates</h3></div>
            </div>

            <div class="d-flex align-items-center custom-icon-wrap">
              <span class="custom-icon-inner mr-3"><span class="icon icon-university"></span></span>
              <div><h3 class="m-0">150 Universities Worldwide</h3></div>
            </div>

          </div>
        </div> -->

      </div>
    </div>

    <div class="site-section" id="teachers-section">
      <div class="container">

        <div class="row mb-5 justify-content-center">
          <div class="col-lg-7 mb-5 text-center"  data-aos="fade-up" data-aos-delay="">
            <h2 class="section-title">Apply with</h2>
            <p class="mb-5">Choose the best combo for you</p>
          </div>
        </div>

        <div class="row">

          <div class="col-md-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="100">
            <div class="teacher text-center">
              <img src="images/donut_1280.png" alt="Image" class="img-fluid w-50 rounded-circle mx-auto mb-4">
              <div class="py-2">
                <h3 class="text-black">Donuts</h3>
                <p class="position">Rounded right?</p>
                <p>There's a hole there</p>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="200">
            <div class="teacher text-center">
              <img src="images/popcorn_1280.png" alt="Image" class="img-fluid w-50 rounded-circle mx-auto mb-4">
              <div class="py-2">
                <h3 class="text-black">Popcorn</h3>
                <p class="position">Comes from corn</p>
                <p>Never enough of them...</p>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="300">
            <div class="teacher text-center">
              <img src="images/soda_1280.png" alt="Image" class="img-fluid w-50 rounded-circle mx-auto mb-4">
              <div class="py-2">
                <h3 class="text-black">Soda</h3>
                <p class="position">Always being 'cool'</p>
                <p>Choose your flavour</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section bg-image overlay" style="background-image: url('images/cloud-background.jpg');">
      <div class="container">
        <div class="row justify-content-center align-items-center">
          <div class="col-md-8 text-center testimony">
            <img src="images/captain_1280.jpg" alt="Image" class="img-fluid w-25 mb-4 rounded-circle">
            <h3 class="mb-4">Captain America</h3>
            <blockquote>
              <p>&ldquo; Hi, there. As you know I'm super cool and strong, so please listen to me. &rdquo;</p>
            </blockquote>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section pb-0">

      <!-- <div class="future-blobs">
        <div class="blob_2">
          <img src="images/blob_2.svg" alt="Image">
        </div>
        <div class="blob_1">
          <img src="images/blob_1.svg" alt="Image">
        </div>
      </div> -->
      <!-- <div class="container">
        <div class="row mb-5 justify-content-center" data-aos="fade-up" data-aos-delay="">
          <div class="col-lg-7 text-center">
            <h2 class="section-title">Why Choose Me</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4 ml-auto align-self-start"  data-aos="fade-up" data-aos-delay="100">

            <div class="p-4 rounded bg-white why-choose-us-box">

              <div class="d-flex align-items-center custom-icon-wrap custom-icon-light mb-3">
                <div class="mr-3"><span class="custom-icon-inner"><span class="icon icon-balance-scale"></span></span></div>
                <div><h3 class="m-0">Graduated in the top of the class</h3></div>
              </div>

              <div class="d-flex align-items-center custom-icon-wrap custom-icon-light mb-3">
                <div class="mr-3"><span class="custom-icon-inner"><span class="icon icon-university"></span></span></div>
                <div><h3 class="m-0">150 Universities Worldwide</h3></div>
              </div>

              <div class="d-flex align-items-center custom-icon-wrap custom-icon-light mb-3">
                <div class="mr-3"><span class="custom-icon-inner"><span class="icon icon-graduation-cap"></span></span></div>
                <div><h3 class="m-0">Top Professionals in The World</h3></div>
              </div>

              <div class="d-flex align-items-center custom-icon-wrap custom-icon-light mb-3">
                <div class="mr-3"><span class="custom-icon-inner"><span class="icon icon-university"></span></span></div>
                <div><h3 class="m-0">Expand Your Knowledge</h3></div>
              </div>

              <div class="d-flex align-items-center custom-icon-wrap custom-icon-light mb-3">
                <div class="mr-3"><span class="custom-icon-inner"><span class="icon icon-graduation-cap"></span></span></div>
                <div><h3 class="m-0">Best Online Teaching Assistant Courses</h3></div>
              </div>

              <div class="d-flex align-items-center custom-icon-wrap custom-icon-light">
                <div class="mr-3"><span class="custom-icon-inner"><span class="icon icon-university"></span></span></div>
                <div><h3 class="m-0">Best Teachers</h3></div>
              </div>

            </div>


          </div>
          <div class="col-lg-7 align-self-end"  data-aos="fade-left" data-aos-delay="200">
            <img src="images/person_transparent.png" alt="Image" class="img-fluid">
          </div>
        </div>
      </div>
    </div> -->

    


<?php if(!isset($_SESSION['logged']) && empty($_SESSION['logged'])){
      if(!isset($_GET['reset_password'])){
        echo '<div class="site-section bg-light" id="contact-section">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-md-7">            
              <h2 class="section-title mb-3">Register as Super Hero</h2>
              <form method="post" action="register.php" data-aos="fade" id="formRegister">
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
                
                  <!-- <div class="form-group row">
                    <div class="col-md-12">
                      <textarea class="form-control" cols="30" rows="10" placeholder="Register and send me a message..." id="textarea" name="textarea" disabled></textarea>
                    </div>
                  </div>     -->         
                

                <div class="form-group row">
                  <div class="col-md-6">                  
                    <input type="submit" class="btn btn-primary py-3 px-5 btn-block btn-pill" value="Register">
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
              <form method="post" action="reset_password.php" data-aos="fade" id="formRegister">
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
    }else{
    //echo 'Logged'; //only the message part here, and pass the data for the user automatically
     echo '<div class="site-section bg-light" id="contact-section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-7" id="message-section">            
            <h2 class="section-title mb-3">Send me(you in mailtrap.io) a message</h2>          
            <form method="post" action="sendEmail.php" data-aos="fade" id="sendEmail">
              <h5 id="message_info" style="color:red; font-weight: bold"></h5>              
              <div class="form-group row">
                <div class="col-md-12">
                  <input type="text" class="form-control" placeholder="Subject" id="subject" name="subject" required>
                </div>
              </div>              
              <div class="form-group row">
                <div class="col-md-12">
                  <textarea class="form-control" cols="30" rows="10" placeholder="Write your message here..." id="textarea" name="textarea" required></textarea>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-6">                  
                  <input type="submit" class="btn btn-primary py-3 px-5 btn-block btn-pill" value="Send Message">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>';
      }
?>    
     
    <footer class="footer-section bg-white">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <h3>About Fun Stuff</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro consectetur ut hic ipsum et veritatis corrupti. Itaque eius soluta optio dolorum temporibus in, atque, quos fugit sunt sit quaerat dicta.</p>
          </div>

          <div class="col-md-3 ml-auto">
            <h3>Links</h3>
            <ul class="list-unstyled footer-links">
               <li><a href="#home-section" class="nav-link">Home</a></li>
                <li><a href="#courses-section" class="nav-link">Characters</a></li>
                <li><a href="#programs-section" class="nav-link">Why cartoon?</a></li>
                <li><a href="#teachers-section" class="nav-link">Top Heroes</a></li>
            </ul>
          </div>

          <div class="col-md-4">
            <h3>Subscribe</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt incidunt iure iusto architecto? Numquam, natus?</p>
            <form action="#" class="footer-subscribe">
              <div class="d-flex mb-5">
                <input type="text" class="form-control rounded-0" placeholder="Email">
                <input type="submit" class="btn btn-primary rounded-0" value="Subscribe">
              </div>
            </form>
          </div>

        </div>

        <div class="row pt-5 mt-5 text-center">
          <div class="col-md-12">
            <div class="border-top pt-5">
            <p>
        Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved |Web Dev <i class="icon-heart" aria-hidden="true"></i> by <a href="https://be-nerd.com" target="_blank" >Nerd Co</a>
      </p>
            </div>
          </div>          
        </div>
      </div>
    </footer>

  
    
  </div> <!-- .site-wrap -->

  <script src="js/jquery-3.5.0.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/jquery.countdown.min.js"></script>
  <script src="js/bootstrap-datepicker.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.fancybox.min.js"></script>
  <script src="js/jquery.sticky.js"></script>

  
  <script src="js/main.js"></script>

  <!-- Include google-jquery cdn and custom js functions -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="customJS/functions.js"></script>

  <script>
    $(document).ready(function(){
      var error = '<?php echo $error; ?>';  // get the $_GET param if failed login
      var password_changed = '<?php echo $password_changed; ?>';

   
      //add the text to the empty input-field for the error message
      if(error || error.length !== 0 ){
        if(error == 'There is a registration with that email'){
          $('#register_info').text(error);  
        }else if(error == 'Message sent'){
          //message info when mail is send
          $('#message_info').text(error);
          sessionStorage.removeItem('subject', 'textarea');
          sessionStorage.removeItem('textarea');
        }else if(error == 'Successfully logged out'){
          sessionStorage.clear();
        }else{
          //user has error for access/sign via the form
          $('#login_info').text(error);
        }        
      }

      if(password_changed == 'success'){
        $('#pass_reset').css('display', 'block');
      }


      var email_login_session = (sessionStorage.getItem('email_login') != 'undefined') ? sessionStorage.getItem('email_login') : '';  
      var firstName_session = (sessionStorage.getItem('firstName') != 'undefined') ? sessionStorage.getItem('firstName') : '';  
      var lastName_session = (sessionStorage.getItem('lastName') != 'undefined') ? sessionStorage.getItem('lastName') : '';  
      var subject_session = (sessionStorage.getItem('subject') != 'undefined') ? sessionStorage.getItem('subject') : '';
      var email_session = (sessionStorage.getItem('email_reg') != 'undefined') ? sessionStorage.getItem('email_reg') : '';
      var textarea_session = (sessionStorage.getItem('textarea') != 'undefined') ? sessionStorage.getItem('textarea') : '';

      //Retype the 2-forms-fields with the sessionStorage      
        $('#email_login').val(email_login_session);
        $('#firstName').val(firstName_session);
        $('#lastName').val(lastName_session);
        $('#subject').val(subject_session);
        $('#email_reg').val(email_session);
        $('#textarea').text(textarea_session);
          // var textarea = $('#textarea').val();
          // textarea != '' || textarea != undefined ? $('#textarea').text(textarea_session) : '' ;
          

    
      //save the send-email-field-data for the session on input-change
      $('#email_login, #firstName, #lastName, #subject, #email_reg, #textarea').on('change', function(){
        sessionStorage.setItem('email_login', $('#email_login').val());
        sessionStorage.setItem('firstName', $('#firstName').val());
        sessionStorage.setItem('lastName', $('#lastName').val());
        sessionStorage.setItem('subject', $('#subject').val());
        sessionStorage.setItem('email_reg', $('#email_reg').val());
        sessionStorage.setItem('textarea', $('#textarea').val());        
      });

      //Password vs repassword
      $('#password_reg, #repassword').on('keyup', function () {
        if ($('#password_reg').val() == $('#repassword').val()) {
          $('#message').html('').css('color', 'red');          
        } else 
          // $('#message').show();
          $('#message').html('Passwords don"t match').css('color', 'red');
      });

    });//document ready
  </script>
    
  </body>
</html>