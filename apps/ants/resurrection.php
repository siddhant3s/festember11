<?php
	//resurrection function
	/*
	takes in a the card-::rank-on which resurrection needed:gamehash::userid-(the user who needs the resurrection-the user different than on which the attack was run)::the key number-1or 2
			
	returns an id based on whether resurrection is derived from draw-actualreinforcement<< draw-jack<< draw king

	shoul

	*/



	/*
	
	CODES 
		2:next draw card is a security againsyt the attack-:same rank
		4:							:a king
		8:							:its a black eyed jack
		16:		no security offered :butcard can be used by the passed id lest nt attacked
		32:the card attack with which is being discussed is already presenet in the current users colony;
					no in the event no attack can take place cause that ll mean reinforcement
		128:attack i s feasible no inbuilt reinforcement in the current user-id colony
		8192:no slot card rank matches of the ranked card
		64:one slot card rank match
		128:one king in the slot
 		256:two king in the slot
		512:black_eyed-jack in the slot
		1024:the card in the discard pile right now is the card needed to prevent attack and i have a queen in the stacks
		2048:the card in the discard pile right now is the king needed to prevent attack and i have a queen in the stacks
		4096:the card in the discard pile right now is the black-eyed-jack needed to prevent attack and i have a queen in the stacks
	*/
