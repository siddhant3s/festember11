<?php
//##############################################################
	//card-in_draw_inspection
//##############################################################	//takes in two arguments
		//last colony card
		//and current card under check
		
//##############################################################
	//returns one integer
			//for numbered cards
		//if p(cc)=p(lc)+1>>1
		//if p(cc)=p(lc)+2>>2
			//for special cards
		//if p(cc)=king>>30
		//if p(cc)=queen>>20
		//if p(cc)=ace>>50
		//if p(cc)=normaljack=11
		//if p(cc)=one-eyedjack>>40
		//if p(cc)=blackeyedjack >>70
//##############################################################
	//return values
		//-1>>not the correct color
		//1>>if it is the expected next card
		//0>>if it lies far forward
		//11>>same as the current card--reinforcement
		//15>>car down the ranks ie the card has already been put on the draw pile ;;(but it is not the cyrrent card) note
//##############################################################


function card_in_draw_inspection($lastcolonycard,$currentcard)
{
//##############################################################
global $table_allusers;
global $table_allgames;
global $conn_pag2;
global $cards_priority_string;
//##############################################################
	//get the color of the last colony card 
$the_acting_color=$lastcolonycard[0];
	//the current card color
$the_given_color=$currentcard[0];
//##############################################################
if($the_acting_color!=$the_given_color){$priorityint=(-1);}
//##############################################################
else
   {
	$the_current_postion_of_card=$lastcolonycard[2];
	$the_postion_of_the_next_expected_card=$currentcard[2];
	//locate the current_postion using the cards priority string
	$the_current_postion_of_card_counter=strpos($cards_priority_string,$the_current_postion_of_card);
	//get the postion of the current card to be inserted
	$the_next_expected_card_counter=strpos($cards_priority_string,$the_postion_of_the_next_expected_card);
//##############################################################
		//log to custom error	
	if(!(isset($the_current_postion_of_card_counter)))
			{
				//take an action
			}
	if(!(isset($the_next_expected_card_counter)))
			{
				//take an action
			}
//##############################################################
	
	$the_next_expected_card=$cards_priority_string[$the_current_postion_of_card_counter+1];
	if($currentcard[2]==$the_next_expected_card)
		{
			$priorityint=1;
		}
	else if($the_next_expected_card_counter=$the_current_postion_of_card_counter)
		{
		
			$priorityint=11;
				//check for the strengthning an d attack 
		}
	else if($the_next_expected_card_counter<$the_current_postion_of_card_counter)
		{
		
			$priorityint=15;
				//check for the strengthning an d attack 
		}
	else
		{
			$priorityint=0;
		}
    }
//##############################################################
return $priorityint;
}
?>
