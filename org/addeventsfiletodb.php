<?php
session_start();
if((!isset($_SESSION['tz_organizer'])) || (!isset($_SESSION['tz_webteam'])))
{
	header("location:index");
}
require_once("site-settings.php");
$getuserdata=mysql_fetch_array(mysql_query("SELECT * FROM organizers WHERE orgid='".mysql_real_escape_string($_SESSION['tz_organizer'])."'"));



if(isset($_POST['add_file']))
	{
$evename=mysql_real_escape_string(trim($_POST['evename']));
$catego=mysql_real_escape_string(trim($_POST['catego']));
$eve_hat=mysql_fetch_array(mysql_query("SELECT * FROM events WHERE eid='".$evename."'"));
$valid_folder=0;
$valid_extension=0;
if(($_FILES['file']['name'])=="")
{
	echo "<script>alert('Invalid file');window.history.back();</scropt>";
}
else
{
	$extension=pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);
	$allowed=array("zip","doc","pdf","ppt");
	$filename=$_FILES['file']['name'];
	$filename="".$eve_hat['branch']."_".$eve_hat['eventname']."_".$catego.".".$extension."";
	$filpath="event_files/".$eve_hat['branch']."/".$filename;
	
}

if(!in_array($extension,$allowed))
		{
     echo "<script>alert('File is not allowed to upload...');window.history.back();</script>";
		}
		else
		{
			$valid_extension=1;
		}
 if(is_dir("../event_files"))
		{
        if(is_dir("../event_files/".$eve_hat['branch'].""))
			{
			$valid_folder=1;
			}
			else
			{
				mkdir("../event_files/".$eve_hat['branch']."");
				$valid_folder=1;
			}
		}
		else
		{

		mkdir("../event_files");
		
        if(is_dir("../event_files/".$eve_hat['branch'].""))
			{
			$valid_folder=1;
			}
			else
			{
				mkdir("../event_files/".$eve_hat['branch']."");
				$valid_folder=1;
			}
		}
$new_set_vari=$eve_hat[$catego];
$add_set_vari=$new_set_vari."<br><br><br><a href=".$filpath." target=_blank style=cursor:pointer;color:blue;>Click here to view file</a>";

if($valid_folder==1 && $valid_extension==1)
		{
		if(move_uploaded_file($_FILES['file']['tmp_name'],"../event_files/".$eve_hat['branch']."/".$filename))
	{
 if(mysql_query("UPDATE events SET $catego='$add_set_vari'
 WHERE eid='$evename'") or die(mysql_error()))
		{
	echo "<script>alert('File has been added to ".$eve_hat['branch']." ".$eve_hat['eventname']." ".$catego."');window.location='index.php';</script>";
		}
		else
		{
echo "<script>alert('Some error Occured....');window.location='addfilestoeventdetails';</script>";
		}
	}
		}


}
?>