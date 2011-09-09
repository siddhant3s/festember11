<?php
$rpath = "../";
include("../game.php");

if(!isset($_POST['txtchar']))
{
    	header('Location:start.php');
	exit;
}
else
{
	$money=0;
	$money=getCash();
	if($_POST['txtchar']>$money)
	{ 
	    header('Location:start.php?alertnobalance=1&m1=' . $money . "&m2=" . $_POST['txtchar']);
	    exit;
	}
	else
	{
	    $_SESSION['cht']=$_POST['txtchar'];
	    $q="INSERT INTO game_info( `starttime` , `bidamount` , `gameid` , `playerid`    VALUES (now(), ".$_SESSION['cht'].", '4', '" . $user["id"] ."' )";
	    error_log("###### sql query - " . $q);
	    mysql_query($q) or die("failed to execute query!");
      	    header('Location:test1.php');
    	    exit;
	}
}
?>	