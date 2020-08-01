<?php
require("site-settings.php");
if(isset($_POST['cou'])){
	$nid=mysql_real_escape_string(trim(strip_tags($_POST['cou'])));
		echo $nid;
mysql_query("UPDATE notifications SET views=views+1 WHERE nid='$nid'");
}
?> 
