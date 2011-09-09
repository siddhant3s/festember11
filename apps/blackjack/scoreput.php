<?php

$rpath="../";
include("../fb.php");
include("../reqconnect.php");
$bid=0;
$ret=0;
$con = mysql_connect('localhost', 'festember11', 'abc123');
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("ajax_demo", $con);

//$sql="SELECT * FROM game_info WHERE playerid = '".$user[id]."'";
$sql="INSERT INTO game_info 
(playerid,gameid,starttime,bidamount,returnpercent) VALUES('".$user[id]."',2,CURRENT_TIME_STAMP,'".$bid."','".$ret."' ) ";

$result = mysql_query($sql);



mysql_close($con);
?>