<?php
session_start();
include_once("site-settings.php");

//reading blocked ips
$isblocked=mysql_num_rows(mysql_query("SELECT * FROM `blockedips` WHERE ip='$ip'"));
if($isblocked>0){header("location:error.php");}

//checking whether loggedin or not
$isloggedin=false;
$stuid="";
if(isloggedin())
{
$stuid=trim($_SESSION['stuid']);
$isloggedin=true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $title;?></title>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="Cygnus_files/style.css" rel="stylesheet">
    <link href="Cygnus_files/soon.min.css" rel="stylesheet"> 
    <link href="Cygnus_files/vscroller.css" rel="stylesheet"> 
    <link href="Cygnus_files/team.css" rel="stylesheet"> 
    <link href="Cygnus_files/icons.css" rel="stylesheet">    
    <link href="Cygnus_files/animate.css" rel="stylesheet"> 
    <link href="Cygnus_files/bubble.css" rel="stylesheet">
        <script src="Cygnus_files/wow.min.js"></script>        
<script>
        new WOW().init();
     </script>
</head>
  <body cz-shortcut-listen="true">
    <div class="wrapper-line">
      <div class="line"></div>
      <div class="line"></div>
      <div class="line"></div>
      <div class="line"></div>
      <div class="line"></div>
      <div class="line"></div>
      <div class="line"></div>
      <div class="line"></div>
      <div class="line"></div>
    </div>
    <div class="object-left">
      <ul class="list-inline" style="text-transform: lowercase;font-size: 13px;">
        <li>Phone : <?php echo $contact_dis;?></li>
        <li>Email : <a href="mailto:<?php echo $email_dis;?>"><?php echo $email_dis;?></a></li>
        <li>Website : <a href="https://<?php echo $web_dis;?>"><?php echo $web_dis;?></a></li>
      </ul>
    </div>
    <div class="object-right">
      <ul class="list-inline">
        <li><a href="index.php">SmartQuint</a></li>
      </ul>
    </div>
    <?php
    $today=date('m-d-Y');
    $w=mysql_query("SELECT * FROM notifications where added_date='$today'");
    $count=mysql_num_rows($w);
    ?>
    <nav class="wrapper-nav wow slideInDown" style="visibility: visible; animation-name: slideInDown;">
      <div class="container">
        <div class="nav-primary"><a class="logo" href="index.php" title="<?php echo $title;?>"><img src="Cygnus_files/logo.png" alt="<?php echo $title;?>"></a>
          <ul class="list-inline nav-desktop">
            <li><a href="index.php" title="Homepage">Home</a></li>
            <li><a href="about.php" title="About">About</a></li>
            <li><a href="index.php#events" title="Events">Events</a></li>
            <li><a href="gallery.php" title="Gallery">Gallery</a></li>
            <li><a href="notifications.php" title="Notifications">Notifications <?php if($count>0){?><span class="badge badge-warning"><?php echo $count; }else{ ?><?php }?></span></a></li>
            <li  class="active"><a href="team.php" title="Team">Team</a></li>
            <li><a href="contact.php" title="Contact">Contact</a></li>
          </ul>
         <?php if(!isloggedin()){
          ?>
          <a class="btn btn-primary btn-contact" href="reglogin.php" title="Register / Login" style="margin-left:10px;">Register / Login</a>
          <?php } else { ?>
          <a class="btn btn-primary btn-contact" href="profile.php" title="Profile/Logout" style="margin-left:10px;">Profile/Logout</a>
          <?php } ?>
          <span class="btn btn-primary menu">Menu</span>
          <ul class="nav-responsive">
            <li class="nav-close"><i class="fa fa-times"></i>Close Menu</li>
            <li><a href="index.php" title="Homepage">Home</a></li>
            <li><a href="about.php" title="About">About</a></li>
            <li><a href="index.php#events" title="Events">Events</a></li>
            <li><a href="gallery.php" title="Gallery">Gallery</a></li>
             <li><a href="notifications.php" title="Notifications">Notifications <?php if($count>0){?><span class="badge badge-warning"><?php echo $count; }else{ ?><?php }?></span></a></li>
            <li class="active"><a href="team.php" title="Organisers">Team</a></li>
            <li><a href="contact.php" title="Contact">Contact</a></li>
           <?php if(!isloggedin()){
          ?> <li><a href="reglogin.php" title="Register / Login">Register / Login</a></li>
           <?php } else { ?>
          <li><a href="profile.php" title="Profile/Logout">Profile/Logout</a></li>
          <?php } ?>
          </ul>
        </div>
      </div>
    </nav>


      <div class="container">
        <div class="row">
        <span class="text-box wow slideInDown" style="z-index:-1;font-size:18px;margin-top:8%;margin-left:35%;color: khaki;font-family:'hk_grotesk';visibility: visible; animation-name: slideInDown;">Cygnus2K18 Team</span>
            </div>
  <canvas id="myCanvas"></canvas>
            <div class="row" style="margin-top:8%">
              <div class="col-md-3">
              </div>
        <div class="col-md-6 col-sm-6 wow bounceIn animated">
            <div class="our-team">
                <div class="pic">
                    <ul class="social">
                        <li><a href="#" class="fa fa-facebook"></a></li>
                        <li><a href="#" class="fa fa-twitter"></a></li>
                        <li><a href="#" class="fa fa-linkedin"></a></li>                        
                    </ul>
                    <img src="Cygnus_files/chandu.png">
                </div>
                <h3 class="title">Mr.Chandrasekhar</h3>
                <span class="post">Convener</span>
                <span class="post1">Phone : 7207301718</span>
            </div>
        </div>
</div>

<div class="row">
	<div class="col-md-3">
              </div>
        <div class="col-md-6 col-sm-6 wow bounceIn animated">
            <div class="our-team">
                <div class="pic">
                    <ul class="social">
                        <li><a href="#" class="fa fa-facebook"></a></li>
                        <li><a href="#" class="fa fa-twitter"></a></li>
                        <li><a href="mailto:deepchand@technus.in" class="fa fa-envelope-o"></a></li>                        
                    </ul>
                    <img src="Cygnus_files/deepchand.jpg">
                </div>
                <h3 class="title">Deepchand Thati</h3>
                <span class="post">Overall Co-Ordinator</span>
                <span class="post1">Phone : 9553590514</span>
                
            </div>
        </div>      
</div>
<h3 class="my title text-center">Managers</h3>
<div class="row">
	<div class="col-md-3 col-sm-6wow fadeInLeft animated">
            <div class="our-team">
                <div class="pic">
                    <ul class="social">
                        <li><a href="#" class="fa fa-facebook"></a></li>
                        <li><a href="#" class="fa fa-twitter"></a></li>
                        <li><a href="#" class="fa fa-linkedin"></a></li>
                    </ul>
                    <img src="Cygnus_files/logo.png">
                </div>
                <h3 class="title">V Pothana Kavya</h3>
                <span class="post">Marketing Manager</span>
                <span class="post1">Phone : </span>
            </div>
        </div>
        <div class="col-md-3 col-sm-6wow fadeInLeft animated">
            <div class="our-team">
                <div class="pic">
                    <ul class="social">
                        <li><a href="#" class="fa fa-facebook"></a></li>
                        <li><a href="#" class="fa fa-twitter"></a></li>
                        <li><a href="#" class="fa fa-linkedin"></a></li>
                    </ul>
                    <img src="Cygnus_files/logo.png">
                </div>
                <h3 class="title">Bhaskar VJ</h3>
                <span class="post">Media & Publicity Manager</span>
                <span class="post1">Phone : 8125348972</span>
            </div>
        </div>
        <div class="col-md-3 col-sm-6wow fadeInLeft animated">
            <div class="our-team">
                <div class="pic">
                    <ul class="social">
                        <li><a href="#" class="fa fa-facebook"></a></li>
                        <li><a href="#" class="fa fa-twitter"></a></li>
                        <li><a href="#" class="fa fa-linkedin"></a></li>
                    </ul>
                    <img src="Cygnus_files/logo.png">
                </div>
                <h3 class="title">Haranadh NVK</h3>
                <span class="post">Media & Publicity Manager</span>
                <span class="post1">Phone : 9493057850</span>
            </div>
        </div>
 <div class="col-md-3 col-sm-6 wow fadeInRight animated">
            <div class="our-team">
                <div class="pic">
                    <ul class="social">
                        <li><a href="#" class="fa fa-facebook"></a></li>
                        <li><a href="#" class="fa fa-twitter"></a></li>
                        <li><a href="#" class="fa fa-linkedin"></a></li>
                    </ul>
                    <img src="Cygnus_files/vineel.jpg">
                </div>
                <h3 class="title">Koka Vineel</h3>
                <span class="post">Finance & Logistics Manager</span>
                <span class="post1">Phone : </span>
            </div>
        </div>
     	<div class="col-md-3 col-sm-6 wow bounceIn animated">
            <div class="our-team">
                <div class="pic">
                    <ul class="social">
                        <li><a href="#" class="fa fa-facebook"></a></li>
                        <li><a href="#" class="fa fa-twitter"></a></li>
                        <li><a href="#" class="fa fa-linkedin"></a></li>
                    </ul>
                    <img src="Cygnus_files/johny.JPG">
                </div>
                <h3 class="title">Janibasha Shaik</h3>
                <span class="post">Events Manager</span>
                <span class="post1">Phone : 9640586473</span>
            </div>
        </div>


        <div class="col-md-3 col-sm-6 wow fadeInRight animated">
            <div class="our-team">
                <div class="pic">
                    <ul class="social">
                        <li><a href="#" class="fa fa-facebook"></a></li>
                        <li><a href="#" class="fa fa-twitter"></a></li>
                        <li><a href="#" class="fa fa-linkedin"></a></li>
                    </ul>
                    <img src="Cygnus_files/logo.png">
                </div>
                <h3 class="title">Samuel K</h3>
                <span class="post">Event Manager</span>
                <span class="post1">Phone : 9701824446</span>
            </div>
        </div>


        <div class="col-md-3 col-sm-6 wow fadeInRight animated">
            <div class="our-team">
                <div class="pic">
                    <ul class="social">
                        <li><a href="#" class="fa fa-facebook"></a></li>
                        <li><a href="#" class="fa fa-twitter"></a></li>
                        <li><a href="#" class="fa fa-linkedin"></a></li>
                    </ul>
                    <img src="Cygnus_files/logo.png">
                </div>
                <h3 class="title">Lovakumari CH</h3>
                <span class="post">Event Manager</span>
                <span class="post1">Phone : </span>
            </div>
        </div>


        <div class="col-md-3 col-sm-6 wow fadeInRight animated">
            <div class="our-team">
                <div class="pic">
                    <ul class="social">
                        <li><a href="#" class="fa fa-facebook"></a></li>
                        <li><a href="#" class="fa fa-twitter"></a></li>
                        <li><a href="#" class="fa fa-linkedin"></a></li>
                    </ul>
                    <img src="Cygnus_files/logo.png">
                </div>
                <h3 class="title">Bhavani K</h3>
                <span class="post">Event Manager</span>
                <span class="post1">Phone : 9492581017</span>
            </div>
        </div>


        <div class="col-md-3 col-sm-6 wow fadeInRight animated">
            <div class="our-team">
                <div class="pic">
                    <ul class="social">
                        <li><a href="#" class="fa fa-facebook"></a></li>
                        <li><a href="#" class="fa fa-twitter"></a></li>
                        <li><a href="#" class="fa fa-linkedin"></a></li>
                    </ul>
                    <img src="Cygnus_files/logo.png">
                </div>
                <h3 class="title">Pradeep Kumar</h3>
                <span class="post">Event Manager</span>
                <span class="post1">Phone : 9133725636</span>
            </div>
        </div>


       
 <div class="col-md-3 col-sm-6 wow fadeInRight animated">
            <div class="our-team">
                <div class="pic">
                    <ul class="social">
                        <li><a href="#" class="fa fa-facebook"></a></li>
                        <li><a href="#" class="fa fa-twitter"></a></li>
                        <li><a href="#" class="fa fa-linkedin"></a></li>
                    </ul>
                    <img src="Cygnus_files/prasad.jpg">
                </div>
                <h3 class="title">Prasad Reddy Dasari</h3>
                <span class="post">Infrastructure Manager</span>
                <span class="post1">Phone : 9618276013</span>
            </div>
        </div>

   <div class="col-md-3 col-sm-6 wow fadeInLeft animated">
            <div class="our-team">
                <div class="pic">
                    <ul class="social">
                        <li><a href="#" class="fa fa-facebook"></a></li>
                        <li><a href="#" class="fa fa-twitter"></a></li>
                        <li><a href="#" class="fa fa-linkedin"></a></li>
                    </ul>
                    <img src="Cygnus_files/logo.png">
                </div>
                <h3 class="title">Sivakumari U</h3>
                <span class="post">Infrastructure Manager</span>
                <span class="post1">Phone : </span>
            </div>
        </div>
        
        <div class="col-md-3 col-sm-6 wow fadeInRight animated">
            <div class="our-team">
                <div class="pic">
                    <ul class="social">
                        <li><a href="#" class="fa fa-facebook"></a></li>
                        <li><a href="#" class="fa fa-twitter"></a></li>
                        <li><a href="#" class="fa fa-linkedin"></a></li>
                    </ul>
                    <img src="Cygnus_files/logo.png">
                </div>
                <h3 class="title">Sumanth</h3>
                <span class="post">Hospitality Manager</span>
                <span class="post1">Phone : </span>
            </div>
        </div>

   <div class="col-md-3 col-sm-6 wow fadeInLeft animated">
            <div class="our-team">
                <div class="pic">
                    <ul class="social">
                        <li><a href="#" class="fa fa-facebook"></a></li>
                        <li><a href="#" class="fa fa-twitter"></a></li>
                        <li><a href="#" class="fa fa-linkedin"></a></li>
                    </ul>
                    <img src="Cygnus_files/logo.png">
                </div>
                <h3 class="title">NagaLakshmi P</h3>
                <span class="post">Hospitality Manager</span>
                <span class="post1">Phone : </span>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 wow fadeInRight animated">
            <div class="our-team">
                <div class="pic">
                    <ul class="social">
                        <li><a href="#" class="fa fa-facebook"></a></li>
                        <li><a href="#" class="fa fa-twitter"></a></li>
                        <li><a href="#" class="fa fa-linkedin"></a></li>
                    </ul>
                    <img src="Cygnus_files/logo.png">
                </div>
                <h3 class="title">Pavan Koru</h3>
                <span class="post">Food & Beverages Manager</span>
                <span class="post1">Phone : 7799116424</span>
            </div>
        </div>

        <div class="col-md-3 col-sm-6wow fadeInLeft animated">
            <div class="our-team">
                <div class="pic">
                    <ul class="social">
                        <li><a href="#" class="fa fa-facebook"></a></li>
                        <li><a href="#" class="fa fa-twitter"></a></li>
                        <li><a href="#" class="fa fa-linkedin"></a></li>
                    </ul>
                    <img src="Cygnus_files/logo.png">
                </div>
                <h3 class="title">Mangatayaru</h3>
                <span class="post">Food & Beverages Manager</span>
                <span class="post1">Phone : </span>
            </div>
        </div>
       
        <div class="col-md-3 col-sm-6 wow fadeInRight animated">
            <div class="our-team">
                <div class="pic">
                    <ul class="social">
                        <li><a href="#" class="fa fa-facebook"></a></li>
                        <li><a href="#" class="fa fa-twitter"></a></li>
                        <li><a href="#" class="fa fa-linkedin"></a></li>
                    </ul>
                    <img src="Cygnus_files/surya.jpg">
                </div>
                <h3 class="title">Surya Deepak P</h3>
                <span class="post">Web & Design Manager</span>
                <span class="post1">Phone : 9705736759</span>
            </div>
        </div>

        
</div>
<h3 class="my title text-center">Webteam</h3>
<div class="row">
        <div class="col-md-3 col-sm-6 wow fadeInLeft animated">
            <div class="our-team">
                <div class="pic">
                    <ul class="social">
                        <li><a href="https://www.facebook.com/prathappuppala1" class="fa fa-facebook"></a></li>
                        <li><a href="https://www.twitter.com/prathappuppala1" class="fa fa-twitter"></a></li>
                        <li><a href="https://www.linkedin.com/in/prathappuppala" class="fa fa-linkedin"></a></li>
                    </ul>
                    <img src="Cygnus_files/prathap.jpg">
                </div>
                <h3 class="title">Prathap Puppala</h3>
                <span class="post">CEO-SmartQuint</span>
                <span class="post1">prathap@smartquint.com</span>
                </div>
        </div>

        <div class="col-md-3 col-sm-6 wow fadeInRight animated">
            <div class="our-team">
                <div class="pic">
                    <ul class="social">
                        <li><a href="https://www.facebook.com/Kiranbabu.Muddam.Coder" class="fa fa-facebook"></a></li>
                        <li><a href="https://twitter.com/Kiran_Geek" class="fa fa-twitter"></a></li>
                        <li><a href="https://in.linkedin.com/in/kiranbabu-muddam" class="fa fa-linkedin"></a></li>
                    </ul>
                    <img src="Cygnus_files/kiran.jpg">
                </div>
                <h3 class="title">Kiranbabu Muddam</h3>
                <span class="post">CTO-SmartQuint</span>
                <span class="post1">Phone : 9398584586</span>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 wow fadeInLeft animated">
            <div class="our-team">
                <div class="pic">
                    <ul class="social">
                        <li><a href="#" class="fa fa-facebook"></a></li>
                        <li><a href="#" class="fa fa-twitter"></a></li>
                        <li><a href="#" class="fa fa-linkedin"></a></li>
                    </ul>
                    <img src="Cygnus_files/siva.jpg">
                </div>
                <h3 class="title">Siva Nagaraju Gamidi</h3>
                <span class="post">Design Lead-SmartQuint</span>
                <span class="post1">Phone : 7095295375</span>
            </div>
        </div>
   <div class="col-md-3 col-sm-6 wow fadeInRight animated">
            <div class="our-team">
                <div class="pic">
                    <ul class="social">
                        <li><a href="#" class="fa fa-facebook"></a></li>
                        <li><a href="#" class="fa fa-twitter"></a></li>
                        <li><a href="#" class="fa fa-linkedin"></a></li>
                    </ul>
                    <img src="Cygnus_files/maneesh.jpg">
                </div>
                <h3 class="title">Maneeswar Mutyala</h3>
                <span class="post">Design Lead-SmartQuint</span>
                <span class="post1">Phone : 8790042337</span>
            </div>
        </div>

</div>



      </div>


    
   
   
    <footer class="wrapper-footer">
      <div class="container">
        <div class="row">
          <div class="col-md-5">
            <ul class="social list-inline">
                <li><a href="https://www.facebook.com/CygnusRGUKTN/" target="_blank" title="facebook"><img src="img/fb.png" width="20px"><span>/CygnusRGUKTN</span></a></li><li><a href="https://www.twitter.com/CygnusRGUKTN/" target="_blank" title="twitter"><img src="img/twitter.png" width="20px"><span>/CygnusRGUKTN</span></a></li>
            </ul>
          </div>
          <div class="col-md-2">
            <p class="copyright">© Copyright 2018</p>
          </div>
          <div class="col-md-5">
            <ul class="contact list-inline">
              <li>Phone <?php echo $contact_dis;?></li>
              <li><a href="mailto:<?php echo $email_dis;?>"><?php echo $email_dis;?></a></li>
            </ul>
          </div>
        </div>
      </div>
    </footer>
    <div class="cd-cover-layer"></div>
    <div class="cd-loading-bar"></div>
    
    <script src="Cygnus_files/jquery.min.js"></script>
    <script src="Cygnus_files/bootstrap.min.js"></script>
    <script src="Cygnus_files/jquery.matchHeight-min.js"></script>
    <script src="Cygnus_files/owl.carousel.min.js"></script>

    <script src="Cygnus_files/sketch.min.js"></script>
    <script src="Cygnus_files/jquery.easing.1.3.js"></script>
    <script src="Cygnus_files/jquery.parallax-scroll.js"></script>
    <script src="Cygnus_files/jquery.gradient.text.js"></script>
    <script src="Cygnus_files/soon.min.js"></script>
    <script src="Cygnus_files/vscroller.js"></script>
    <script src="Cygnus_files/bubbles.js"></script>
    <script src="Cygnus_files/script.js"></script>
</body></html>