<?php
$rpath = "../";
include("../game.php");
include("../../connect.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Score Page</title>
</head>

<body>
 <p align="center">
   <?php
$bid=500;
$iid=$user["id"];
$time=$_POST['time'];
 if($time<60) $percent=200;
	   else if($time<120) $percent=180;
	   else if($time<180) $percent=160;
	   else if($time<240) $percent=140;
	   else if($time<300) $percent=120;
	   else $percent=100;
	
$query="UPDATE game_info SET returnpercent = $percent , endtime = now() WHERE playerid = $iid AND gameid = '6' AND endtime = '0000-00-00 00:00:00'";
	
	
	  $result = mysql_query($query)
    or die('Error querying database.');

 ?>
</body>
</html>
