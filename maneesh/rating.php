<?php
session_start();
include_once("tutorial.php");
$tutorial = new Tutorial();
$stuid=$_SESSION['stuid'];
$id=$_POST['id'];
$k=mysql_query("SELECT * FROM voting_log where voted_by='$stuid' AND voted_for='$id'");
$ry=mysql_num_rows($k);
if($ry!=1){
if($_POST['id']){
	//previous tutorial data
	$prev_record = $tutorial->get_rows($_POST['id']);
	//previous total likes
	$prev_like = $prev_record['votes_count'];
	//previous total dislikes
	//$prev_dislike = $prev_record['dislike_num'];

//	$prev_download = $prev_record['downloads'];
	
	//calculates the numbers of like or dislike
	if($_POST['type'] == 1){
		$like = ($prev_like + 1);		
		$return_count = $like;
	}
	//store update data
	$data = array('votes_count'=>$like);
	//update condition
	$condition = array('id'=>$_POST['id']);
	//update tutorial like dislike
	$update = $tutorial->update($data,$condition);
	
	//return like or dislike number if update is successful, otherwise return error
	echo $update?$return_count:'err';	


	$dd=$_SESSION['stuid'];
	$id=$_POST['id'];
	$k=mysql_query("SELECT * FROM voting_profile where id='$id'");
	while($e=mysql_fetch_array($k)){
		$gn=$e['stugender'];
	}

	$ip=$_SERVER['REMOTE_ADDR'];

	$p=mysql_query("INSERT INTO voting_log (voted_by,voted_for,voted_ip,status,voted_gender) VALUES ('$dd','$id','$ip','success','$gn') ");
}
}
else{
	echo "Only Once";
}
?>