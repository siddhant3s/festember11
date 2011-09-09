<?php 
 include("../../connect.php");
 include("getuser.php");
 include("../game.php"); 
 include("../gamearray.php");

	$cards = range(0, 51);
	shuffle($cards);
	$u1=$cards[0];
	$u2=$cards[1];
	$d1=$cards[2];
	$d2=$cards[3];
	$c1=$cards[4];
	$c2=$cards[5];
	$c3=$cards[6];
	$c4=$cards[7];
	$c5=$cards[8];
	$sql="SELECT * FROM gamedata WHERE userid={$usid}";
	$result=mysql_query($sql);
	if(!$result){
		$sql="INSERT INTO gamedata VALUES({$usid},{$u1},{$u2},{$d1},{$d2},{$c1},{$c2},{$c3},{$c4},{$c5})";
		$result=mysql_query($sql);
	}
	else{
		$sql="DELETE FROM gamedata WHERE userid={$usid}";
		$result=mysql_query($sql);
		$sql="INSERT INTO gamedata VALUES({$usid},{$u1},{$u2},{$d1},{$d2},{$c1},{$c2},{$c3},{$c4},{$c5},0)";
		$result=mysql_query($sql);
	}
	echo getCash();
?>
