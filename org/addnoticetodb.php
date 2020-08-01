<?php
session_start();
if((!isset($_SESSION['tz_organizer'])) && (!isset($_SESSION['tz_webteam'])))
{
	header("location:index");
}
require_once("site-settings.php");
$getuserdata=mysql_fetch_array(mysql_query("SELECT * FROM organizers WHERE orgid='".mysql_real_escape_string($_SESSION['tz_organizer'])."'"));



if(isset($_POST['add_notice']))
	{
$evename=mysql_real_escape_string(trim($_POST['evename']));
$catego=mysql_real_escape_string(trim($_POST['description']));
$notetitle=mysql_real_escape_string(trim($_POST['notetitle']));
$notesd=mysql_real_escape_string(trim($_POST['notesd']));
$valid_folder=0;
$valid_extension=0;
$fileyes=0;
$today=date("m-d-Y");
if(($_FILES['file']['name'])=="")
{
	$fileyes=0;
}
else
{
	$fileyes=1;
	$extension=pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);
	$allowed=array("zip","doc","pdf","odt","docx");
	$filename=$_FILES['file']['name'];
	$filename="".$filename."_".$evename.".".$extension."";
	
	$filepat="<a href=notice_files/".$filename." target=_blank>Click here to View attachment</a>";
	
if(!in_array($extension,$allowed))
		{
     echo "<script>alert('File is not allowed to upload...');</script>";
		}
		else
		{
			$valid_extension=1;
		}
 if(is_dir("../notice_files"))
		{
      
			$valid_folder=1;
			
		}
		else
		{

		mkdir("../notice_files");
		
       
			$valid_folder=1;
			
		}

}

if($fileyes==1)
		{
	//adding notice with attachment
if($valid_folder==1 && $valid_extension==1)
		{
		if(move_uploaded_file($_FILES['file']['tmp_name'],"../notice_files/".$filename))
	{
	
 if(mysql_query("INSERT INTO notifications(eid,title,description,attachments,sd,added_by,role,added_date,ip) VALUES ('$evename','$notetitle','$catego','$filepat','$notesd','".$_SESSION['tz_organizer']."','".$getuserdata['role']."','$today','$ip')") or die(mysql_error()))
		{
	echo "<script>alert('Notice has been added');window.history.back();</script>";
		}
		
	}
		}
		}
		else
		{
			//adding notice without attachment
			 if(mysql_query("INSERT INTO notifications(eid,title,description,sd,added_by,role,added_date,ip) VALUES ('$evename','$notetitle','$catego','$notesd','".$_SESSION['tz_organizer']."','".$getuserdata['role']."','$today','$ip')") or die(mysql_error()))
		{
	echo "<script>alert('Notice has been added');window.history.back();</script>";
		}
		

		}


}
?>
