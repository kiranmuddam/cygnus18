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
$stuid=$_SESSION['stuid'];

if(isset($_SERVER['QUERY_STRING'])){
$qur=$_SERVER['QUERY_STRING'];
function prathap($field)
{
$prathap=trim($field);  
$prathap=strip_tags($prathap);  
$prathap=htmlspecialchars($prathap);  
$prathap=mysql_real_escape_string($prathap);  
return $prathap;
}

$eid=prathap($qur);
$query=mysql_query("SELECT * FROM events WHERE eid='$eid' && visibility='1'");
if(mysql_num_rows($query)>=1){$isvalid=1;}
if($isvalid==1)
{
if(!isset($_SESSION['visitedeve'.$eid]))
{
mysql_query("UPDATE events SET views=views+1 WHERE eid='$eid'");  
$_SESSION['visitedeve'.$eid]="yes";
}
$query_fet=mysql_fetch_array($query);
$user_fet=mysql_fetch_array(mysql_query("SELECT * FROM users WHERE stuid='$stuid'"));
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
    <style>
    #customers {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    width: 100%;
    border-collapse: collapse;
}

#customers td, #customers th {
    font-size: 1em;
    border: 1px solid #98bf21;
    padding: 3px 7px 2px 7px;
}

#customers th {
    font-size: 1.1em;
    text-align: left;
    padding-top: 5px;
    padding-bottom: 4px;
    background-color: #A7C942;
    color: #ffffff;
}

#customers tr.alt td {
    color: #000000;
    background-color: #EAF2D3;
}

 </style>

    <script type="text/javascript">
      
function shwfields(num,eid)
{
var str="<table id='customers' width='300px'>";
var f=0;
for(var i=1;i<=num;i++)
{
f++;
var clls=(f>0)?"alt":"";
str=str+"<tr class='"+clls+"'><td><span style='color:#000;font-weight:bold;font-family:Times New Roman'>University ID "+i+"</span> &nbsp;&nbsp; :</td><td> &nbsp;&nbsp;<input type='text' placeholder='ex : CYNXXXX' id='stuid"+i+"' style='background:#fff;'></td></tr>";  
}
str=str+"<tr><td colspan='2'><center><br><a class='btn btn-primary' style='cursor:pointer;' onclick=doevereg("+num+","+eid+")>Register</a>&nbsp;&nbsp;&nbsp;&nbsp;<span id='loader' style='display:none;'><img src='img/loading8.gif'></span></center></td></tr></table>";    
document.getElementById("shwinp").innerHTML=str;

}

function shwf(va,eid)
{
if(isNaN(va)==true){

notify("This is Not a Number","error","2000","true"); 
  }
else
{
shwfields(va,eid);  
}
}

function pick1(field){return document.getElementById(field).value;}

function doevereg(part,eid)
{
var ids="",valid=0;
for(var i=1;i<=part;i++)
{
if(pick1("stuid"+i)=="" || pick1("stuid"+i)==undefined)
{
dofocus("stuid"+i);
notify("Please Enter University ID "+i+"","error","2000","true");
break;  
}
else
{
if(i==part){
  k=pick1("stuid"+i);
  k=k.toUpperCase();
  ids=ids+k;}
else{
  
  k=pick1("stuid"+i);
  k=k.toUpperCase();
  ids=ids+k+"~";} 
valid++;
} 
}
if(part==valid){

 $(document).ajaxError(function(e, xhr, opt){
     
      if((opt.url=="eventreg-db.php" && xhr.status!="200"))
        {
    $("#loader").hide();
    notify("There is no Connection to server.Please fix Connection problem.","error","3500","true");

    } 
    });
//confirmation
    if(confirm("Are you sure to Register?")) {
      
          
var datastring="eid="+eid+"&part="+part+"&ids="+ids;
$.ajax({
type:"POST",
url:"eventreg-db.php",
data:datastring,
cache:false,
async:true,
beforeSend:function(){showloader("#bod");},
success:function(data){hideloader("#bod");if(data.indexOf("success")!=-1){notify("Registered Successfully....Please wait while changes takes place...","success","3500","true");location.reload();}else{notify(data,"error","2000","true");}}
});

          
        } else {
          return false;
        }
    
  
} 
}</script>

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
       <?php
    $today=date('m-d-Y');
    $w=mysql_query("SELECT * FROM notifications where added_date='$today' and visibility=1");
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
        <th><center><a href="" style="color:green;font-size: 18px;"><?php echo $query_fet['eventname'];?></a></center></th>
    </thead>
  </table>


             <table class="table table-bordered" style="color:#000;background-color: #fff;">
    <tbody>
    <tr>
    <td>

