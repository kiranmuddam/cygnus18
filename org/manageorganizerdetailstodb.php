<?php

header('Content-Type: application/json');

$input = filter_input_array(INPUT_POST);
session_start();
if(!isset($_SESSION['tz_webteam']))
{
	header("location:index");
}
require_once("site-settings.php");

if ($input['action'] === 'edit') {
    if($input['acc_status']==01)	{
    	 mysql_query("UPDATE organizers SET acc_status='Access' WHERE sno='" . $input['sno'] . "'");
    }else if($input['acc_status']==02){
    	 mysql_query("UPDATE organizers SET acc_status='blocked' WHERE sno='" . $input['sno'] . "'");
    }
    else if($input['acc_status']==00) {
    mysql_query("UPDATE organizers SET orgid='" . $input['orgid'] . "', name='" . $input['name'] . "', orgpass='" . $input['orgpass'] . "',  eids='" . $input['eids'] . "'   WHERE sno='" . $input['sno'] . "'");
   }
} else if ($input['action'] === 'delete') {
    mysql_query("UPDATE organizers SET acc_status='deleted' WHERE sno='" . $input['sno'] . "'");
} else if ($input['action'] === 'restore') {
    mysql_query("UPDATE organizers SET acc_status='Access' WHERE sno='" . $input['sno'] . "'");
}
echo json_encode($input);
?>
