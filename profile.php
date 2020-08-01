<?php
session_start();
include_once("site-settings.php");

//reading blocked ips
$isblocked=mysql_num_rows(mysql_query("SELECT * FROM `blockedips` WHERE ip='$ip'"));
if($isblocked>0){header("location:error.php");}

//checking whether loggedin or not
$isloggedin=false;
$stuid="";
if(!isloggedin())
{
header("location:reglogin.php");
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
            <li><a href="notifications.php" title="Notifications">Notifications <span class="badge badge-warning"><?php echo $count ?></span></a></li>
            <li><a href="team.php" title="Team">Team</a></li>
            <li><a href="contact.php" title="Contact">Contact</a></li>
          </ul>
         <?php if(!isloggedin()){
          ?>
          <a class="btn btn-primary btn-contact active" href="reglogin.php" title="Register / Login" style="margin-left:10px;">Register / Login</a>
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
    <section class="wrapper-hero" id="hero">

      <div class="container">
        <div class="row">
        <span class="text-box wow slideInDown" style="z-index:-1;font-size:18px;margin-top:8%;margin-left:35%;color: khaki;font-family:'hk_grotesk';visibility: visible; animation-name: slideInDown;"></span>
</div>


          <div class="col-md-12">
            <div class="text-box wow slideInLeft" style="margin-top:13%;visibility: visible; animation-name: slideInLeft;">
           
                <table class="table table-bordered" style="color:#000;background-color: #fff;">
    <thead>
      <tr>
        <th><center><a href="changepasswd.php" style="color:green;font-size: 18px;">Change Passsword</a></center></th>
        <th><center><a href="logout.php" style="color:green;font-size: 18px;">Click here to logout</a></center></th>
    </thead>
  </table>


             <table class="table table-bordered" style="color:#000;background-color: #fff;">
    <thead>
    <th colspan="5"><center>Your Details</center></th>
      <tr>
        <th style="width:10%;">University ID</th>
        <th style="width:10%;">Cygnus ID</th>
        <th style="width:50%;">Name</th>
        <th style="width:10%;">Year</th>
        <th style="width:10%;">Branch</th>
      </tr>
    </thead>
    <tbody>
    <?php 
    $tit=mysql_fetch_array(mysql_query("SELECT * FROM users WHERE stuid='".$_SESSION['stuid']."'"));
    ?>
      <tr>
      <td><?php echo $tit['stuid'];?></td>
      <td><?php echo $tit['cygnusid'];?></td>
      <td><?php echo $tit['stuname'];?></td>
      <td><?php echo $tit['year'];?></td>
      <td><?php echo $tit['branch'];?></td>
       </tr>
    </tbody>
  </table>

   <table class="table table-bordered" style="color:#000;background-color: #fff;">
    <thead>
    <th colspan="5"><center>Registered Events</center></th>
      <tr>
        <th style="10%">Sno</th>
        <th style="width:20%;">Event Name</th>
        <th style="width:10%;">Team ID</th>
        <th style="width:60%;">Team</th>
      </tr>
    </thead>
    <tbody>
    <?php 
    $tit=mysql_query("SELECT * FROM event_registrations WHERE ids LIKE '%".$_SESSION['stuid']."%'");
    $sno=1;
    while($titf=mysql_fetch_array($tit)){
    ?>
      <tr>
      <td><?php echo $sno++;?></td>
      <td><?php echo $titf['eventname'];?></td>
      <td><?php echo $titf['teamid'];?></td>
      <td><?php echo $titf['ids'];?></td>
       </tr>
       <?php } ?>
    </tbody>
  </table>

    <table class="table table-bordered" style="color:#000;background-color: #fff;">
    <thead>
    <th colspan="5"><center>Contact Us Messages</center></th>
      <tr>
        <th style="10%">Sno</th>
        <th style="width:40%;">Message</th>
        <th style="width:40%;">Reply</th>
        <th style="width:10%;">Posted</th>
      </tr>
    </thead>
    <tbody>
    <?php 
    $tit=mysql_query("SELECT * FROM contact_messages WHERE stuid='".$_SESSION['stuid']."' ORDER BY sno DESC");
    $sno=1;
    while($titf=mysql_fetch_array($tit)){
    ?>
      <tr>
      <td><?php echo $sno++;?></td>
      <td><?php echo $titf['msg'];?></td>
      <td><?php echo $titf['rply'];?></td>
      <td><?php echo $titf['time'];?></td>
       </tr>
       <?php } ?>
    </tbody>
  </table>
          </div>

      <footer class="footer">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <ul class="social list-inline wow slideInUp" style="visibility: visible; animation-name: slideInUp;">
                <li><a href="https://www.facebook.com/CynusRGUKTN/" target="_blank" title="facebook"><img src="img/fb.png" width="20px"><span>/CynusRGUKTN</span></a></li><li><a href="https://www.twitter.com/CynusRGUKTN/" target="_blank" title="twitter"><img src="img/twitter.png" width="20px"><span>/CynusRGUKTN</span></a></li>
              </ul>
            </div>
            <div class="col-md-6">
              <ul class="list-inline text-right wow slideInUp" style="visibility: visible; animation-name: slideInUp;">
                <li>Phone <?php echo $contact_dis;?></li>
                <li><?php echo $email_dis;?></li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
      <div class="scroll"></div>
    <!--<canvas class=" sketch" height="auto" width="1366" style="z-index: -9999999999"></canvas>-->
    </section>
    
   
    <footer class="wrapper-footer">
      <div class="container">
        <div class="row">
          <div class="col-md-5">
            <ul class="social list-inline">
                <li><a href="https://www.facebook.com/CynusRGUKTN/" target="_blank" title="facebook"><img src="img/fb.png" width="20px"><span>/CynusRGUKTN</span></a></li><li><a href="https://www.twitter.com/CynusRGUKTN/" target="_blank" title="twitter"><img src="img/twitter.png" width="20px"><span>/CynusRGUKTN</span></a></li>
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

</body></html>