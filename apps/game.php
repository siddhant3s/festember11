<?php
include("../connect.php");
$rpath = "";
include("fb.php");


function getCash() {
   global $user;
   $query = "SELECT `bidamount`,`winvar` FROM `game_info` WHERE `playerid`='" . $user["id"]  . "'"; //" AND `end_time` != '0'";

   $res = mysql_query($query);
   echo $query;
   $cash = 1000;
   
   $sarr["0"] = -1;
   $sarr["1"] = 1;

   while ($row = mysql_fetch_array($res)) {
       print_r($row);
       echo "### - " .  $sarr[$row['winvar']] . " - ###<br>";
       $cash += $row['bidamount'] * $sarr[$row['winvar']];
   }
   
   return $cash;
}

function getXP() {
    global $user;
    $query = "SELECT COUNT(*) AS `gameid`,`count` FROM `game_info` WHERE `playerid` = '" . $user["id"] . "' GROUP BY `gameid`";
    $res = mysql_query($query);
    $xp = 0;
    while ($row = mysql_fetch_array($res)) {
        $xp += $row['count'] * 20;
    }
    
    return $xp;
}

echo "You have " . getCash() . " dollars in your account.<br>";
echo "Your XP score is " . getXP() . ".<br>";

?>