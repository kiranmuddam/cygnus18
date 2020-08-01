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
if(!isset($_SESSION['visited'])){mysql_query("UPDATE visits SET visits950=visits950+1");$_SESSION['visited']="yes";}
$vis=mysql_fetch_array(mysql_query("SELECT * FROM visits"));
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $title;?></title>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="Cygnus_files/logo.png">
    <link href="Cygnus_files/style.css" rel="stylesheet">
    <link href="Cygnus_files/soon.min.css" rel="stylesheet"> 
    <link href="Cygnus_files/counter.css" rel="stylesheet"> 
    <link href="Cygnus_files/icons.css" rel="stylesheet"> 
    <link href="Cygnus_files/vscroller.css" rel="stylesheet"> 

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
    $w=mysql_query("SELECT * FROM notifications where added_date='$today' and visibility=1");
    $count=mysql_num_rows($w);
    ?>
    <nav class="wrapper-nav wow slideInDown" style="visibility: visible; animation-name: slideInDown;">
      <div class="container">
        <div class="nav-primary"><a class="logo" href="index.php" title="<?php echo $title;?>"><img src="Cygnus_files/logo.png" alt="<?php echo $title;?>"></a>
          <ul class="list-inline nav-desktop">
            <li class="active"><a href="index.php" title="Homepage">Home</a></li>
            <li><a href="about.php" title="About">About</a></li>
            <li><a href="index.php#events" title="Events">Events</a></li>
            <li><a href="gallery.php" title="Gallery">Gallery</a></li>
            <li><a href="notifications.php" title="Notifications">Notifications <?php if($count>0){?><span class="badge badge-warning"><?php echo $count; }else{ ?><?php }?></span></a></li>
            <li><a href="team.php" title="Team">Team</a></li>
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
            <li class="active"><a href="index.php" title="Homepage">Home</a></li>
            <li><a href="about.php" title="About">About</a></li>
            <li><a href="index.php#events" title="Events">Events</a></li>
            <li><a href="gallery.php" title="Gallery">Gallery</a></li>
            <li><a href="notifications.php" title="Notifications">Notifications <span class="badge badge-warning"><?php echo $count ?></span></a></li>
            <li><a href="team.php" title="Organisers">Team</a></li>
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
    <section class="wrapper-hero wow fadeIn animated" id="hero"> <img class="logo-ideabranch" style="z-index:-1;" id="logoideabranch" src="Cygnus_files/logo.png" width="100%" alt="<?php echo $title;?>" style="visibility: visible; animation-name: logo;">

      <div class="container">
        <div class="row">
        <span class="text-box wow slideInDown" style="z-index:-1;font-size:18px;margin-top:5.5%;margin-left:23%;color: khaki;font-family:'hk_grotesk';z-index:-1;visibility: visible; animation-name: slideInDown;"><img src="img/logo.png" width="50px" height="50px" />Rajiv Gandhi University of Knowledge Technologies - Nuzvid</span>
        <div class="wow slideInRight col-md-3" style="position: absolute;z-index:-1;right:5%;top:26%;visibility: visible; animation-name: slideInRight;" id="hiddenmobile">

 <div class="text-box" style="margin-top:20%;visibility: visible; animation-name: slideInRight;">
              <h4>Register..Participate..Enjoy</h4>
              <p>Come and support our young bands, groups, solo singers, musicians, djs,mes and comedians at this three day event.</p><a class="btn btn-primary" href="index.php#events" title="">about us</a>
              <!--<video src="cygnus-promo.mp4" style="margin-right:20%;width:120%;" autoplay="">-->
            </div>
 

    </div>
</div>

<!--<div class="wow slideInRight" style="position: absolute;z-index:-1;right:5%;top:26%;visibility: visible; animation-name: slideInRight;" id="hiddenmobile">

 <div class="text-box wow slideInLeft" style="margin-top: 0%;visibility: visible; animation-name: slideInRight;">
              <h4>Come..Support..Enjoy</h4>
              <p>Come and support our young bands, groups, solo singers, musicians, djs,mes and comedians at this three day event.</p><a class="btn btn-primary" href="index.php#events" title="">about us</a>
            </div><br><br><br><br><br><br><br><hr>
 <div class="news-wrapper" id="vscroller">

    </div>
