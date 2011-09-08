<?php include("header.php");?>
<?php include("getuser.php");?>
<?php include("../gamearray.php");?>
<?php
	$sql="SELECT * FROM gamedata WHERE userid={$usid}";
	$result=mysql_query($sql,$con);
	$row=mysql_fetch_array($result);
	$sql="DELETE FROM gamedata WHERE userid={$usid}";
	$result=mysql_query($sql,$con);
	$sql="INSERT INTO gamedata VALUES({$row['userid']},{$row['u1']},{$row['u2']},{$row['d1']},{$row['d2']},{$row['c1']},{$row['c2']},{$row['c3']},{$row['c4']},{$row['c5']},{$_POST['money']})";
	$result=mysql_query($sql,$con);
	$sql="SELECT * FROM game_info WHERE gameid={$game_array['poker']} AND endtime='0000-00-00 00:00:00'";
	$result=mysql_query($sql,$con);
	if(!$result){
	$time=time();
	$res=mysql_query("INSERT INTO game_info (playerid,gameid,starttime,bidamount) VALUES ({$user["id"]},{$game_array['poker']},{$time},{$_POST['money']})",$con);
	}
	else{
		$row=mysql_fetch_array($result);
		$money=$row['bitamount']+$_POST['money'];
		$res=mysql_query("UPDATE game_info SET bitamount={$money} WHERE gameid={$game_array['poker']} AND endtime='0000-00-00 00:00:00' ,$con);
	}
	echo "";
?>
