<?php

session_start();
if(isset($_SESSION['stuid']) && !empty($_SESSION['stuid']) && isset($_SESSION['web']) && !empty($_SESSION['web']))
{

unset($_SESSION['stuid']);
unset($_SESSION['web']);
session_destroy();
}

echo "<center><h2>Redirecting to Home page....</h2></center>";
header("location:index.php");
?>
