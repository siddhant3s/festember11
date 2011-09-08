<?php
include('../game.php');
$money=getCash();
session_start();
if(!isset($_POST['txtchar']))
{
	header('Location:start.php');
	exit;
}
else
  {       echo $money;
	if($_POST['txtchar']>$money)
	  { 
	    header('Location:start.php?alertnobalance=1');
	  }
	else
	  { $_SESSION['cht']=$_POST['txtchar'];
	    header('Location:test1.php');
	  }
	exit;
}
?>	