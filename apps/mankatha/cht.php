<?php
$rpath = "../";
  include("../game.php");
include("../../connect.php");
	    $q="INSERT into game_info (starttime,bidamount,gameid,playerid) VALUES(now(),'$_SESSION[\'cht\']','4','" . $user["id"] ."')";
	    echo $q;

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
	      mysql_query($q);
	    header('Location:test1.php');
	    exit;
	  }
       
  }
?>	