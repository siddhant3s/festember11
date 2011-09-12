<?php
//##############################################################
//takes in two arguments
	//1.game hash
	//[ 3.1]1 is for setting the first turn-{default zero}
//returns
	//user id
//##############################################################
	// if 1 set 
		//randomise between 1 and 2 if
//##############################################################
	//set the invloved keys to 1 in either of the user ids 
	//shuffle the card stack
	//set  active game counter=1
	//activate
 //##############################################################

 //##############################################################
	
//##############################################################


function turn($the_game_hash,$first=0)
{
global $conn_pag2;
global $table_allusers;
global $table_allgames;

$this_turn=0;
	if($first)
	{
//##############################################################
			//SET THE R
		$query_get_the_card_stack="select card_stack from '$table_allgames' where game_id='$the_game_hash'";
		$result_get_the_card_stack=mysqli_query($conn_pag2,$query_get_the_card_stack);
		$answer_get_the_card_stack=mysqli_fetch_array($result_get_the_card_stack);
		$the_current_card_stack=$answer_get_the_card_stack['card_stack'];
		$the_new_card_stack=preg_replace("/^0/",'R',$the_current_card_stack,1,$thisreplacementvariable);
		if(!($thisreplacementvariable==1))
			{
			//take an action
			}
		
		//	$the_current_card_stack='R'.$the_current_card_stack;
		$update_the_card_stack="update '$table_allgames' set card_stack='$the_current_card_stack' where game_id='$the_game_hash'";
		$result_the_card_stack=mysqli_query($conn_pag2,$update_the_card_stack);
			if(!mysqli_affected_rows($conn_pag2))
				{
					//take an action
					
				}
//##############################################################
		//the person who reaches the page first gets the first turn
		$the_first_turn_user=get_the_id();
		return $the_first_turn_user;
		exit(1);
		
		
	}


	else
	{
		$the_last_turn=get_the_id($conn_pag2,);
		
	}
}

?>
