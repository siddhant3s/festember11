<?php
//##############################################################
//takes in two arguments
	//1.game hash
	//[ 3.1]1 is for setting the first turn-{default zero}
//returns
	//user id-if this is the first person to hit the page
	//&&&user_id if the page has already been hit
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
$not_the_first_hit='0';
$the_last_turn="";
$return_the_current_id=$the_first_turn_user;
//##############################################################
	//check for the next key
$the_validation=mysql("select next from $table_allgames where game_id='$the_game_hash' and active='1'");
$the_validation_answer=mysql_fetch_array($the_validation);
$the_actual_next_in_db=$the_validation_answer['next'];
if($the_actual_next_in_db!=$the_first_turn_user)
	{
		whisk(88);
		exit(1);
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



//##############################################################
	if($first)
	{
//##############################################################
		$query_get_the_card_stack="select card_stack from $table_allgames where game_id='$the_game_hash'";
		$result_get_the_card_stack=mysql_query($query_get_the_card_stack);
		$answer_get_the_card_stack=mysql_fetch_array($result_get_the_card_stack);
		$the_current_card_stack=$answer_get_the_card_stack['card_stack'];
		$the_new_card_stack=preg_replace("/^0/",'R',$the_current_card_stack,1,$thisreplacementvariable);
//##############################################################
		if($thisreplacementvariable)
			{
			$not_the_first_hit=0;
			}
		else 	
			{
			$not_the_first_hit=1;
			}
		if(!$not_the_first_hit)
		{
		//	$the_current_card_stack='R'.$the_current_card_stack;
		$update_the_card_stack="update $table_allgames set card_stack='$the_new_card_stack',next='$the_first_turn_user' where game_id='$the_game_hash'";
		
		$result_the_card_stack=mysql_query($update_the_card_stack);
		error_log("XXXXXXXXXXXXXX(((-000-)))XXXXXXXXXXXXXX".mysql_error()."%%%%%%%%%%%%%%%%%".$the_first_turn_user);
			if(!mysql_affected_rows())
				{
					whisk(93);
					exit(1);
					//take an action	
				}
		}
		else if($not_the_first_hit==1)
		{
		$the_last_turn="&&&";
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
		error_log("XXXXXXXXXXXXXX(((-3-)))XXXXXXXXXXXXXX".$return_the_current_id."%%%%%%%%%%%%%%%%%".$the_last_turn);
		return $return_the_current_id;
		exit(1);		
	}
}
?>