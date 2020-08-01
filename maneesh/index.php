<?php
session_start();
//error_reporting(0);
include '../site-settings.php' ;
if(!isset($_SESSION['stuid'])) { 
 echo'<script>window.location="../reglogin"</script>';	
	exit(0);
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Voting</title>
	<meta http-equiv="refresh" content="10">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/icons.css">
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
</head>
<body>
	<?php
	$iip=$_SERVER['REMOTE_ADDR'];
$iip=substr($iip,0,5);
if($iip=="10.1."){echo "It seems to be your using internet while Voting.. Remove proxy and Try again..";exit;}
?>
	<center><img src="http://10.11.3.55/cygnus/Cygnus_files/logo.png" class="img-responsive" alt="logo" style="width:120px; height:80px"></center>
	<h4 class="text-center">Mr and Ms Cygnus - Voting</h4>
<?php
include_once("tutorial.php");
$tutorial = new Tutorial();
$trows = $tutorial->get_rows();

?>
<script type="text/javascript">
function cwRating(id,type,target){
	$.ajax({
		type:'POST',
		url:'rating.php',
		data:'id='+id+'&type='+type,
		success:function(msg){
			if(msg == 'err'){
				alert('Some problem occured, please try again.');
			}else{
				$('#'+target).html(msg);
			}
		}
	});
}

</script>
<div class="col-md-12">
	<hr>
	<div class="row">
		<?php
		$add=$_SESSION['stuid'];
		$t=mysql_query("SELECT * FROM voting_log where voted_by='$add' and voted_gender='M' ");
		$tc=mysql_num_rows($t);
		if($tc!=1){
		$rm=mysql_fetch_array(mysql_query("SELECT * FROM users where stuid='$add'"));
        $e=mysql_query("SELECT * FROM voting_profile where stugender='M' order by id ASC");
        while($r=mysql_fetch_array($e)){
		?>
	<div class="col-md-4">
		<div class="card">
  			<img class="card-img-top" src="<?php echo $r['stupic'] ?>" alt="image" style="width:100%">
  				<div class="card-body">
    				<h4 class="card-title"><?php echo $r['stuname'] ?></h4><p><?php echo $r['stubio'] ?></p>    
    				<a href="javascript::void(0)" class="btn btn-success" onClick="cwRating(<?php echo $r['id']; ?>,1,'like_count<?php echo $r['id']; ?>')">Vote Me</a>
    				
                    <!-- Like Counter -->
                    <!--a class="btn btn-info" style="color:white;" id="like_count<?php echo $r['id']; ?>">Votes <?php  ?></a-->
                    
                   
  				</div>
		</div>
	</div>
	<?php
}
}else{
	echo'<div class="alert alert-danger" style="margin-left:40%;">Already Voted For This Members(one)</div>';
}
?>
	<!--div class="col-md-4">
		<div class="card">
  			<img class="card-img-top" src="N130940 (THEEDA RAVINDRA).png" alt="image" style="width:100%">
  				<div class="card-body">
    				<h4 class="card-title">THEEDA RAVINDRA</h4>I'm the happiest person because I do what I love and what I am passionate about.</p>
    				<a href="javascript:void(0)" class="btn btn-primary">Vote Me</a>
  				</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card">
  			<img class="card-img-top" src="N130940 (THEEDA RAVINDRA).png" alt="image" style="width:100%">
  				<div class="card-body">
    				<h4 class="card-title">THEEDA RAVINDRA</h4>I'm the happiest person because I do what I love and what I am passionate about.</p>
    				<a href="javascript:void(0)" class="btn btn-primary">Vote Me</a>
  				</div>
		</div>
	</div-->

</div>
</div>

	<br><br>

	

<div class="col-md-12">
	<hr>
	<div class="row">
		<?php
		$add=$_SESSION['stuid'];
		$t=mysql_query("SELECT * FROM voting_log where voted_by='$add' and voted_gender='F' ");
		$tc=mysql_num_rows($t);
		if($tc!=1){
		$rm=mysql_fetch_array(mysql_query("SELECT * FROM users where stuid='$add'"));
        $e=mysql_query("SELECT * FROM voting_profile where stugender='F' order by id ASC");
        while($r=mysql_fetch_array($e)){
		?>
	<div class="col-md-4">
		<div class="card">
  			<img class="card-img-top" src="<?php echo $r['stupic'] ?>" alt="image" >
  				<div class="card-body">
    				<h4 class="card-title"><?php echo $r['stuname'] ?></h4><p><?php echo $r['stubio'] ?></p>    
    				<a href="javascript::void(0)" class="btn btn-success" onClick="cwRating(<?php echo $r['id']; ?>,1,'like_count<?php echo $r['id']; ?>')">Vote Me</a>
    				
                    <!-- Like Counter -->
                    <!--a class="btn btn-info" style="color:white;" id="like_count<?php echo $r['id']; ?>">Votes</a-->
                    
                   
  				</div>
		</div>
	</div>
	<?php
}
}else{
	echo'<div class="alert alert-danger" style="margin-left:40%;">Already Voted For This Members(one)</div>';
}
?>
</div>
</div>
</body>
</html>