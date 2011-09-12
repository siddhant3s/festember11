<?php
//####################################################
	//monitor a few things with attack
		/*
		as the rank is passed i have to check if the prospective card has the same color as the users dcolony pile color
		check if the rank matches
		as the rank is passed i have to check if the stack cards hav etnthe same ranks as that of o passed
		also check for the current card in the discard pile


			keynumeber is the string to be followed after status or the id to access
			thedraw_key is that wheter i have to check the 1:the next to upcoming card
									0:the upcoming card
			



			nothe that the return val if is four means additional threat
				as if the user knows that the next card is the card of same ranks as that in the stacs nad thesame card appers in the opponents draw pile that certainly means a cerytain attack
					
		*/



//####################################################
function attack($gamehash,$rank,$oppid,$keynumber,$draw_key)
{
//####################################################
global $conn_pag2;
global $table_allusers;
global $table_allgames;
global $the_cards_priority_string;

$key_for_status='status'.$keynumber;
$key_for_id='id'.$keynumber;
$threatby_stacks=0;
$draw_token=0;
//####################################################

if($draw_key!=1 || $draw_key!=2)
	{
		//take an action
	}
else
	{
	//this is the expected value
	}
	//check if the user has the card in his stacks
$result_get_the_stacks=mysqli_query($conn_pag2,"select '$key_for_status',avail_draw from '$table_allgames' where game_id='$gamehash' and active='1' and '$key_for_id'=$oppid");
$answer_get_the_stacks=mysqli_fetch_array($result_get_the_stacks);
$the_status_string=$answer_get_the_stacks[$key_for_status];
//####################################################
		//get the colony
if(!(preg_match("/\(([a-z,]+)\)/",$the_status_string,$colony_match_of_this_user)));
		{
			//take an action
		}

$the_current_users_draw_stack=$colony_match_of_this_user[0];
$the_current_users_draw_stack=str_replace("(","",$the_current_users_draw_stack);
$the_current_users_draw_stack=str_replace(")","",$the_current_users_draw_stack);
$array_of_cards_in_draw=explode(',',$the_current_users_draw_stack);
$the_user_color_reqiured=$array_of_cards_in_draw[0][0];

//####################################################
	//if thedraw key is1:what matters is that the second set in the draw pile

$the_draw_pile=$answer_get_the_stacks['avail_draw'];
	if($draw_key==1)
		{
			//get the second card from here on
			$the_prospective_attacking_card=substr($the_draw_pile,3,3);
		}

	else if($draw_key==0)
		{
			$the_prospective_attacking_card=substr($the_draw_pile,0,3);
		}

	//check for color match
		  if($the_prospective_attacking_card[0]==$the_user_color_reqiured)
		{
			//CHECK FOR THE MATCH OF SETS
			if($the_prospective_attacking_card[2]==$rank)
			{
				//the card in draw is a threat
				$draw_token=1;
				
			}
		}
//####################################################
		//the slot card anaylysis
if(!(preg_match("/\{([a-z,]+)\}/",$the_status_string,$slot_match_of_this_user)));
$the_slot_cards_extracted=$slot_match_of_this_user[0];
$the_slot_cards_extracted=str_replace("{","",$the_slot_cards_extracted);
$the_slot_cards_extracted=str_replace("{","",$the_slot_cards_extracted);
$array_of_cards_in_slot=explode(",",$the_slot_cards_extracted);

		{
			//no need for check of the color match
			foreach($array_of_cards_in_slot as $slotcards)
			{
				if(!($slotcards[2]==$rank))
				{
					//no action required
				}
				else
				{
				
				$threatby_stacks+1;	
				
				}
			}
			
			//take an action
	
		}
	if($threatby_stacks){$draw_token+=3;}//threat from the stacks also
//####################################################
	//calculate reurn values
	if($draw_token==1)//threat only from the draw pile
		{$thereturnval=1;}
	else if($draw_token==3)//threat from the stacks
		{$thereturnval=3;}
	else if($draw_token==4)//threat from bothe the draw and the stacks
		{$thereturnval=4;}
	
//####################################################

return $thereturnval;
}



?>