<?php
require("site-settings.php");
libxml_use_internal_errors(true);
$myXMLData ="<?xml 	version='1.0' encoding='UTF-8'?><newslist title='Latest News'>";
$num=0;
$not=mysql_query("SELECT * FROM notifications WHERE visibility='1' ORDER BY nid DESC LIMIT 2");
while($notii=mysql_fetch_array($not))
{
$num++;
$clr="";
if($num%1==0){$clr="red";}
if($num%2==0){$clr="green";}
if($num%3==0){$clr="blue";}
if($num%3==0){$clr="yellow";}
$myXMLData=$myXMLData."<news category=".$clr." url='#' date=".$notii['added_date'].">";	
$myXMLData=$myXMLData."<headline>".$notii['title']."</headline>";	
$myXMLData=$myXMLData."<detail>".$notii['description']."</detail></news>";	
}
$myXMLData=$myXMLData."</newslist>";
echo $myXMLData;
?> 
