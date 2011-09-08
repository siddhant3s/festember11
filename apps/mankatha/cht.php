<?php

$rpath = "../";
  include("../game.php");
	    $q="INSERT into game_info (`playerid`,`gameid`, `starttime`,`bidamount`) VALUES(" . $user["id"] . ",'4' , now(),{$_SESSION['cht']})";


if(!isset($_POST['txtchar']))
{
	header('Location:start.php');
	exit;
}
include("../../connect.php");

if(isset($_POST['txtchar']))
  { $money=0;
    $money=getCash();
      	if($_POST['txtchar']>$money)
	  { 
	    header('Location:start.php?alertnobalance=1');
	  }
	else
	  { $_SESSION['cht']=$_POST['txtchar'];
	    $date=date_create();

	    $d=date_format($date,'Y-m-d H:i:s');
	      header('Location:test1.php');
	  }
	exit;
  }
?>	