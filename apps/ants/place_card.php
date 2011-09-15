<?php
//##############################################################
	//at the root a different string for every action will be passed aasa the ahtml ;;and fetched as the response to the ajax request
			//which simulates the javascript
			//and the card code helps to get the sprires into workk

//##############################################################
	//place_card
//##############################################################
	//to be executed when the inspection inthe function returns 1;;
	//as if some other status is returned i need to show the corressponding javascript error using the moderator script
//##############################################################
	//aparameters
			//the card stack-clue,
			//the card
			//maybe an  optional attack mode
			//statustring--must be status1 or status 2
//##############################################################
		//returns
			//1-
			//0
//##############################################################

function place_card($thecard_stack,$thecard,$attackmode=0,$statustring)
{
//##############################################################
global $conn_pag2;
global $table_allgames;
global $table_allusers;
//##############################################################
		//attack mode different control
if($attackmode)
	{
	
	}
//##############################################################
else
	{
//##############################################################
	//grad the user id
$thecurrentuserid=get_the_id($conn_pag2,);
//##############################################################
	//grab the game hash
	//get the current_gamehash
$result_get_game_hash=mysqli_query($conn_pag2,"select game_id from '$table_allgames' where (id1='$thecurrentuserid' or id2='$thecurrentuserid') and active=1");
$answer_get_the_game_hash=mysqli_fetch_array($result_get_the_game_hash);
$the_game_hash=$answer_get_the_game_hash['game_id'];
//##############################################################
	//extract the status string

$result_get_status_string=mysqli_query($conn_pag2,"select '$statustring' from '$table_allgames' where game_id='$the_game_hash'");
$answer_get_status_string=mysqli_fetch_array($result_get_status_string);
$theold_status_actual=$answer_get_status_string[$statustring];
//##############################################################
	if($thecard_stack='C')
		{
		$thefirstbracketpostion=strpos($theold_status_actual,"(");
		$replacement="(".$thecard.',';
		$thenew_status_actual=str_replace("(",$replacement,$theold_status_actual,1);
		
		}
	
	if($thecard_stack='S1')
		{
		$the
		}
	
	if($thecard_stack='S2')
		{
		
		}

	if($thecard_stack='S3')
		{
		
		}
	
	if($thecard_stack='D')
		{
		
		}
	
	if($thecard_stack='A')
		{
		
		}
	}
}
?>