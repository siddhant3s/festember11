<?php
session_start();

//##############################################################
require_once("allglobals.php");
require_once("start_game.php");
require_once("get_the_id.php");
//##############################################################
	//mysqli_connections
$conn_proceed=mysqli_connect($mysqli_host,$mysqli_username,$mysqli_password,$central_db);

//##############################################################
	//file to be run at the proceed level
		//prompt the user 5 sec remaining 4 sec remaining etc
	//bets have to appear on this page too
//##############################################################

//##############################################################
	//set the invloved keys to 1 in either of the user ids 
	//shuffle the card stack
	//set  active game counter=1
	//activate
//##############################################################

//##############################################################
	//function to be used in proceed.php
//##############################################################


//##############################################################
	//first get the current user id from the api
	//check the invloved key for the user id from the allusers database
	//if it is an id
	//check that the invloved key for the id is 2
	// if yes go on and make the other involved key=this user id
//##############################################################


//##############################################################
	//get the  current user id from api

$the_current_user_id=;
//##############################################################


//##############################################################
$query_check_the_current_involved="select involved from '$table_allusers' where user_id='$the_current_user_id'";
$result_check_the_current_involved=mysqli_query($conn_proceed,$query_check_the_current_invloved);
$answer_check_the_current_involved=mysqli_fetch_array($query_check_the_current_invloved);
$involved_for_current_user=$answer_check_the_current_invloved['involved'];
	if(($involved_for_current_user!=1) && (($involved_for_current_user!=0) && ($involved_for_current_user!=1)))
	{
	$the_opponent_user_id=$involved_for_current_user;
	}
	else
	{
	//do something
	}
$query_check_the_opponent_involved="select involved from '$table_allusers' where user_id='$the_opponent_user_id'";
$result_check_the_opponent_involved=mysqli_query($conn_proceed,$query_check_the_opponent_invloved);
$answer_check_the_opponent_involved=mysqli_fetch_array($query_check_the_opponent_invloved);
$the_counter_check=$answer_check_the_opponent_involved['involved'];
//##############################################################


//##############################################################
	//check if the the opponents invloved and current user id are NOT same
if($the_counter_check!=$the_current_user_id)
	{	
	//header
	}
//##############################################################

//##############################################################

// to some way to extract the time lag bet wwen the othr user so that both of them start at the same time approximately
//##############################################################
//##############################################################
	//get the betted amounts
$the_current_user_bet=;	
$the_opponent_bet=;	
//##############################################################

	//ALL HTML GOES HERE





//##############################################################
if(start_game($the_current_user_id,$the_opponent_user_id,$the_current_user_bet,$the_opponent_bet))
	{
	//do something
	}

//##############################################################
	//whisk him on to the main game page
		mysqli_close($conn_proceed);
//##############################################################
?>