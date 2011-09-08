<?php include("header.php");?>
<?php include("getuser.php");?>
<?php
	$sql="SELECT * FROM gamedata WHERE userid={$usid}";
	$result=mysql_query($sql,$con);
	$row=mysql_fetch_array($result);
	$sql="DELETE FROM gamedata WHERE userid={$usid}";
	$result=mysql_query($sql,$con);
	$sql="INSERT INTO gamedata VALUES({$row['userid']},{$row['u1']},{$row['u2']},{$row['d1']},{$row['d2']},{$row['c1']},{$row['c2']},{$row['c3']},{$row['c4']},{$row['c5']},{$_POST['money']})";
	$result=mysql_query($sql,$con);
	$res=mysql_query("INSERT INTO game_info ('playerid','gameid','starttime','endtime','timediff','bidamount','returnpercent') VALUES ({$user["id"]},{$game_array['poker']},{time()},{time()},'0000-00-00 00:00:00',{$_POST['money']},0)");
	echo "";
?>
