<?php include("header.php");?>
<?php include("getuser.php");?>
<?php
	$sql="SELECT money FROM user WHERE userid={$usid}";
	$result=mysql_query($sql,$con);
	$row=mysql_fetch_array($result);
	$string="{$row['money']}-";
	$sql="SELECT * FROM gamedata WHERE userid={$usid}";
	$result=mysql_query($sql,$con);
	$row=mysql_fetch_array($result);
	$string .= "{$row['u1']}-{$row['u2']}-{$row['c1']}-{$row['c2']}-{$row['c3']}";
	echo $string;
?>
