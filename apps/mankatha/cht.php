<?php
$rpath = "../";
  include("../game.php");
include("../../connect.php");
if(!isset($_POST['txtchar']))
{
	header('Location:start.php');
	exit;
}
else
  { $money=0;
    $money=getCash();
      	if($_POST['txtchar']>$money)
	  { 
	    header('Location:start.php?alertnobalance=1');
	    exit;
	  }
	else
	  { $_SESSION['cht']=$_POST['txtchar'];
	    $date=date_create();

	    $d=date_format($date,'Y-m-d H:i:s');
	    $q="INSERT into game_info (starttime,bidamount) VALUES(now(),{$_SESSION['cht']}) where playerid='" . $user["id"] . "'";
	      mysql_query($q);
	    header('Location:test1.php');
	    exit;
	  }
       
  }
?>	