</div>-->
 <style type="text/css">
    /*@import url(http://fonts.googleapis.com/css?family=Comfortaa);*/
    #my-soon-watch-red {background-color:;}
    #my-soon-watch-red .soon-reflection {background-color:#030303;background-image:linear-gradient(#030303 25%,rgba(3,3,3,0));}
    #my-soon-watch-red {color:#ffffff;}
    #my-soon-watch-red .soon-label {color:#ffffff;color:rgba(255,255,255,0.75);}
    #my-soon-watch-red {font-family:"Comfortaa",sans-serif;}
    #my-soon-watch-red .soon-ring-progress {background-color:#410918;}
    #my-soon-watch-red .soon-ring-progress {border-top-width:14px;}
    #my-soon-watch-red .soon-ring-progress {border-bottom-width:13px;}
    
      @media only screen and (max-width: 500px) {
      #hiddenmobile{display: none;}
}
    }
</style><!--
<hr>-->
          <div class="col-md-3 wow slideInLeft" style="position:absolute;top:40%;">
<center>Starts In</center>
<div class="soon" id="my-soon-watch-red" style="width:100%;" 
     data-layout="group tight label-uppercase label-small"
     data-format="d,h,m,s"
     data-face="slot"
     data-padding="false"
     data-visual="ring cap-round invert progressgradient-fb1a1b_fc1eda ring-width-custom align-center gap-0">
</div>
<center>Web Partner</center>
<center><img src="img/smartquint.png" width="60%" onclick="window.location='https://www.smartquint.com/';"></center>

          </div>

          <!--div class="col-md-3" style="position:absolute;right:100px;top:65%;">
            <div class="text-box wow slideInLeft" style="z-index:-1;visibility: visible; animation-name: slideInLeft;">
              <<h4>Welcome to CYGNUS2K18</h4>
              <p>Cygnus2K18 is an Annual cultural extravaganza of IIIT Nuzvid. During the three-day event, students going to present a harmonious ensemble of the epic that sculpted morals and rich legacy of Indian traditions</p><a class="btn btn-primary" href="about.php" title="About">about us</a>
            <style type="text/css">
    #my-soon-watch-red {background-color:#030303;}
    #my-soon-watch-red .soon-reflection {background-color:#030303;background-image:linear-gradient(#030303 25%,rgba(3,3,3,0));}
    #my-soon-watch-red {color:#ffffff;}
    #my-soon-watch-red .soon-label {color:#ffffff;color:rgba(255,255,255,0.75);}
    #my-soon-watch-red {font-family:"Comfortaa",sans-serif;}
    #my-soon-watch-red .soon-ring-progress {background-color:#410918;}
    #my-soon-watch-red .soon-ring-progress {border-top-width:14px;}
    #my-soon-watch-red .soon-ring-progress {border-bottom-width:13px;}
    
      @media only screen and (max-width: 500px) {
      #hiddenmobile{display: none;}
}
    }
</style>
<hr>>
<center>Starts In</center>
<div class="soon" id="my-soon-watch-red" style="width:100%;" 
     data-layout="group tight label-uppercase label-small"
     data-format="d,h,m,s"
     data-face="slot"
     data-padding="false"
     data-visual="ring cap-round invert progressgradient-fb1a1b_fc1eda ring-width-custom align-center gap-0">
