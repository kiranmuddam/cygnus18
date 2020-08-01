<?php
session_start();
require_once("site-settings.php");

//reading blocked ips
if(1==1){

//checking whether loggedin or not
$isloggedin=false;
$stuid="";
if(isset($_SESSION['stuid']) && !empty($_SESSION['stuid']) && isset($_SESSION['web']) && !empty($_SESSION['web']))
{
$stuid=trim($_SESSION['stuid']);
$isloggedin=true;
if(isset($_POST['eid']) && !empty($_POST['eid']) && isset($_POST['part']) && !empty($_POST['part']) && isset($_POST['ids']) && !empty($_POST['ids']))
{
//function for sanitizing variable values
function prathap($field)
{
$prathap=trim($_POST[$field]);	
$prathap=strip_tags($prathap);	
$prathap=mysql_real_escape_string($prathap);	
return $prathap;
}

$eid=prathap("eid");
$part=prathap("part");
$ids=prathap("ids");
$query=mysql_query("SELECT * FROM events WHERE eid='$eid'");
$query_fetch=mysql_fetch_array($query);
$ison=mysql_fetch_array(mysql_query("SELECT * FROM site_settings WHERE function='Event Registrations'"));                                       
if(mysql_num_rows($query)>=1)
{
if($ison['value']=="off"){echo "Registration for All Events has been Closed";}
elseif($query_fetch['areregistrationson']=="off"){echo "Registration for this Event has been Closed";}
else
{

$tids=array();
$tids=explode("~",$ids);	
if(!in_array($stuid,$tids)){print "Please Include Yourself.";exit;}
//getting max team id
$teamid=0;
$t=mysql_fetch_array(mysql_query("SELECT * FROM event_registrations WHERE eid='$eid' ORDER BY sno DESC"));
$teamid=$t['teamid'];
$teamid=(int)$teamid;
$teamid++;


//function for duplicate checking
function showDups($array)
{
  $array_temp = array();

   foreach($array as $val)
   {
     if (!in_array($val, $array_temp))
     {
       $array_temp[] = $val;
     }
     else
     {
       echo 'Following are Repeating ' . $val . '<br />';
       exit;
     }
   }
}

//allow only female reg for 2048
if($eid=="22"){
	$err="";
$valid=0;
$regco=0;
for($i=0;$i<count($tids);$i++)
{
if(mysql_num_rows(mysql_query("SELECT * FROM users WHERE stuid='".$tids[$i]."' and gender='Female'"))<1){$err=$err.$tids[$i].", ";$regco++;}
else{$valid++;}	
}
if($regco!=0){$ty=($regco==1)?"is":"are";$err=$err." $ty not girls and this is only for Girls";echo $err;exit;}
}


//allow only male reg for counter strike
if($eid=="23"){
	$err="";
$valid=0;
$regco=0;
for($i=0;$i<count($tids);$i++)
{
if(mysql_num_rows(mysql_query("SELECT * FROM users WHERE stuid='".$tids[$i]."' and gender='Male'"))<1){$err=$err.$tids[$i].", ";$regco++;}
else{$valid++;}	
}
if($regco!=0){$ty=($regco==1)?"is":"are";$err=$err." $ty not boys and this is only for Boys";echo $err;exit;}
}


//dont allow male and female reg for moto gp and sherlock homes
if($eid=="24"){
	$err="";
$valid=0;
$v=0;
$regco=0;
for($i=0;$i<count($tids);$i++)
{
if(mysql_num_rows(mysql_query("SELECT * FROM users WHERE stuid='".$tids[$i]."' and gender='Male'"))<1){$regco++;}
else{$v++;}	
}
if($regco!=0 and $v!=0){$err=$err." Participants should be from same gender.";echo $err;exit;}
}


//checking duplicates
showDups($tids);

//checking whether user is registered to event
$err="";
$valid=0;
$regco=0;
for($i=0;$i<count($tids);$i++)
{
if(mysql_num_rows(mysql_query("SELECT * FROM users WHERE stuid='".$tids[$i]."'"))<1){$err=$err.$tids[$i].", ";$regco++;}
else{$valid++;}	
}
if($regco!=0){$ty=($regco==1)?"is":"are";$err=$err." $ty not Registered";echo $err;exit;}


/*
//checking E4 member is in team or not
$err="";
$valid=0;
$regco=0;
for($i=0;$i<count($tids);$i++)
{
$money=mysql_fetch_array(mysql_query("SELECT * FROM users WHERE stuid='".$tids[$i]."'"));
if($money['year']=="E4"){$err=$err.$tids[$i].", ";$regco++;}
else{$valid++;}	
}
if($regco!=0){$err=$err." are(is) not allowed to register as they are E4 students";echo $err;exit;}
*/

if($query_fetch['isyearrestrictions']=="yes")
{
//checking year restrictions
$err="";
$que=mysql_fetch_array(mysql_query("SELECT * FROM isyearrestrictions WHERE eid='$eid'"));
$OP1=$que['P1'];
$OP2=$que['P2'];
$OE1=$que['E1'];
$OE2=$que['E2'];
$OE3=$que['E3'];
$OP4=$que['E4'];

$P1=0;
$P2=0;
$E1=0;
$E2=0;
$E3=0;
$P4=0;


for($i=0;$i<count($tids);$i++)
{
$m=mysql_fetch_array(mysql_query("SELECT * FROM users WHERE stuid='".$tids[$i]."'"));
if($m['year']=="P1"){$P1++;}
if($m['year']=="P2"){$P2++;}
if($m['year']=="E1"){$E1++;}
if($m['year']=="E2"){$E2++;}
if($m['year']=="E3"){$E3++;}
if($m['year']=="E4"){$E4++;}
}

if($P1<$OP1){echo "Team Should Contain ".$OP1." P1 Students";exit;}
else if($P2<$OP2){echo "Team Should Contain <span style='color:yellow;'>".$OP2."</span> P2 Students";exit;}
else if($E1<$OE1){echo "Team Should Contain <span style='color:yellow;'>".$OE1."</span> E1 Students";exit;}
else if($E2<$OE2){echo "Team Should Contain <span style='color:yellow;'>".$OE2."</span> E2 Students";exit;}
else if($E3<$OE3){echo "Team Should Contain <span style='color:yellow;'>".$OE3."</span> E3 Students";exit;}
else if($E4<$OE4){echo "Team Should Contain <span style='color:yellow;'>".$OE4."</span> E4 Students";exit;}

}


//checking whether already registered
$err="";
$valid=0;
$regco=0;
$mine=mysql_query("SELECT ids FROM event_registrations WHERE eid='$eid'");
	while($p2=mysql_fetch_array($mine))
		{
		$spl=explode("~",$p2['ids']);
		for($k=0;$k<count($tids);$k++)
			{
			if(in_array($tids[$k],$spl))
				{
				$err=$err.$tids[$k].", ";$regco++;
				
				}	
			}
		}
	
if($regco!=0){$ty=($regco==1)?"is":"are";$err=$err." $ty Already Registered";echo $err;exit;}

if(count($tids)>$query_fetch['participants']){
	echo "Participants Number is greater than Original Participation Number";
	mysql_query("INSERT INTO blockedips(user,ip,reason) VALUES('$stuid','$ip','Participation Number Increased than Original Participation Number')");
	exit;
	}
else{
	
	$query=mysql_query("SELECT * FROM events WHERE eid='$eid'");
    $query_fetch=mysql_fetch_array($query);
    $branch=$query_fetch['branch'];
    $eventname=$query_fetch['eventname'];
	mysql_query("INSERT INTO event_registrations(`eid`, `branch`, `eventname`,`teamid`,`ids`,`regdone_by`,`regdone_ip`) VALUES ('$eid', '$branch','$eventname', '$teamid','$ids','$stuid','$ip')");
	for($i=0;$i<count($tids);$i++)
	{
	
	$query=mysql_query("SELECT * FROM events WHERE eid='$eid'");
    $query_fetch=mysql_fetch_array($query);
    $branch=$query_fetch['branch'];
    $dis=mysql_fetch_array(mysql_query("SELECT * FROM branch_categories WHERE branch='$branch'"));
    $eventname=$query_fetch['eventname'];
	$id=$tids[$i];
	$displ=$dis['displayname'];
	$frm="Event Organizer";
	$subject="Thanks for Registering to $displ - $eventname";
	$description='<div align="left">Hi '.$id.',<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Thank you for Registering to '.$eventname.'.Your Team ID is <b>'.$teamid.'.</b>.If any problem persists,please contact us through chat box.<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> sd/-</b><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>TECKZITE16 Team</b><br></div>';
    mysql_query("INSERT INTO personal_msgs(stuid,subject,description,frm) VALUES('$id','$subject','$description','$frm')");
    $f=mysql_fetch_array(mysql_query("SELECT * FROM users WHERE stuid='$id'"));
    $pree=$f['eventids'];
    $pree=(string)$pree.(string)$eid."~";
    mysql_query("UPDATE users SET eventsregcount=eventsregcount+1,eventids='$pree' WHERE stuid='$id'");
   }
	echo "success";
		
	}
}
}
else
{
echo "There is No Such Event";
}
}
else
{
	mysql_query("INSERT INTO blockedips(user,ip,reason) VALUES('$stuid','$ip','Event Registration Values')");

}
}
else
{
echo "Please Login";	
}
}
else{echo "Your IP has been blocked";}
?>
