<?php
session_start();
require_once("site-settings.php");

//checking whether loggedin or not
$isloggedin=false;
$stuid="";
if(isset($_SESSION['stuid']) && !empty($_SESSION['stuid']) && isset($_SESSION['web']) && !empty($_SESSION['web']))
{
echo "Already loggedin";
exit;
$stuid=trim($_SESSION['stuid']);
$isloggedin=true;
}
//checking whether loggedin or not
$isreg=mysql_fetch_array(mysql_query("SELECT * FROM site_settings WHERE function='Site Registrations'"));
$isregopen=$isreg['value'];
if($isregopen=="on")
{
if(isset($_POST['reg_email']) && !empty($_POST['reg_email']) &&  isset($_POST['reg_name']) && !empty($_POST['reg_name']) && isset($_POST['reg_year']) && !empty($_POST['reg_year']) && isset($_POST['reg_branch']) && !empty($_POST['reg_branch']) && isset($_POST['reg_gender']) && !empty($_POST['reg_gender']) && isset($_POST['reg_clg']) && !empty($_POST['reg_clg']) && isset($_POST['reg_mob']) && !empty($_POST['reg_mob']) && isset($_POST['reg_upass']) && !empty($_POST['reg_upass']))
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
$reg_email=prathap("reg_email");
$reg_name=prathap("reg_name");
$reg_year=prathap("reg_year");
$reg_branch=prathap("reg_branch");
$reg_gender=prathap("reg_gender");
$reg_clg=prathap("reg_clg");
$reg_mob=prathap("reg_mob");
$reg_upass=prathap("reg_upass");
$reg_accept=prathap("reg_accept");
if(1==1)
{
if($reg_email=="" || !filter_var($reg_email, FILTER_VALIDATE_EMAIL))
{
echo "Please Enter Valid Email Address";	
}
elseif($reg_name=="" || !preg_match("/^[a-zA-Z ]*$/",$reg_name))
{
echo "Please Enter Name";	
}
elseif($reg_year=="Select" || mysql_num_rows(mysql_query("SELECT * FROM year_categories WHERE year='$reg_year'"))<1)
{
echo "Please Choose Valid Year";	
}
elseif($reg_branch=="Select" || mysql_num_rows(mysql_query("SELECT * FROM branch_categories WHERE branch='$reg_branch'"))<1)
{
echo "Please Choose Valid Branch";	
}
elseif($reg_gender=="Select" || !in_array($reg_gender,array("Male","Female")))
{
echo "Please Choose Valid Gender";	
}
elseif($reg_clg=="")
{
echo "Please Enter College Name";	
}
elseif($reg_accept=="0" || $reg_accept="")
{
echo "Please agree to the terms and conditions";	
}
elseif($reg_upass=="" || strlen($reg_upass)<2)
{
echo "Please Enter Valid Password. Minimum 2 characters";	
}
else
{
//checking whether already registered	
if(mysql_num_rows(mysql_query("SELECT * FROM users WHERE email='$reg_email'"))>=1)
{
echo "Already Registered";	
exit;
}	
else
{
	$passwd=md5($reg_upass);
    $lastzid = mysql_query("select * from `users` ORDER BY sno DESC LIMIT 1 ");
	if(mysql_num_rows($lastzid)<1)
	{
		$curtzid="CYN0001";
	}
	else{
		    $det=mysql_fetch_array($lastzid);
			$tzzid=$det['cygnusid'];
			//getting last four numbers
		$tz1=substr($tzzid, 0, 6);
		$tz2=substr($tzzid, 0, 5);
		$tz3=substr($tzzid, 0, 4);
		$tz4=substr($tzzid, 0, 3);
		$tzzid=substr($tzzid, 3, 6);
		if($tz1=='CYN000')
		{
			$curtzid=$tzzid+1;
			if($curtzid=='10')
			{
				$curtzid="CYN00".$curtzid;
			}
			else
			{
			$curtzid="CYN000".$curtzid;
			}
			
		}
		else if($tz2=='CYN00')
		{
			$curtzid=$tzzid+1;
			if($curtzid=='100')
			{
				$curtzid="CYN0".$curtzid;
			}
			else
			{
			$curtzid="CYN00".$curtzid;
			}
		}
		else if($tz3=='CYN0')
		{
			$curtzid=$tzzid+1;
			if($curtzid=='1000')
			{
				$curtzid="CYN".$curtzid;
			}
			else
			{
			$curtzid="CYN0".$curtzid;
			}
		}
		else
		{
			$curtzid=$tzzid+1;
			$curtzid="CYN".$curtzid;
		}
		}
	}
	if(curtzid==""){$curtzid="CYN0001";}
		//assigning new id
	 	$stuid=$curtzid;
		

		 if(mysql_query("INSERT INTO `users`(stuid,cygnusid,email,stuname,passwd,gender,year,branch,phone,clg_name,lastip) VALUES('$stuid','$curtzid','$reg_email','$reg_name','$passwd','$reg_gender','$reg_year','$reg_branch','$reg_mob','$reg_clg','$ip')") or die(mysql_error()))
	 {

      $to       =   $reg_email;
      $subject  =   "Thanks for Registering to Cygnus2K18";
      $message  =   "Hi <br> Thank you for Registering to Cygnus2K18. Your Cygnus ID is ".$curtzid;
      $name     =   "Team Cygnus";
      $mailsend =   sendmail($to,$subject,$message,$name);

	echo "Registered Successfully. Your ID is ".$stuid;

}
}
}
else
{
echo "Invalid University ID";
}
}
else
{
	//blocking User ips
	mysql_query("INSERT INTO blockedips(user,ip,reason) VALUES('$stuid','$ip','Registration Page Values Passing')");
}
}
else
{
echo "Registrations are closed";	
}
?>

