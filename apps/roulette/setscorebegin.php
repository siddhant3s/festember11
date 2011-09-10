<?php
	error_log("#####_______________Playerid inside setscorebegin.php:".$usid);
	$sql="INSERT INTO game_info (playerid,gameid,starttime,bidamount) VALUES (" . $usid . ",{$game_array['roulette']},now(),{$_POST['money']})";
	$res=mysql_query($sql);
	$insertid=mysql_insert_id();
	
?>

