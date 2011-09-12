<?php
//##############################################################
	//think about a method to check thst the slot four is generated only in a special mode
//##############################################################
	//draw from slot 
//##############################################################
	//take the slot number
	 	 game id
//##############################################################
	//returns the card  
//##############################################################
function draw_from_slot($slotnumber,$gameid)
{

global $conn_pag2;
global $table_allusers;
global $table_allgames;
//##############################################################
if($slotnumber>4 || $slotnumber<1)
	{
	//report an error

	}
//##############################################################
//get the current user id
$the_current_user=get_the_id($conn_pag2,);
//##############################################################
	//which status
$result_get_the_status_code=mysqli_query($conn_pag2,"select id1,id2 from '$table_allgames' where game_id='$gameid'");
$answer_get_the_status_code=mysqli_fetch_array($result_get_the_status_code);
if($the_current_user=$answer_get_the_status_code['id1']){$status_referer='status1';}
else if($the_current_user=$answer_get_the_status_code['id2']){$status_referer='status2';}
//##############################################################
	//get the slotnumber slot card
$result_get_the_status_string=mysqli_query($conn_pag2,"select '$status_referer' from '$table_allgames' where game_id='$gameid'");
$answer_get_the_status_string=mysqli_fetch_array($result_get_the_status_string);
$the_current_status_string=$answer_get_the_status_string[$status_referer];
$slot_cards_availed=preg_match("/{([a-z,]+)}]/",$the_current_status_string,$all_the_slot_cards);
	//cards in theis form {abc,def,ghi,jkl}

if($slotnumber==1)
	{
	$returned_card=substr($all_the_slot_cards,1,3);
	$counter_check=str_replace("$returned_card","000",$the_current_status_string,1);
	}
else if($slotnumber==2)
	{
	$returned_card=substr($all_the_slot_cards,5,7);
	$counter_check=str_replace("$returned_card","000",$the_current_status_string,1);
	}
else if($slotnumber==3)
	{
	$returned_card=substr($all_the_slot_cards,8,10);
	$counter_check=str_replace("$returned_card","000",$the_current_status_string,1);
	}	
//##############################################################
	if($counter_check==$the_current_status_string)
		{
			//take an action
		}
//##############################################################
	//update the database
	$set_the_new_status_string=mysqli_query($conn_pag2,"update '$table_allgames' set '$status_referer'='$counter_check' where game_id=$gameid");
	if(mysqli_affected_rows($conn_pag2))
		{
		//take an action
		}
//##############################################################

return $returned_card;
}