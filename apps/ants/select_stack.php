<?php
//######################################################
	//select the appropiate stack
//######################################################
function select_stack($permission=0)
{
//######################################################
global $conn_pag2;
global $table_allusers;
global $table_allgames;
global $the_cards_priority_string;
//######################################################

if(!$permission)
	{
	//take an action
		//return something
	exit();
		
	}
else
	{
	//get the current card the colony
//######################################################
	//get the id
	$myid=get_the_id($conn_pag2,);
//######################################################
	//find out which set 1 or 2
	$result_get_the_referer=mysqli_query($conn_pag2,"select id1,id2 from '$table_allgames' where (id1='$myid' or id2='$myid')and active=1 ");
	$answer_get_the_referer=mysqli_fetch_array($result_get_the_referer);
	
	if($myid==$answer_get_the_referer['id1'])
			{	$the_referer_int=1;	$the_game_hash=md5($myid.$answer_get_the_referer['id2']);}
	if($myid==$answer_get_the_referer['id2'])
			{	$the_referer_int=2;	$the_game_hash=md5($answer_get_the_referer['id2'].$myid);}
	if(!($myid==$answer_get_the_referer['id1'] || $myid==$answer_get_the_referer['id2']))
			{	/*  take an action*/	}
	$root_my_status_string='status'.$the_referer_int;
	
//######################################################
		//fetch the status_string
	$result_get_the_current_status=mysqli_query($conn_pag2,"select '$root_my_status_string' from '$table_allgames' where game_id='$the_game_hash' and active=1");
	$answer_get_the_current_status=mysqli_fetch_array($result_get_the_current_status);
	$my_status_string=$answer_get_the_current_status[$root_my_status_string];
	
//######################################################
		//fetch-the colony

	$the_latest_colony_card=;
//######################################################
		//fetch the stack
	

//######################################################
		//decide 
			//get the next card in priority
		$postion_of_the_current_card=strpos($the_cards_priority_string,$the_latest_colony_card[2]);
		$the_next_expected_card=$the_cards_priority_string[$postion_of_the_current_card+1];
//######################################################
			//check if that card or black eyed jack exists on stack or not
			//check if the any card in your stack is in concurrence to that in thr opponent
					//if the 'yo; 	
	}

}

?>