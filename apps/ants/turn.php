<?php
//##############################################################
//takes in two arguments
	//1.game hash
	//[ 3.1]1 is for setting the first turn-{default zero}
//returns
	//user id
//##############################################################
	// if 1 set 
		
//##############################################################

function turn($the_game_hash,$first=0)
{
//##############################################################
global $user;
global $table_allusers;
global $table_allgames;

//##############################################################
$value_to_be_returned="0";
$the_first_turn_user=$user['id'];
$this_turn=0;

//##############################################################


	if($first)
	{
//##############################################################

		$query_get_the_card_stack="select card_stack from $table_allgames where game_id='$the_game_hash'";
		$result_get_the_card_stack=mysql_query($query_get_the_card_stack);
		$answer_get_the_card_stack=mysql_fetch_array($result_get_the_card_stack);
		$the_current_card_stack=$answer_get_the_card_stack['card_stack'];
		$the_new_card_stack=preg_replace("/^0/",'R',$the_current_card_stack,1,$thisreplacementvariable);
		if(!($thisreplacementvariable==1))
			{
				whisk(56);
				exit(1);
			}
		
		//	$the_current_card_stack='R'.$the_current_card_stack;
		$update_the_card_stack="update $table_allgames set card_stack='$the_current_card_stack' where game_id='$the_game_hash'";
		$result_the_card_stack=mysql_query($update_the_card_stack);
			if(!mysql_affected_rows())
				{
					whisk(93);
					exit(1);
					//take an action
					
				}
//##############################################################
	//get the opponent
$opponent_fetch=mysql_query("select opponent from $table_allusers where user_id='$the_first_turn_user'");
$answer_opponent_fetch=mysql_fetch_array($opponent_fetch);
			if(!$answer_opponent_fetch)
				{
					whisk(96);
					exit(1);
				}
			else if($answer_opponent_fetch)
				{
					$opponent=$answer_opponent_fetch['opponent'];

				}
//##############################################################
		//the person who reaches the page first gets the first turn
			if($opponent=='AI')
				{
				error_log("XXXXXXXXXXXXXX(((-1-)))XXXXXXXXXXXXXX".$the_game_hash."%%%%%%%%%%%%%%%%%".$the_first_turn_user);
					return $the_first_turn_user;
					exit(1);
				}
	//guess its redundant
	error_log("XXXXXXXXXXXXXX(((-2-)))XXXXXXXXXXXXXX".$the_game_hash."%%%%%%%%%%%%%%%%%".$the_first_turn_user);
	return $the_first_turn_user;
	exit(1);
		
		
	}
	else
	{
		error_log("XXXXXXXXXXXXXX(((-3-)))XXXXXXXXXXXXXX".$the_game_hash."%%%%%%%%%%%%%%%%%".$the_last_turn);
		$the_last_turn=$user['id'];
		return $the_last_turn;
		exit(1);		
	}
}
?>