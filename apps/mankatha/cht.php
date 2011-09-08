<?php
$rpath = "../";
  include("../game.php");
session_start();
if(!isset($_POST['txtchar']))
{
	header('Location:start.php');
	exit;
}
else
  { $money=0;     
    $money=getCash();
       echo $money;
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