<div id="exTab2" style="color: #000;" class="container"> 
<ul class="nav nav-tabs">
      <li class="active">
        <a  href="#1" data-toggle="tab">About</a></li>
      <li><a href="#2" data-toggle="tab">Rules</a></li>
      <li><a href="#3" data-toggle="tab">Organizers</a></li>
      <li><a href="#4" data-toggle="tab">Schedule</a></li>
      <li><a href="#5" data-toggle="tab">Prizes</a></li>
      <li><a href="#6" data-toggle="tab">Winners</a></li>
      <li><a href="#7" data-toggle="tab">Register</a></li>
      <li><a href="#8" data-toggle="tab">Teams</a></li>
    </ul>
      <div class="tab-content ">
        <div class="tab-pane active" id="1">
            <div style="height:317px;word-wrap:break-word;width:100%;overflow-x:hidden;" id="inner-content-div0">
                 <?php echo $query_fet['description'];?>
                </div>
        </div>
        <div class="tab-pane" id="2">          
            <div style="height:317px;word-wrap:break-word;width:100%;overflow-x:hidden;" id="inner-content-div1">
                 <?php echo $query_fet['instructions'];?>
                </div>
        </div>
        <div class="tab-pane" id="3">
            <div style="height:317px;word-wrap:break-word;width:100%;overflow-x:hidden;" id="inner-content-div2">
                 <?php echo $query_fet['organizers'];?>
                </div>
        </div>
        <div class="tab-pane" id="4">
            <div style="height:317px;word-wrap:break-word;width:100%;overflow-x:hidden;" id="inner-content-div3">
                 <?php echo $query_fet['schedule'];?>
                </div>
        </div>
        <div class="tab-pane" id="5">
            <div style="height:317px;word-wrap:break-word;width:100%;overflow-x:hidden;" id="inner-content-div4">
                 <?php echo $query_fet['prizes'];?>
                </div>
        </div>
        <div class="tab-pane" id="6">
            <div style="height:317px;word-wrap:break-word;width:100%;overflow-x:hidden;" id="inner-content-div5">
                 <?php echo $query_fet['winners'];?>
                </div>
        </div>

        <div class="tab-pane" id="8">
            <div style="height:317px;word-wrap:break-word;width:100%;overflow-x:hidden;" id="inner-content-div6">
                                  <?php
