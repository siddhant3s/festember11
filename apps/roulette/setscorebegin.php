<?php
	
	$res=mysql_query("INSERT INTO game_info (playerid,gameid,starttime,bidamount) VALUES ({$usid},{$game_array['roulette']},now(),{$_POST['money']})");
	$insertid=mysql_insert_id();
	
?>

