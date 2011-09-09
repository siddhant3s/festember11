<?php
	
include("getuser.php");
include("../../connect.php");0
	if(isset($_GET['num']))
	$num=$_GET['num'];
	$sql="UPDATE roulette_verify SET predict_num={$num} WHERE username={$usid}";
	$result=mysql_query($sql);
?>

