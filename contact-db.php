<?php
session_start();
require_once("site-settings.php");


//checking whether loggedin or not
$isloggedin=false;
$stuid="";
if(!isloggedin())
{
echo "Please Login";
exit;
$stuid=trim($_SESSION['stuid']);
$isloggedin=true;
}
//checking whether loggedin or not
$isreg=mysql_fetch_array(mysql_query("SELECT * FROM site_settings WHERE function='Site Logins'"));
$isregopen=$isreg['value'];
if($isregopen=="on")
{
if(isset($_POST['stuid']) && !empty($_POST['stuid']) && isset($_POST['passwd']) && !empty($_POST['passwd']))
{
//function for sanitizing variable values
function prathap($field)
{
$prathap=trim($_POST[$field]);	
$prathap=strip_tags($prathap);	
$prathap=htmlspecialchars($prathap);	
$prathap=mysql_real_escape_string($prathap);	
return $prathap;
}

//variables
$stuid=$_SESSION['stuid'];
$passwd=prathap("passwd");

$data=mysql_query("SELECT * FROM users WHERE stuid='$stuid'");
if(mysql_num_rows($data)>=1)
{

if(mysql_num_rows(mysql_query("SELECT * FROM users WHERE stuid='$stuid'"))<1)
{
echo "Please Enter Valid University ID";
}
elseif($passwd=="")
{
echo "Please Enter Password";	
}
else
{
//checking whether already registered	
if(mysql_query("INSERT INTO contact_messages(stuid,msg,ip) VALUES('$stuid','$passwd','$ip')") or die(mysql_error()))
{
echo "success";	
}	
else
{
	
echo "Invalid Login";	
	}
}
}
else
{
echo "Invalid Email ID";
}
}
else
{
	//blocking User ips
	mysql_query("INSERT INTO blockedips(user,ip,reason) VALUES('$stuid','$ip','Login Page Values Passing')");
}
}
else
{
echo "Logins are Disabled";	
}
?>

