<?php
session_start();

include_once 'customFunctions/config.php';
require_once 'classes/Database.class.php';

$character = $_GET['character'];
$character_avatar = $character.'_1280.png';
$logged = $_SESSION['logged'];

// Database Instance
$db = new Database();

// $user_exist_db = $db->selectUserFromDatabase($_SESSION['email']);
$all_users = $db->selectUsersAll();
$single_user = $db->selectUserByName($character);
// var_dump($single_user);

if(!$single_user){  
  header("Location: index.php");    
  exit();
}

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
                  <h1 data-aos="fade-up" data-aos-delay="0"><?php echo $single_user['firstName']; ?></h1>
                  <p data-aos="fade-up" data-aos-delay="100">User data goes here</p>
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
                <img src="<?php  echo ($single_user['image'] != '' && file_exists($single_user['image']) ? $single_user['image'] : 'images/profile.png'); ?>" alt="Image" class="w-25 rounded-circle mb-4">  
                <h3 class="h5 text-black mb-4">The <?php echo ucfirst($character); ?></h3>
                <p>Lorem ipsum dolor sit amet sectetur adipisicing elit. Ipsa porro expedita libero pariatur vero eos.</p>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
   
     
     <!-- footer -->
    <?php include 'includes/footer.php'; ?>
    
  </body>
</html>