<?php
session_start();
require_once("site-settings.php");


//reading blocked ips
$isblocked=mysql_num_rows(mysql_query("SELECT * FROM `blockedips` WHERE ip='$ip'"));
if($isblocked>0){echo "Your Ip has been blocked";}

//checking whether loggedin or not
$isloggedin=false;
$stuid="";
if(isset($_SESSION['stuid']) && !empty($_SESSION['stuid']) && isset($_SESSION['web']) && !empty($_SESSION['web']))
{
$stuid=trim($_SESSION['stuid']);
$isloggedin=true;
}
//checking whether loggedin or not
if($isloggedin==true)
{
if(isset($_POST['passwd']) && !empty($_POST['passwd']) && isset($_POST['cpasswd']) && !empty($_POST['cpasswd']))
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
$passwd=prathap("passwd");
$cpasswd=prathap("cpasswd");

$data=mysql_query("SELECT * FROM users WHERE stuid='$stuid'");
if(mysql_num_rows($data)>=1)
{

if($passwd=="")
{
echo "Please Enter New Password";
}
elseif($cpasswd=="")
{
echo "Please Enter Confirm Password";	
}
elseif($cpasswd!=$passwd)
{
echo "New Password and Confirm Password are not same";	
}
else
{
mysql_query("UPDATE users SET passwd='$passwd',lastip='$ip',lasttime=NOW() WHERE stuid='$stuid'");
echo "updated";	

}
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
echo "Please Login";	
}
?>