function resurrection($gamehash,$rank,$id,$number,$indicator)
{
$the_value_to_be_returned=0;
//####################################################
global $conn_pag2;
global $table_allusers;
global $table_allgames;
global $the_cards_priority_string;

$key_for_status='status'.$number;
$key_for_id='id'.$number;
$threatby_stacks=0;
$draw_token=0;
//####################################################
	if(!($number==1 || $number=0))
		{
			// take an action
		}
//####################################################
		//get the stacks and other things

$result_get_the_status=mysqli_query($conn_pag2,"select '$key_for_status',avail_draw,avail_discard from '$table_allgames' where game_hash='$gamehash' and active=1 and '$key_for_id'='$id'");
$answer_get_the_status=mysqli_fetch_array($result_get_the_status);
$the_complete_status_string=$answer_get_the_status[$key_for_status];
$the_availed_discard=$answer_get_the_status['avail_discard'];
$the_availed_draw=$answer_get_the_status['avail_draw'];
$array_avail_draw=explode(',',$the_availed_draw);
//####################################################
	//indicator
		//the color of the current user
		$the_color_of_current_user=$the_complete_status_string[1];
		if(!$indicator){$the_prospective_card=$array_avail_draw[1];}
	
		if($indicator==1){$the_prospective_card=$array_avail_draw[2];}
			if(!$the_prospective_card[0]==$the_color_of_current_user){$reinforcement_level=-1;}
			else
				{
					if($the_prospective_card[2]==$rank)
							{
							//that the reinforcement-card is present in the draw
								$reinforcement_level=2;
								$the_value_to_be_returned+=$reinforcement_level;
							}
					else if($the_prospective_card[2]=='k')
							{
							//that the reinforcement can be done with a king
							//and  as an indication that that king is coming
							//the handler script will ttake further action
								$reinforcement_level=4;
								$the_value_to_be_returned+=$reinforcement_level;
							}
					
					else if($the_prospective_card[2]=='j')
							{
							if($the_prospective_card[1]=='s' || $the_prospective_card[1]=='h')
							//that the reinforcement can be done with a black-eyed-jack
							//and  as an indication that that black-eyed-jack is coming
							//the handler script will take further action
								$reinforcement_level=8;
								$the_value_to_be_returned+=$reinforcement_level;
							}
					else
							{
	
							//pass a return value for the fact that the card-u are looking for is not what can be used to reinforce the attack but it is same as the color requiered by the user
								$reinforcement_level=16;
								$the_value_to_be_returned+=$reinforcement_level;
							}

				}
//####################################################
if(!preg_match("/\(([a-z,]+)\)/",$the_complete_status_string,$the_complete_colony_string))
			{
				whisk(33);
				exit(1);
			}
	$the_complete_colony_string=str_replace("(","",$the_complete_colony_string);
	$the_complete_colony_string=str_replace(")","",$the_complete_colony_string);
	$array_the_colony=explode(",",$the_complete_colony_string);	
	$the_array_containing_matches=preg_grep("/$rank/",$array_the_colony);
	if(!count($the_array_containing_matches))
			{
				//conflict
				//take an action
				$reinforcement_level=128;
				$the_value_to_be_returned+=$reinforcement_level;
				
			}
	else if(count($the_array_containing_matches)==1)
			{
				//no inbuilt reinforcement
				$reinforcement_level=32;
				$the_value_to_be_returned+=$reinforcement_level;
			}
	else if(count($the_array_containing_matches)==2)
			{
				//its already reinforced 
				//the main function should not have allowed the attack
				whisk(48);
				exit();
			}
//####################################################
if(!preg_match("/\{([a-z,]+)\}/",$the_complete_status_string,$the_complete_slot_string));
	$the_complete_slot_string=str_replace("(","",$the_complete_slot_string);
	$the_complete_slot_string=str_replace(")","",$the_complete_slot_string);
	$array_the_slot=explode(",",$the_complete_colony_slot);	
	$array_cointaining_slot_matches=preg_grep("/$rank/",$array_the_slot);
		if(!count($array_cointaining_slot_matches)){$reinforcement_level=8192;}
		else if(count($array_cointaining_slot_matches)==1)
								{
										//pass a differnet return value
										$reinforcement_level=64;
										$the_value_to_be_returned+=$reinforcement_level;
								}
		else if(count($array_cointaining_slot_matches)==2)
								{
										whisk(38);
										exit();
									//pass a differnet return value
								}
		else if(count($array_cointaining_slot_matches)==3)
								{
									//soething is going wromg report an action
										whisk(77);
										exit();
								}
		if(count(preg_grep("/k/",$array_the_slot))==1)
								{
										$reinforcement_level=128;
										$the_value_to_be_returned+=$reinforcement_level;
									//that a aking is already in the stack

								}
		
		else if(count(preg_grep("/k/",$array_the_slot))==2)
								{
									//that a a two kings is already in the stack
										$reinforcement_level=256;
										$the_value_to_be_returned+=$reinforcement_level;
								}
		
		else if(count(preg_grep("/k/",$array_the_slot))==3)
								{
									//that something is going wrong
									whisk(61);
									exit();

								}
		
		if(count(preg_grep("/j/",$array_the_slot)))
								{
									if((count(preg_grep("/s/",$array_the_slot))>0) || (count(preg_grep("/s/",$array_the_slot))>))
									{
									//the card is black eyed jack
										$reinforcement_level=512;
										$the_value_to_be_returned+=$reinforcement_level;
									}
									

								}
//####################################################
		//check for discard pile
			//only if i already have a  queen in the stacks
			    if(count(preg_grep("/q/",$array_the_slot)))
			    {
				$the_array__discard=explode(',',$the_availed_discard);	
				$the_total_discarded_cards=count($the_array__discard);
				$the_last_discarded=$the_array__discard[$the_total_discarded_cards-1];
				if($the_last_discarded[0]==$the_color_of_current_user)
				{
				$the_discared_card_rank=$the_last_discarded[2];
				if($the_discared_card_rank==$rank)
						{
							//the reinforcement card is in the discrad pile and i have queen in the slots
							$reinforcement_level=1024;
							$the_value_to_be_returned+=$reinforcement_level;
						}		
				if($the_discared_card_rank=='k')
						{
							//the king card is in the discrad pile and i have queen in the slots
							$reinforcement_level=2048;
							$the_value_to_be_returned+=$reinforcement_level;
							
						}
				
				if($the_discared_card_rank=='j')
						{	
							if($the_last_discarded[1]=='s' || $the_last_discarded=='h')
								{
											//a black eyed jack is at the discard and i havequuen at the slot
											$reinforcement_level=4096;
											$the_value_to_be_returned+=$reinforcement_level;
								}
						}
				}		

			   }
//####################################################
return $the_value_to_be_returned;
}

?>