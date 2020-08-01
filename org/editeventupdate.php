<?php
session_start();
if(!isset($_SESSION['tz_webteam']) && !isset($_SESSION['tz_organizer']))
{
	header("location:index");
}
require_once("site-settings.php");
$getuserdata=mysql_fetch_array(mysql_query("SELECT * FROM organizers WHERE orgid='".mysql_real_escape_string($_SESSION['tz_organizer'])."'"));
$orgbranch=$getuserdata['branch'];
$eventdat=mysql_fetch_array(mysql_query("SELECT * FROM events ORDER BY eid DESC LIMIT 1"));
$lastid=$eventdat['eid'];


if(isset($_SESSION['tz_webteam']) || isset($_SESSION['tz_organizer']))
{

if(isset($_POST['event_add']))
	{
$eid=mysql_real_escape_string(trim($_POST['uhid']));
$eventname=mysql_real_escape_string(trim($_POST['eventname']));
$participants=mysql_real_escape_string(trim($_POST['participants']));
$minparticipants=mysql_real_escape_string(trim($_POST['minparticipants']));
$yearrestrictions=mysql_real_escape_string(trim($_POST['yearrestrictions']));
$resarP1=0;
$resarP2=0;
$resarE1=0;
$resarE2=0;
$resarE3=0;
$resarE4=0;
if($yearrestrictions=="yes")
		{
$resarP1=mysql_real_escape_string(trim($_POST['resarP1']));
$resarP2=mysql_real_escape_string(trim($_POST['resarP2']));
$resarE1=mysql_real_escape_string(trim($_POST['resarE1']));
$resarE2=mysql_real_escape_string(trim($_POST['resarE2']));
$resarE3=mysql_real_escape_string(trim($_POST['resarE3']));
$resarE4=mysql_real_escape_string(trim($_POST['resarE4']));
		}
$description=mysql_real_escape_string(trim($_POST['description']));
$instructions=mysql_real_escape_string(trim($_POST['instructions']));
$organizers=mysql_real_escape_string(trim($_POST['organizers']));
$schedule=mysql_real_escape_string(trim($_POST['schedule']));
$prizes=mysql_real_escape_string(trim($_POST['prizes']));
$valid_folder=0;
$valid_extension=0;

		
	if($yearrestrictions=="no")
		{
       mysql_query("UPDATE events SET eventname='$eventname',participants='$participants',minparticipants='$minparticipants',isyearrestrictions='$yearrestrictions',description='$description',instructions='$instructions',organizers='$organizers',schedule='$schedule',prizes='$prizes' WHERE eid='$eid'  ");
		}
		else
		{
  mysql_query("UPDATE events SET eventname='$eventname',participants='$participants',minparticipants='$minparticipants',isyearrestrictions='$yearrestrictions',description='$description',instructions='$instructions',organizers='$organizers',schedule='$schedule',prizes='$prizes' WHERE eid='$eid' ");

  mysql_query("UPDATE isyearrestrictions SET eventname='$eventname',P1='$resarP1',P2='$resarP2',E1='$resarE1',E2='$resarE2',E3='$resarE3',E4='$resarE4' WHERE eid='$eid' " );
		}
		echo "<script>alert('Event successfully updated');window.location='editevent';</script>";
	}
	

		}



?>
