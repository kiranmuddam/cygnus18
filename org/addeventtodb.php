<?php
session_start();
if(!isset($_SESSION['tz_webteam']))
{
	header("location:index");
}
require_once("site-settings.php");
$getuserdata=mysql_fetch_array(mysql_query("SELECT * FROM organizers WHERE orgid='".mysql_real_escape_string($_SESSION['tz_organizer'])."'"));
$eventdat=mysql_fetch_array(mysql_query("SELECT * FROM events ORDER BY eid DESC LIMIT 1"));
$lastid=$eventdat['eid'];
$curid=$lastid+1;

if(isset($_SESSION['tz_webteam']))
{

if(isset($_POST['event_add']))
	{
$branch=mysql_real_escape_string(trim($_POST['branch']));
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

if(($_FILES['file']['name'])=="")
{
	echo "<script>alert('Invalid file');</scropt>";
}
else
{
	$extension=pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);
	$allowed=array("jpg","png","jpeg","gif","JPG","JPEG","PNG","GIF");
	$filename=$_FILES['file']['name'];
	$filename="".$branch."_".$eventname."_".$curid.".".$extension."";
	
}
if(!in_array($extension,$allowed))
		{
     echo "<script>alert('File is not allowed to upload...');</script>";
		}
		else
		{
			$valid_extension=1;
		}

     if(is_dir("../event_images"))
		{
        if(is_dir("../event_images/".$branch.""))
			{
			$valid_folder=1;
			}
			else
			{
				mkdir("../event_images/".$branch."");
				$valid_folder=1;
			}
		}
		else
		{

		mkdir("../event_images");
		
        if(is_dir("../event_images/".$branch.""))
			{
			$valid_folder=1;
			}
			else
			{
				mkdir("../event_images/".$branch."");
				$valid_folder=1;
			}
		}


		if($valid_folder==1 && $valid_extension==1)
		{
			if(move_uploaded_file($_FILES['file']['tmp_name'],"../event_images/".$branch."/".$filename))	
	{
	if($yearrestrictions=="no")
		{
       mysql_query("INSERT INTO events(eid,eventname,imagename,branch,participants,minparticipants,isyearrestrictions,description,instructions,organizers,schedule,prizes) VALUES('$curid','$eventname','$filename','$branch','$participants','$minparticipants','$yearrestrictions','$description','$instructions','$organizers','$schedule','$prizes')") or die(mysql_error());
		}
		else
		{
  mysql_query("INSERT INTO events(eid,eventname,imagename,branch,participants,minparticipants,isyearrestrictions,description,instructions,organizers,schedule,prizes) VALUES('$curid','$eventname','$filename','$branch','$participants','$minparticipants','$yearrestrictions','$description','$instructions','$organizers','$schedule','$prizes')");

  mysql_query("INSERT INTO isyearrestrictions(eid,eventname,branch,P1,P2,E1,E2,E3,E4) VALUES('$curid','$eventname','$branch','$resarP1','$resarP2','$resarE1','$resarE2','$resarE3','$resarE4')" )or die(mysql_error());
		}
		echo "<script>alert('Event successfully added');window.location='addevent';</script>";
	}
	else
	{
    echo "<script>alert('File not uploaded and event not added...');</script>";
	}

		}

}
}
?>
