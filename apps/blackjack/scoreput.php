<?php

$rpath="../";
include("../game.php");
//$bid=0;
//$ret=0;




$sql="INSERT INTO game_info (playerid,gameid,starttime,bidamount,returnpercent) VALUES('".$user["id"]."',2,CURRENT_TIMESTAMP,'".mysql_real_escape_string($_POST["bid"])."','".mysql_real_escape_string($_POST["ret"])."' ) ";

$result = mysql_query($sql);



?>