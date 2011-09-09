<?php

$rpath="../";
include("../game.php");
//$bid=0;
//$ret=0;



//$sql="SELECT * FROM game_info WHERE playerid = '".$user[id]."'";
$sql="INSERT INTO game_info 
(playerid,gameid,starttime,bidamount,returnpercent) VALUES('".$user[id]."',2,CURRENT_TIME_STAMP,'".$_POST["bid"]."','".$_POST["ret"]."' ) ";

$result = mysql_query($sql);




?>