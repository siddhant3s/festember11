<?php
session_start();
//##############################################################
require_once("allglobals.php");
require_once("turn.php");
require_once("get_the_id.php");



//##############################################################
$conn_pag2=mysqli_connect($mysqli_host,$mysqli_username,$mysqli_password,$central_db);
//##############################################################
//main game page

	//once the html is laid
			//call the turn with1 in case the first character in the card stack is not
//##############################################################
	//get the current game hash either by this or by that

$the_current_game_hash=;
//##############################################################

//##############################################################
$query_get_the_card_stack="select card_stack from '$table_allgames' where game_id='$the_current_game_hash'";
$result_get_the_card_stack=mysqli_query($conn_pag2,$query_get_the_card_stack);
$answer_get_the_card_stack=mysqli_fetch_array($result_get_the_card_stack);
$the_current_card_stack=$answer_get_the_card_stack['card_stack'];
if(($the_current_card_stack[0]!='R'))
	{
		$the_next_turn_id=turn($the_current_game_hash,1);//first turn set optional as one
		//start the game-prompt this user
		//set some marker in the status div of this user{EG-you start first}
		$open_stacks_returned=open_stacks($the_next_turn_id);
		// highight open  stacks 
		
		
	}
else if(($the_current_card_stack[0]!='R') && ($the_current_card_stack[1]!='`'))
	{
		//game already started the opponent has the first turn
			//prompt this user
			//set some marker in the status div of this user{EG-your opponent first}
			7
		
	}
//##############################################################
mysqli_close($conn_pag2);
//##############################################################
?>