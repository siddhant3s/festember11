<?php

$rpath="../";
include("../game.php");
//$bid=0;
//$ret=0;



//$sql="SELECT * FROM game_info WHERE playerid = '".$user[id]."'";
$sql="SELECT * FROM game_info WHERE playerid = '".$user['id']."' AND gameid = 2 ";
$result = mysql_num_rows(mysql_query($sql));
if(!$result)
{
$sql="INSERT INTO game_info (playerid,gameid,starttime,bidamount,returnpercent) VALUES('".$user[id]."',2,CURRENT_TIMESTAMP,'".mysql_real_escape_string($_POST["bid"])."','".mysql_real_escape_string($_POST["ret"])."' ) ";

$result = mysql_query($sql);
}
else
{
$sql="UPDATE game_info SET returnpercent ='".mysql_real_escape_string($_POST["ret"])."', endtime = now(),bidamount='".mysql_real_escape_string($_POST["bid"])."' WHERE playerid = '".$user["id"]."' AND gameid = 2  ";
$result = mysql_query($sql);
}


?>