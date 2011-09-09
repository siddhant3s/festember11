<?php

$rpath = "../";
  include("../game.php");
	    $q="INSERT into game_info (starttime,bidamount) VALUES(now(),{$_SESSION['cht']}) where playerid='" . $user["id"] . "'";
	    echo $q;
die;

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
	    $q="INSERT into game_info (starttime,bidamount) VALUES(now(),{$_SESSION['cht']}) where playerid='" . $user["id"] . "'";
	    echo $q;
	      //mysql_query($q);
	    header('Location:test1.php');
	  }
	exit;
  }
?>	