</div>
<center>Web Partner</center>
<center><img src="img/smartquint.png" width="60%" onclick="window.location='https://www.smartquint.com/';"></center>

          </div-->

        </div>
      </div>

      <footer class="footer">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <ul class="social list-inline wow slideInUp" style="visibility: visible; animation-name: slideInUp;">
                <li><a href="https://www.facebook.com/CygnusRGUKTN/" target="_blank" title="facebook"><img src="img/fb.png" width="20px"><span>/CygnusRGUKTN</span></a></li><li><a href="https://www.youtube.com/channel/UCoQQiY3PggymOcRY_YOOTig" target="_blank" title="twitter"><img src="http://10.11.3.55/tz/assets/img/social/youtube.png" width="20px"><span>/CygnusRGUKTN</span></a></li>
              </ul>
            </div>
            <div class="col-md-6">
              <ul class="list-inline text-right wow slideInUp" style="visibility: visible; animation-name: slideInUp;">
                <!--<li>Phone <?php echo $contact_dis;?></li>-->
                <li><?php echo $email_dis;?></li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
      <div class="scroll"></div>
    <!--<canvas class=" sketch" height="auto" width="1366" style="z-index: -9999999999"></canvas>-->
    </section>
    <section class="section wrapper-service bg-service" id="events">
      <div class="container">
        <div class="row">
        <?php
        $eve=mysql_query("SELECT * FROM events where visibility=1");
        while($eve_fet=mysql_fetch_array($eve)){
          ?>
          <a href="register.php?<?php echo $eve_fet['eid'];?>"><div class="col-md-3" >
          <div class="owl-item" style="width:280px;"><div class="item wow slideInUp" data-wow-delay="0.1s" style="visibility: hidden; animation-delay: 0.1s; animation-name: none;"><img src="<?php echo "event_images/".$eve_fet['branch']."/".$eve_fet['imagename'];?>" alt="<?php echo $eve_fet['eventname'];?>" style="height:200px !important;width:100%;margin-top:-60px;">
                <div class="zone-content">
                </a>
                  <h2><?php echo $eve_fet['eventname'];?></h2>                 
                </div>
                <div class="zone-contact"><a class="btn btn-primary" href="register.php?<?php echo $eve_fet['eid'];?>" >Register to this event</a></div>
              </div></div>
              </div>
              <?php } ?>


    </section>

   
<div id="projectFacts" class="sectionClass">
    <div class="fullWidth eight columns">
        <div class="projectFactsWrap ">
            <div class="item wow fadeInUp animated animated" data-number="8000" style="visibility: visible;">
                <i class="fa fa-user-plus"></i>
                <p id="number1" class="number">8000</p>
                <span></span>
                <p>Participants</p>
            </div>
            <div class="item wow fadeInUp animated animated" data-number="55" style="visibility: visible;">
                <i class="fa fa-smile-o"></i>
                <p id="number2" class="number">20</p>
                <span></span>
                <p>Events</p>
            </div>
            <div class="item wow fadeInUp animated animated" data-number="359" style="visibility: visible;">
                <i class="fa fa-graduation-cap"></i>
                <p id="number3" class="number">50</p>
                <span></span>
                <p>Organizers</p>
            </div>
            <div class="item wow fadeInUp animated animated" data-number="246" style="visibility: visible;">
                <i class="fa fa-users"></i>
                <p id="number4" class="number">100</p>
                <span></span>
                <p>Volunteers</p>
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
    <script src="Cygnus_files/wow.min.js"></script>
    <script src="Cygnus_files/sketch.min.js"></script>
    <script src="Cygnus_files/jquery.easing.1.3.js"></script>
    <script src="Cygnus_files/jquery.parallax-scroll.js"></script>
    <script src="Cygnus_files/jquery.gradient.text.js"></script>
    <script src="Cygnus_files/soon.min.js"></script>
    <script src="Cygnus_files/vscroller.js"></script>
    <script src="Cygnus_files/custom.js"></script>
    <script src="Cygnus_files/counter.js"></script>
  <script>

    (function(){
        var i=0,soons = document.querySelectorAll('.soon'),l=soons.length;
        for (;i<l;i++) {
            soons[i].setAttribute('data-due','2018-03-24T17:00:00');
            soons[i].setAttribute('data-now',"<?php echo date('Y-m-d')."T".date('H:i:s');?>");
        }
    }());
     $(document).ready(function () {
            $('#vscroller').vscroller({ newsfeed: 'newsxml.php' });
        });
</script>
</body></html>