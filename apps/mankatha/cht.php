<?php
$rpath = "../";
  include("../game.php");
include("../fb.php");
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
	    $date=date_create();
	    $connection=mysql_connect("localhost","festember","vegas11");

   if(!$connection){
	      die("Databaase connection failed:" . mysql_error());
	    }
    $db_select=mysql_select_db("festember11",$connection);
	    if(!$db_select){
	      die("Database connection failed:" . mysql_error());
	    }
	    $d=date_format($date,'Y-m-d H:i:s');
	    $q="INSERT into game_info(`starttime`,`bidamount`) VALUES('{$d}','{$_SESSION['cht']}') where playerid='{$user["id"]}'";
	    mysql_query($q,$connection);
	    mysql_close($connection);
	    header('Location:test1.php');
	  }
	exit;
}
?>	