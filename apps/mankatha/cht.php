<?php
session_start();
if(!isset($_POST['txtchar']))
{
	header('Location:start.php');
	exit;
	
}
else
{
	$_SESSION['cht']=$_POST['txtchar'];
	header('Location:test1.php');
	exit;
}
?>	