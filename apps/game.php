<?php
include($rpath . "../connect.php");
include($rpath . "fb.php");

function getCash() {
   global $user;
   $query = "SELECT SUM(`bidamount` * `returnpercent` / 100) - SUM(`bidamount`) AS `cash` FROM `game_info`  WHERE `playerid`='" . $user["id"]  . "'";

   $res = mysql_query($query);
   $row = mysql_fetch_array($res);
   $cash = $row['cash'] + 1000;
   error_log("###### user id : " . $user['id']);
   error_log("###### query : " . $query);
   error_log("###### cash val : " . $row['cash']);   
   return $cash;
}

function getXP() {
    global $user;
    $query = "SELECT`gameid`, COUNT(*) AS `count` FROM `game_info` WHERE `playerid` = '" . $user["id"] . "' GROUP BY `gameid`";
    $res = mysql_query($query);
    $xp = 0;
    while ($row = mysql_fetch_array($res)) {
        $xp += $row['count'] * 20;
    }
    
    return $xp;
}

//echo "You have " . getCash() . " dollars in your account.<br>";
//echo "Your XP score is " . getXP() . ".<br>";
?>