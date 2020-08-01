<?php
header('Content-Type: application/json');

$input = filter_input_array(INPUT_POST);
session_start();
if((!isset($_SESSION['tz_organizer'])) && (!isset($_SESSION['tz_webteam'])))
{
	header("location:index");
}
require_once("site-settings.php");
$getuserdata=mysql_fetch_array(mysql_query("SELECT * FROM organizers WHERE orgid='".mysql_real_escape_string($_SESSION['tz_organizer'])."'"));
if(isset($_POST['eid']))
{
   
		$eved=mysql_fetch_array(mysql_query("SELECT * FROM events WHERE eid='".mysql_real_escape_string($_POST['eid'])."'"));
		
		//creating folder to store abstract files
		if(is_dir("../tzabstractsubmissions/"))
		{
		
       //creating branch folders
      if(is_dir("../tzabstractsubmissions/".$eved['branch']))
		{
		  //creating event folders
		  if(is_dir("../tzabstractsubmissions/".$eved['branch']."/".$eved['eventname']))
		{
		}
		else
			{

      mkdir("../tzabstractsubmissions/".$eved['branch']."/".$eved['eventname']);
			}
		}
		else
			{
			mkdir("../tzabstractsubmissions/".$eved['branch']);
			  //creating event folders
		  if(is_dir("../tzabstractsubmissions/".$eved['branch']."/".$eved['eventname']))
		{
		}
		else
			{

      mkdir("../tzabstractsubmissions/".$eved['branch']."/".$eved['eventname']);
			}
			}

		}
        else
		{
			//creating main folder
			mkdir("../tzabstractsubmissions/");
			    //creating branch folders
      if(is_dir("../tzabstractsubmissions/".$eved['branch']))
		{
		  //creating event folders
		  if(is_dir("../tzabstractsubmissions/".$eved['branch']."/".$eved['eventname']))
		{
		}
		else
			{

      mkdir("../tzabstractsubmissions/".$eved['branch']."/".$eved['eventname']);
			}
		}
		else
			{
			mkdir("../tzabstractsubmissions/".$eved['branch']);
			  //creating event folders
		  if(is_dir("../tzabstractsubmissions/".$eved['branch']."/".$eved['eventname']))
		{
		}
		else
			{

      mkdir("../tzabstractsubmissions/".$eved['branch']."/".$eved['eventname']);
			}
			}
 
		}
    $uplpath="tzabstractsubmissions/".$eved['branch']."/".$eved['eventname'];

        $org=$_SESSION['tz_organizer'];
		$orgname=$getuserdata['name'];
  	$eid_1=mysql_real_escape_string($_POST['eid']);
	$eid_2=mysql_real_escape_string($input['eid']);
if ($input['action'] === 'edit') {
	if($input['action_org']==01){
		mysql_query("INSERT INTO abstract_uploads_settings(eid,branch,eventname,uploadsfolderpath,added_by_id,added_by_name,added_by_ip,time) VALUES('".mysql_real_escape_string($_POST['eid'])."','".$eved['branch']."','".$eved['eventname']."','$uplpath','".$_SESSION['tz_organizer']."','".$getuserdata['name']."','$ip','$time')") or die(mysql_error());		
	}else if($input['action_org']==02){ 
		mysql_query("UPDATE abstract_uploads_settings SET added_by_id='$org',added_by_name='$orgname',
			added_by_ip='$ip',time='$time',uploadsopen='opened' WHERE eid='$eid_1'");
    }
} else if ($input['action'] === 'delete') {
    mysql_query("UPDATE abstract_uploads_settings SET added_by_id='$org',added_by_name='$orgname',
			added_by_ip='$ip',time='$time',uploadsopen='closed' WHERE eid='$eid_1'");
} else if ($input['action'] === 'restore') {
   mysql_query("UPDATE abstract_uploads_settings SET dded_by_id='$org',added_by_name='$orgname',
			added_by_ip='$ip',time='$time',uploadsopen='Opened' WHERE eid='$eid_1'");
}
echo json_encode($input);
}
?>
