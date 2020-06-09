<?php
session_start();

include_once 'customFunctions/config.php';

$character = $_GET['character'];
$character_avatar = $character.'_1280.png';
$logged = $_SESSION['logged'];

?>

<!-- header -->
<?php include 'includes/header.php'; ?>

          <div class="ml-auto w-25">
            <nav class="site-navigation position-relative text-right" role="navigation">
              <ul class="site-menu main-menu site-menu-dark js-clone-nav mr-auto d-none d-lg-block m-0 p-0">
                <?php if(!isset($logged)){
                   echo '<li class="cta"><a href="index.php#contact-section" class=""><span>Register</span></a></li>';
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

    <div class="intro-section single-cover" id="home-section">
      
      <div class="slide-1 " style="background-image: url('<?php echo $rootImgs;?>/cartoon-bg_1280.jpg');" data-stellar-background-ratio="0.5">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-12">
              <div class="row justify-content-center align-items-center text-center">
                <div class="col-lg-6">
                  <h1 data-aos="fade-up" data-aos-delay="0">Character Info/Name</h1>
                  <p data-aos="fade-up" data-aos-delay="100">He is a brave hero, maybe add name of the hero?</p>
                </div>                
              </div>
            </div>            
          </div>
        </div>
      </div>
    </div>
    
    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mb-5">

            <div class="mb-5">
              <h3 class="text-black">Character Description</h3>
              <p class="mb-4">
                <strong class="text-black mr-3">Super powers: </strong> Lorem ipsum dolor sit amet
              </p>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim eum iure voluptatum provident natus, deleniti alias corporis dolorem architecto eligendi consequatur, veniam ratione qui adipisci, doloremque aspernatur? Debitis, quia, praesentium.</p>
              <p>Molestias sit temporibus ullam voluptatem quibusdam. Accusamus labore perspiciatis similique veritatis ipsum iure quas. Nulla perspiciatis unde eveniet nihil, nesciunt repellat maxime ab libero minima voluptas dolore repudiandae adipisci. Cumque!</p>
              <p>Enim harum voluptatem, itaque in illum quas temporibus tempore sit tempora quam atque eveniet, non aspernatur dignissimos aliquid praesentium exercitationem delectus, maxime velit saepe! Qui asperiores iure reprehenderit ad voluptas!</p>
              <div class="row mb-4">
                <div class="col-md-6">
                  <img src="images/newspaper_1280.jpg" alt="Image" class="img-fluid rounded">
                </div>
                <div class="col-md-6">
                  <img src="images/placeholder_1280.png" alt="Image" class="img-fluid rounded">
                </div>
              </div>
              <p>Ipsam fuga fugiat vero repudiandae, tenetur a ullam, expedita perspiciatis dolores rem quibusdam numquam dicta sint unde repellat magni recusandae. Id, quibusdam, voluptatum. Amet mollitia ratione, illum animi quia ex?</p>
              <p>Sint aut repudiandae, in amet nemo. Nobis labore id iure molestias reprehenderit quisquam illo quod cum dolorum aspernatur ut sequi, facere beatae, porro cupiditate magnam laborum laudantium laboriosam ab autem!</p>

              <!-- <p class="mt-4"><a href="#" class="btn btn-primary">Admission</a></p> -->
            </div>

            <!-- <div class="pt-5">
              <h3 class="mb-5">6 Comments</h3>
              <ul class="comment-list">
                <li class="comment">
                  <div class="vcard bio">
                    <img src="images/person_1.jpg" alt="Image placeholder">
                  </div>
                  <div class="comment-body">
                    <h3>Jean Doe</h3>
                    <div class="meta">January 9, 2018 at 2:21pm</div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
                    <p><a href="#" class="reply">Reply</a></p>
                  </div>
                </li>

                <li class="comment">
                  <div class="vcard bio">
                    <img src="images/person_1.jpg" alt="Image placeholder">
                  </div>
                  <div class="comment-body">
                    <h3>Jean Doe</h3>
                    <div class="meta">January 9, 2018 at 2:21pm</div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
                    <p><a href="#" class="reply">Reply</a></p>
                  </div>

                  <ul class="children">
                    <li class="comment">
                      <div class="vcard bio">
                        <img src="images/person_1.jpg" alt="Image placeholder">
                      </div>
                      <div class="comment-body">
                        <h3>Jean Doe</h3>
                        <div class="meta">January 9, 2018 at 2:21pm</div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
                        <p><a href="#" class="reply">Reply</a></p>
                      </div> -->


                      <!-- <ul class="children">
                        <li class="comment">
                          <div class="vcard bio">
                            <img src="images/person_1.jpg" alt="Image placeholder">
                          </div>
                          <div class="comment-body">
                            <h3>Jean Doe</h3>
                            <div class="meta">January 9, 2018 at 2:21pm</div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
                            <p><a href="#" class="reply">Reply</a></p>
                          </div>

                            <ul class="children">
                              <li class="comment">
                                <div class="vcard bio">
                                  <img src="images/person_1.jpg" alt="Image placeholder">
                                </div>
                                <div class="comment-body">
                                  <h3>Jean Doe</h3>
                                  <div class="meta">January 9, 2018 at 2:21pm</div>
                                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
                                  <p><a href="#" class="reply">Reply</a></p>
                                </div>
                              </li>
                            </ul>
                        </li>
                      </ul>
                    </li>
                  </ul>
                </li>

                <li class="comment">
                  <div class="vcard bio">
                    <img src="images/person_1.jpg" alt="Image placeholder">
                  </div>
                  <div class="comment-body">
                    <h3>Jean Doe</h3>
                    <div class="meta">January 9, 2018 at 2:21pm</div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
                    <p><a href="#" class="reply">Reply</a></p>
                  </div>
                </li>
              </ul> -->
              <!-- END comment-list -->
              
              <!-- <div class="comment-form-wrap pt-5">
                <h3 class="mb-5">Leave a comment</h3>
                <form action="#" class="p-5 bg-light">
                  <div class="form-group">
                    <label for="name">Name *</label>
                    <input type="text" class="form-control" id="name">
                  </div>
                  <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" class="form-control" id="email">
                  </div>
                  <div class="form-group">
                    <label for="website">Website</label>
                    <input type="url" class="form-control" id="website">
                  </div>

                  <div class="form-group">
                    <label for="message">Message</label>
                    <textarea name="" id="message" cols="30" rows="10" class="form-control"></textarea>
                  </div>
                  <div class="form-group">
                    <input type="submit" value="Post Comment" class="btn btn-primary">
                  </div>

                </form>
              </div>
            </div> -->



          </div>
          <div class="col-lg-4 pl-lg-5">

            <div class="mb-5 text-center border rounded course-instructor">
              <h3 class="mb-5 text-black text-uppercase h6 border-bottom pb-3">Accent on the Hero</h3>
              <div class="mb-4 text-center">
                <img src="<?php echo $rootImgs.$character_avatar; ?>" alt="Image" class="w-25 rounded-circle mb-4">  
                <h3 class="h5 text-black mb-4">The <?php echo ucfirst($character); ?></h3>
                <p>Lorem ipsum dolor sit amet sectetur adipisicing elit. Ipsa porro expedita libero pariatur vero eos.</p>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

    <div class="site-section courses-title bg-dark" id="courses-section">
      <div class="container">
        <div class="row mb-5 justify-content-center">
          <div class="col-lg-7 text-center" data-aos="fade-up" data-aos-delay="">
            <h2 class="section-title">More Characters</h2>
          </div>
        </div>
      </div>
    </div>
    <div class="site-section courses-entry-wrap"  data-aos="fade" data-aos-delay="100">
      <div class="container">
        <div class="row">

          <div class="owl-carousel col-12 nonloop-block-14">

            <div class="course bg-white h-100 align-self-stretch">
              <figure class="m-0">
                <a href="course-single.php?character=bee"><img src="<?php echo $rootImgs;?>bee_1280.png" alt="Bee Image" class="img-fluid"></a>
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
                <a href="<?php echo $_SERVER['PHP_SELF']; ?>?character=businessman"><img src="<?php echo $rootImgs;?>businessman_1280.png" alt="Image" class="img-fluid"></a>
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
                <a href="<?php echo $_SERVER['PHP_SELF']; ?>?character=penguin"><img src="<?php echo $rootImgs; ?>penguin_1280.png" alt="Image" class="img-fluid"></a>
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
                <a href="<?php echo $_SERVER['PHP_SELF']; ?>?character=pirate"><img src="<?php echo $rootImgs; ?>pirate_1280.png" alt="Image" class="img-fluid"></a>
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
                <a href="<?php echo $_SERVER['PHP_SELF']; ?>?character=teacher"><img src="i<?php echo $rootImgs; ?>teacher_1280.png" alt="Image" class="img-fluid"></a>
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
                <a href="<?php echo $_SERVER['PHP_SELF']; ?>?character=turtle"><img src="<?php echo $rootImgs; ?>turtle_1280.png" alt="Image" class="img-fluid" height="335px"></a>
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
     
     <!-- footer -->
    <?php include 'includes/footer.php'; ?>
    
  </body>
</html>