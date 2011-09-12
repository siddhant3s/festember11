<?php
//##############################################################
	//draw
	//still to decide whether game id needs to be passed here and in the draw_from_slot  
//##############################################################
	//acts at the mouse click of the user
	//via an ajax request
	//put a ` at the next to be drawn position
//##############################################################
function draw_from_draw()
{
global $conn_pag2;
global $table_allusers;
global $table_allgames;

//##############################################################
	//extract the game id

//##############################################################
	//extract the card stack
$result_extract_the_card_stack=mysqli_query($conn_pag2,"select card_stack from '$table_allgames' where game_id='$the_game_id'");
$answer_extract_the_card_stack=mysqli_fetch_array($result_extract_the_card_stack);
$the_current_card_stack=$answer_extract_the_card_stack['card_stack'];
//##############################################################
	//look for the `
if(!preg_match("/`/",$the_current_card_stack))
	{
		//the first draw-insert a ` after the second comma
		//it has to return the card 
		//at this situation the card stack ll be like R0,ret,sgh,      
		$the_next_card=substr($the_current_card_stack,3,3);
		//remove the second zero
		//at this situation the card stack ll be like R,ret,sgh,      
		$the_current_card_stack=preg_replace("/^R0/","R",$the_current_card_stack,1);
		$new_card_stack=str_replace("$the_next_card,","",$the_current_card_stack,1);
	}
else
	{
		//get the postion of the ` and take it 4 characters ahead
//##############################################################
			//fix that here
		$position_of_this_entry=strpos($the_current_card_stack,'`');
		$the_current_card_stack=$the_current_card_stack=preg_replace("/`/","",$the_current_card_stack,1);
		$the_next_card=substr($the_current_card_stack,$position_of_this_entry,3);
		$new_card_stack=str_replace("$the_next_card,","",$the_current_card_stack,1);
//##############################################################

//##############################################################

	}


//##############################################################
	//update the database
$result_set_the_new_card_stack=mysqli_query($conn_pag2,"update '$table_allgames' set card_stack='$new_card_stack' where game_id='$the_game_id'");	
if($mysqli_affected_rows($conn_pag2)!=1)
	{
	//take an action
	}

//##############################################################

return $the_next_card;
}
?>
