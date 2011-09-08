<?php
include("../connect.php");
include("fb.php");

$query = "SELECT `bidamount`,`winvar` FROM `game_info` WHERE `playerid`='" . $user["id"]  . "'";
$res = mysql_query($query);

$cash = 1000;

$sarr["0"] = -1;
$sarr["1"] = 2;

while ($row = mysql_fetch_array($res)) {
    $cash += $row['bidamount'] * $row[$sarr['winvar']];
}

echo "You have " . $cash . " in your account!";
?>