<?php
session_start();
if(!isset($_SESSION['tz_webteam']))
{
	header("location:index");
}
require_once("site-settings.php");
$getuserdata=mysql_fetch_array(mysql_query("SELECT * FROM organizers WHERE orgid='".mysql_real_escape_string($_SESSION['tz_organizer'])."'"));


if(isset($_SESSION['tz_webteam']))
{

if(isset($_POST['orgid']) && isset($_POST['orgname'])  && isset($_POST['orgmob']) && isset($_POST['orgbranch']) && isset($_POST['orggender']) && isset($_POST['orgpass']) && isset($_POST['orgeveids']))
	{

	$orgid=strip_tags(mysql_real_escape_string($_POST['orgid']));
	$orgpass=strip_tags(mysql_real_escape_string($_POST['orgpass']));
	$orgname=strip_tags(mysql_real_escape_string($_POST['orgname']));
	$orgbranch=strip_tags(mysql_real_escape_string($_POST['orgbranch']));
	$orggender=strip_tags(mysql_real_escape_string($_POST['orggender']));
	$orgeveids=strip_tags(mysql_real_escape_string($_POST['orgeveids']));
	$orgmob=strip_tags(mysql_real_escape_string($_POST['orgmob']));
   $orgpass=md5($orgpass);
   $check_already=mysql_query("SELECT * FROM organizers WHERE orgid='$orgid'");
   if(mysql_num_rows($check_already)>=1)
		{
	   echo "<script>alert('AlreadyAdded');window.location='addorganizer'</script>";
		}
		else
		{
		if(mysql_query("INSERT INTO organizers(orgid,name,orgpass,gender,branch,orgmob,eids) VALUES('$orgid','$orgname','$orgpass','$orggender','$orgbranch','$orgmob','$orgeveids')"))
			{
			
			$eve=array();
			$eve=explode("~",$orgeveids);	
			for($i=0;$i<count($eve);$i++)
			{
			mysql_query("UPDATE events SET orgcount=orgcount+1 WHERE eid='".$eve[$i]."'") or die(mysql_error());	
			}
				echo "<script>alert('Added');window.location='addorganizer'</script>";
				
				
				}
		}
		}

}
?>
