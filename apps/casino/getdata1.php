<?php include("header.php");?>
<?php
	$sql="SELECT money FROM user WHERE userid={$_POST['user']}";
	$result=mysql_query($sql,$con);
	$row=mysql_fetch_array($result);
	$string="{$row['money']}-";
	$sql="SELECT * FROM gamedata WHERE userid={$_POST['user']}";
	$result=mysql_query($sql,$con);
	$row=mysql_fetch_array($result);
	$string .= "{$row['c4']}-{$row['c5']}-{$row['d1']}-{$row['d2']}";
	echo $string;
?>