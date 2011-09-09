<?php include("header.php");?>
<?php include("getuser.php");?>
<?php
	
	include("../game.php");
	$string=getCash()."-";
	$sql="SELECT * FROM gamedata WHERE userid={$usid}";
	$result=mysql_query($sql,$con);
	$row=mysql_fetch_array($result);
	$string .= "{$row['c4']}-{$row['c5']}-{$row['d1']}-{$row['d2']}";
	echo $string;
?>
