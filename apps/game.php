<?php
include("../connect.php");
include("fb.php");


function getCash() {
   $query = "SELECT `bidamount`,`winvar` FROM `game_info` WHERE `playerid`='" . $user["id"]  . "' AND `end_time` != '0'";
   $res = mysql_query($query);

   $cash = 1000;
   
   $sarr["0"] = -1;
   $sarr["1"] = 2;

   while ($row = mysql_fetch_array($res)) {
       $cash += $row['bidamount'] * $row[$sarr['winvar']];
   }
   
   return $cash;
}

function getXP() {
    $query = "SELECT COUNT(*) AS `gameid`,`count` FROM `game_info` WHERE `playerid` = '" . $user["id"] . "' GROUP BY `gameid`";
    $res = mysql_query($query);
    $xp = 0;
    while ($row = mysql_fetch_array($res)) {
        $xp += $row['count'] * 20;
    }
    
    return $xp;
}
?>