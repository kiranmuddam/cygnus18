<?php
error_reporting(0);
date_default_timezone_set("Asia/Kolkata");
setlocale(LC_ALL,"hu_HU.UTF8");
$time=(strftime("%Y, %B %d, %A."))." ".date("h:i:s a");
$ip=$_SERVER['REMOTE_ADDR']?:($_SERVER['HTTP_X_FORWARDED_FOR']?:$_SERVER['HTTP_CLIENT_IP']);
ini_set('max_execution_time', 0);

//database variables
$database_name="cygnus2k18";
$sessionweb="csergu@123session";  //variable for preventing SESSION HIJACKING
//database connection
mysql_connect("localhost","root",'') or die(mysql_error());
mysql_select_db($database_name) or die(mysql_error());
mysql_query('SET character_set_results=utf8');
mysql_query('SET NAMES utf8');
mysql_query('SET character_set_client=utf8');
mysql_query('SET character_set_connection=utf8');
mysql_query('SET collation_connection=utf8_general_ci');
$endat="2016-04-01 05:00:00";

//site variables
$title="Cygnus2k18";
$contact_dis="9553590536";
$email_dis="info@rguktn-cygnus.org";
$web_dis="rguktn-cygnus.org";
function isloggedin(){
if(isset($_SESSION['stuid']) && !empty($_SESSION['stuid']) && isset($_SESSION['web']) && !empty($_SESSION['web']))
{
return true;
}
else
{
return false;
}
}

include_once("../projsec/project-security.php");

?>
<head>
<link rel="icon" type="text/css" href="Cygnus_files/logo.png"  />
</head>
