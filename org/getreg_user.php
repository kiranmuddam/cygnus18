
<?php
include 'site-settings.php' ;
$q=$_REQUEST['q'];
$m=mysql_query("SELECT * FROM users where stuid='$q'");
$row=mysql_fetch_array($m);
$num=mysql_num_rows($m);

if($num!=0)
{
	echo '  
    <br><br>
                        <div class="col-md-12">
                        <p> '.$row['stuid'].'</p>
                        <p> '.$row['stuname'].'</p>      
                        <p> '.$row['email'].'</p>
                        <p> '.$row['tzid'].'</p>
                        <p> '.$row['phone'].'</p>
                        <p> '.$row['gender'].'</p>                                                       
                           </div>
                           <br><br>
                             
                                <!-- END PROFILE CONTENT -->';
                            }else{

                             ?>
                             <div class="alert alert-danger">
                             	<i class="fa fa-bullhorn"></i><strong> Sorry,</strong> Requested Username of user is not matches to our records.Please Check it once
                             </div>
                             <?php
                            }
                            ?>
     
