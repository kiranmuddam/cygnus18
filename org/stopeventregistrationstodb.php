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
    $org=$_SESSION['tz_organizer'];
	$orgname=$getuserdata['name'];
  	$eid_1=mysql_real_escape_string($_POST['eid']);
	$eid_2=mysql_real_escape_string($input['eid']);
if ($input['action'] === 'edit') {
	if($input['action_org']==01){
		mysql_query("UPDATE events SET reg_stoppedby='$org',ipstopped='$ip',timestopped='$time',areregistrationson='off' WHERE eid='$eid_1'");
	}else if($input['action_org']==02){ 
		mysql_query("UPDATE events SET areregistrationson='on' WHERE eid='$eid_1'");
    }
}
}
echo json_encode($input);
?>
