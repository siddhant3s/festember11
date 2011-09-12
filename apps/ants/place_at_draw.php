<?php
//##############################################################
	//place_at_draw 
//##############################################################
	//take in the card returned by the draw and the game id
//##############################################################
	//returns if the card can be placed at the draw pile
		//a permission 0- 1
//##############################################################
function place_at_colony($card_in,$gameid)
{

global $conn_pag2;
//##############################################################
	$the_current_user=get_the_id($conn_pag2,);
//##############################################################
	//check for the card at the colony
$result_extract_the_referer_string=mysqli_query($conn_pag2,"select id1,id2 from '$table_allgames' where '$gameid'='$gameid'");
$answer_extract_the_referer_string=mysqli_fetch_array($result_extract_the_referer_string);
	
if($the_current_user==$answer_extract_the_referer_string['id1'])
	{$referer_string='status1';$the_field_key=1;}
else if($the_current_user==$answer_extract_the_referer_string['id2'])
	{$referer_string='status2';$the_field_key=2;}
//##############################################################
	//extract the colony cards
$result_get_the_status_string=mysqli_query($conn_pag2,"select '$status_referer' from '$table_allgames' where game_id='$gameid'");
$answer_get_the_status_string=mysqli_fetch_array($result_get_the_status_string);
$the_current_status_string=$answer_get_the_status_string[$status_referer];
$colony_cards_availed=preg_match("/,([a-z,]+),]/",$the_current_status_string,$all_the_colony_cards);
$the_last_colony_card=
	// $the_string_to_be_passed='';//reconsider this
//##############################################################

$the_card_position=priority($the_last_colony_card,$card_in,$the_field_key);

}		
?>