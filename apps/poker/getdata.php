<?php include("../../connect.php");?>
<?php include("getuser.php");?>
<?php
	$mon=getCash();
	include("../game.php");
	echo $_POST['id'];
	if($_POST['id']==1){
	$string="{$mon}-";
	$sql="SELECT * FROM gamedata WHERE userid={$usid}";
	$result=mysql_query($sql,$con);
	$row=mysql_fetch_array($result);
	$string .= "{$row['u1']}-{$row['u2']}-{$row['c1']}-{$row['c2']}-{$row['c3']}";
	echo $string;
	}
	else if($_POST['id']==2){
		
	$string="{$mon}-";
	$sql="SELECT * FROM gamedata WHERE userid={$usid}";
	$result=mysql_query($sql,$con);
	$row=mysql_fetch_array($result);
	$string .= "{$row['c4']}-{$row['c5']}-{$row['d1']}-{$row['d2']}";
	echo $string;
	}
?>
