<?php
//##############################################################
	//card_in_others_colony_inspection
//##############################################################
	//inspect if the attacking is possible
//##############################################################
	//takes in 	
				//the_current_card
				//the field key
//##############################################################
		//returns the status
		//if already_reinforced->return >>(-10)
		//if ace is current_card ->return>>(-20)
		//if the card_on_top is king ->return(-15)
		//if yes return -> return (1)
		//if not possibe as the card is not appropiate in rank->return (-7)
		//if not appropiate as of the users_original_suite ->(-1)
//##############################################################
	//decide whatis fieldkey
//##############################################################
function card_in_others_colony_inspection($thecurrentcard,$thefieldkey)
{
//##############################################################
global $conn_pag2,
global $table_allusers;
global $table_allgames;
global $the_cards_priority_string;
//##############################################################
	//thecurrentuserid
$thecurrentuserid=get_the_id($conn_pag2,);
//##############################################################
	//get the current_gamehash
$result_get_game_hash=mysqli_query($conn_pag2,"select game_id from '$table_allgames' where (id1='$thecurrentuserid' or id2='$thecurrentuserid') and active=1");
$answer_get_the_game_hash=mysqli_fetch_array($result_get_the_game_hash);
$the_game_hash=$answer_get_the_game_hash['game_id'];
//##############################################################

	//invert the status string
	if($fieldkey='status1'){$fieldkey='status2';}
	else if($fieldkey='status2'){$fieldkey='status1';}
	else
		{
			//take an action
		}
//##############################################################
	//extract the cards already in the draw pile
$result_extract_the_status_string=mysqli_query($conn_pag2,"select '$fieldkey'' from '$table_allgames' where game_id='$the_game_hash'");
$answer_extract_the_status_string=mysqli_fetch_array($resulut_extract_the_status_string);
$status_string=$answer_extract_the_status_string[$fieldkey];
	//use pregmatch an stuff to get the draw pile  between first ( and first )



$the_draw_pile=;
//##############################################################
	//last card
$the_draw_pile_array=explode(',',$the_draw_pile);
$the_last_card=$the_draw_pile_array[0];
if($thecurrentcard[0]==$the_last_card[0])
{
return (-1);
}
//##############################################################
if($the_current_card[2]=='a')
{
return (-20);
}

if($the_current_card[2]=='k')
{
return (-15);
}
//##############################################################
if($thecurrentcard[0]!=$the_last_card[0])
{
$the_rank_required=$thelast_card[2];
	//count number of occurences
	$the_occurences_array=preg_grep("/$the_rank_required/",$the_draw_pile_array);
	$occurences=0;
		foreach($the_occurences_array as $tor)
		{
		$occurences+=1;
		}
	if(($thecurrent_card[2]==$the_last_card[2])&&($occurences==1))
	{
	return (1);
	}
	else if(($thecurrent_card[2]==$the_last_card[2])&&($occurences==2))
	{
	return (-10);
	}
	else
	{
		//report action
	}
	
	
}



}
