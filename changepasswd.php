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
    <link href="Cygnus_files/ulak.css" rel="stylesheet"> 
    <link href="Cygnus_files/preloader.css" rel="stylesheet"> 

</head>
  <body cz-shortcut-listen="true" id="bod">
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
    <nav class="wrapper-nav wow slideInDown" style="visibility: visible; animation-name: slideInDown;">
      <div class="container">
        <div class="nav-primary"><a class="logo" href="index.php" title="<?php echo $title;?>"><img src="Cygnus_files/logo.png" alt="<?php echo $title;?>"></a>
          <ul class="list-inline nav-desktop">
            <li><a href="index.php" title="Homepage">Home</a></li>
            <li><a href="about.php" title="About">About</a></li>
            <li><a href="index.php#events" title="Events">Events</a></li>
            <li><a href="gallery.php" title="Gallery">Gallery</a></li>
            <li><a href="notifications.php" title="Notifications">Notifications</a></li>
            <li><a href="organisers.php" title="Organisers">Organisers</a></li>
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
            <li><a href="notifications.php" title="Notifications">Notifications</a></li>
            <li><a href="organisers.php" title="Organisers">Organisers</a></li>
            <li><a href="contact.php" title="Contact">Contact</a></li>
           <?php if(!isloggedin()){
          ?> <li class="active"><a href="reglogin.php" title="Register / Login">Register / Login</a></li>
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
        <span class="text-box wow slideInDown" style="z-index:-1;font-size:18px;margin-top:8%;margin-left:35%;color: khaki;font-family:'hk_grotesk';visibility: visible; animation-name: slideInDown;">Cygnus2K18 Register/Login</span>
</div>

	    <div class="col-md-6">
            <div class="text-box wow slideInLeft" style="z-index:99999;margin-left:40%;margin-top:33%;visibility: visible; animation-name: slideInLeft;">
              <table class="table table-bordered" style="color:#000;background-color: #fff;">
    <tbody>
 <tr>

 <td>
 	 <table class="table table-bordered" style="color:#000;background-color: #fff;">
 	 <th colspan="2"><center>Change Password</center></th>
    <tbody>
 <tr>
 <td><form class="form-horizontal" action="javascript:void(0)" method="POST" onsubmit="dopassupdate()">New Password :</td>
 <td><input type="password" class="form-control" id="passwd" placeholder="Enter New Password" name="passwd"></td>
 </tr>
 <tr>
 <td>Confirm Password :</td>
 <td><input type="password" class="form-control" id="cpasswd" placeholder="Enter Confirm New Password" name="cpasswd"></td>
 </tr>
 <tr>
 <td colspan="2"><center><a class="btn btn-primary" onclick="dopassupdate()">Update Password</a></center></td>
 </form>
 </tr>
 </tbody>
 </table>
 </td>

 </tr>
    </tbody>
  </table>
          </div>
		</div>
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
    <script src="Cygnus_files/script.js"></script>
    <script src="Cygnus_files/ulak.js"></script>
    <script src="Cygnus_files/jquery.preloader.min.js"></script>
</body></html>