//teams
     echo "<center><br>";
  $kt=mysql_query("SELECT * FROM event_registrations WHERE eid='$eid'") or die(mysql_error());
  echo "<table border=1 cellpadding='10' style='text-align:center;width:90%;'><tr>";
    
  if(mysql_num_rows($kt)>0)
  {
      $kkg=0;
  while($fkt=mysql_fetch_array($kt))
    {
    $mt=array();
    $mt=$fkt['ids'];
    $super=explode("~",$mt);
    
    if($kkg%10==0)
      echo "</tr><td style='background-color:white'>";
    else
      echo "<td style='background-color:white'>";
    $kkg++;
    $colors=array("660066","990000","6600CC","9900CC","FF0000","FF00CC","CC00CC","003399","006600");
    shuffle($colors);
    echo "&nbsp;<u><b><FONT COLOR=YELLOW style='background-color:black;'>Team :".$fkt['teamid']."</FONT></u></B><br>";
                $keka=count($super);
    for($y=0;$y<$keka;$y++)
      echo "<font color=".$colors[0].">".$super[$y]."</font><br>";
    }
    echo "</td>";
    
    
  }
  else
    echo "<center><span class='' style='color:red;'>No Teams Registered</span></center>";
        echo "</tr></table></center>";?>
                </div>
        </div>
        

        <div class="tab-pane" id="7" id="inner-content-div7">
                <table><tr><td>
            <div style="height:317px;word-wrap:break-word;width:100%;overflow-x:hidden;">
                 <?php 
                 $ev=array();$ev=explode("~",$user_fet['eventids']);
                    if(in_array($eid,$ev)){ ?>
                    <br><br>
                    <center><span class='' style='color:green;'>Already Registered</span></center>
                    <?php }
                    else{
                    $ison=mysql_fetch_array(mysql_query("SELECT * FROM site_settings WHERE function='Event Registrations'"));
                                         if($ison['value']=="on")
                                         {
                     if($query_fet['areregistrationson']=="on")
                                         {
                      $user_fet=mysql_fetch_array(mysql_query("SELECT * FROM users WHERE stuid='$stuid'"));
                    if(1!=1)
                    {?>
                    <br><br>
                    <center><span class='' style='color:red;'>You are not allowed to Register to this event</span></center>
                    <?php
                     }
                    else if($query_fet['participants']==$query_fet['minparticipants'])
                    {
                    echo "<br><center><table id='customers' width='300px'>";
            $fg=0;        
for($i=1;$i<=$query_fet['participants'];$i++)
{
$fg++;
$cll=($fg<0)?"":"alt";
print "<tr class='".$cll."'><td><span style='color:#000;font-weight:bold;font-family:Times New Roman'>University ID ".$i."</span> &nbsp;&nbsp; : &nbsp;&nbsp;</td><td><input type='text' placeholder='University ID' id='stuid".$i."' style='background:#fff;'></td></tr>";  
}
print "<tr><td colspan='2'><br><center><a class='btn btn-primary' style='cursor:pointer;' onclick=doevereg(".$query_fet['participants'].",".$eid.")>Register</a>&nbsp;&nbsp;&nbsp;&nbsp;<span id='loader' style='display:none;'><img src='img/loading8.gif'></span></center></td></tr></table>";    


                    echo "</center>";
                    } 
                    else
                    {
                  echo "<br><center><span style='color:#000;font-weight:bold;'>No.of Participants</span> &nbsp;&nbsp;: &nbsp;&nbsp;";
                  echo "<span style='width:100px;'><select class='selecteve' style='padding:5px;color:black;' onchange='shwf(this.value,".$eid.")'>";
                  echo "<option value='' style='color:black;'>Select</option>";
                  for($i=$query_fet['minparticipants'];$i<=$query_fet['participants'];$i++)
                  {
                  echo "<option value='".$i."' style='color:black;'>".$i."</option>";  
                  }
                  echo "</select></span><br><br><span id='shwinp'></span></center>";                    
                     }
                       }
                     else
                     {
                    ?><br><br>
                    <center><span class='' style='color:red;'>Registration for This Event has been Closed</span></center>
                    <?php  
                     }
                       
                     }
                     else
                     {
                    ?><br><br>
                    <center><span class=''  style='color:red;'>Registration for all Events are Closed</span></center>
                    <?php  
                     }
                      }
                      }
                      else
                      {
                      ?><br><br>
                      <center><span class=''  style='color:red;'>students are not allowed to register</span></center>
                    
                    <?php  }
                  
                    }
                    else{
                    ?>
                    <center><span class=''>Please <a href="reglogin.php" style='cursor:pointer;color:red;'>Login</a> to Register to this event</span></center>
                    <?php } ?>

                    </div></td></tr></table>
                </div>
        </div>
      </div>
  </div>

    </td>
    </tr>
    <tr><td>For Technical Problems,Contact Prathap(9010932254) ********* You cannot cancel Event Registration,to do that you have to contact Admin. ********* <a href="https://www.smartquint.com" style='color:red;text-transform: capitalize;' target="_blank">SmartQuint</td></tr>
    </tbody>
  </table>


          </div>


    </section>
    
   
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
    <script src="Cygnus_files/script.js"></script>
    <script src="Cygnus_files/ulak.js"></script>
    <script src="Cygnus_files/jquery.preloader.min.js"></script>
    <script type="text/javascript" src="Cygnus_files/jquery.slimscroll.min.js"></script>
    <script type="text/javascript" src="Cygnus_files/jquery.slimscroll.js"></script>
    <script type="text/javascript">
      $(function(){
    $('#inner-content-div0').slimScroll({
        height: 'auto',
        railVisible: true,
    alwaysVisible: true
    });
    $('#inner-content-div1').slimScroll({
          height: 'auto',
        railVisible: true,
    alwaysVisible: true
    });
    $('#inner-content-div2').slimScroll({
          height: 'auto',
        railVisible: true,
    alwaysVisible: true
    });
    $('#inner-content-div3').slimScroll({
          height: 'auto',
        railVisible: true,
    alwaysVisible: true
    });
    $('#inner-content-div4').slimScroll({
          height: 'auto',
        railVisible: true,
    alwaysVisible: true
    });
    $('#inner-content-div5').slimScroll({
          height: 'auto',
        railVisible: true,
    alwaysVisible: true
    });
     $('#inner-content-div6').slimScroll({
          height: 'auto',
        railVisible: true,
    alwaysVisible: true
    })
      $('#inner-content-div7').slimScroll({
          height: 'auto',
        railVisible: true,
    alwaysVisible: true
    })
});
    </script>
</body></html>
<?php?>