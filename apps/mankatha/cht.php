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
{
	$money=0;
	$money=getCash();
	echo $money;
	if($_POST['txtchar']>$money)
	{ 
	    header('Location:start.php?alertnobalance=1');
	    exit;
	}
	else
	{
	    $_SESSION['cht']=$_POST['txtchar'];
	    $q="INSERT INTO game_info( `starttime` , `bidamount` , `gameid` , `playerid`    VALUES (now(), ".$_SESSION['cht'].", '4', '" . $user["id"] ."' )";
	    mysql_query($q);
      	    header('Location:test1.php');
    	    exit;
	}
}
?>	