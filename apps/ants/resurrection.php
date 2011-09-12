<?php
	//resurrection function
	/*
	takes in a the card-::rank-on which resurrection needed:gamehash::userid-(the user who needs the resurrection-the user different than on which the attack was run)::the key number-1or 2
			
	returns an id based on whether resurrection is derived from draw-actualreinforcement<< draw-jack<< draw king

	shoul

	*/
function resurrection($gamehash,$rank,$id,$number,$indicator)
{
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
			if(!$the_prospective_card[0]==$the_color_of_current_user){/*te card is of no use*/}
			else
				{
					if($the_prospective_card[2]==$rank)
							{
							//that the reinforcement-card is present in the draw
							}
					else if($the_prospective_card[2]=='k')
							{
							//that the reinforcement can be done with a king
							//and  as an indication that that king is coming
							//the handler script will ttake further action
							}
					
					else if($the_prospective_card[2]=='j')
							{
							if($the_prospective_card[1]=='s' || $the_prospective_card[1]=='h')
							//that the reinforcement can be done with a black-eyed-jack
							//and  as an indication that that black-eyed-jack is coming
							//the handler script will take further action
							}
					else
							{
	
							//pass a return value for the fact that the card-u are looking for is not what can be used to reinforce the attack but it is same as the color requiered by the user
							
							}

				}
//####################################################
if(!preg_match("/\(([a-z,]+)\)/",$the_complete_status_string,$the_complete_colony_string));
	$the_complete_colony_string=str_replace("(","",$the_complete_colony_string);
	$the_complete_colony_string=str_replace(")","",$the_complete_colony_string);
	$array_the_colony=explode(",",$the_complete_colony_string);	
	$the_array_containing_matches=preg_grep("/$rank/",$array_the_colony);
	if(!count($the_array_containing_matches))
			{
				//conflict
				//take an action
			}
	else if(count($the_array_containing_matches)==1)
			{
				//no inbuilt reinforcement
			}
	else if(count($the_array_containing_matches)==2)
			{
				//its already reinforced 
				//the main function should not have allowed the attack
			}
//####################################################
if(!preg_match("/\{([a-z,]+)\}/",$the_complete_status_string,$the_complete_slot_string));
	$the_complete_slot_string=str_replace("(","",$the_complete_slot_string);
	$the_complete_slot_string=str_replace(")","",$the_complete_slot_string);
	$array_the_slot=explode(",",$the_complete_colony_slot);	
	$array_cointaining_slot_matches=preg_grep("/$rank/",$array_the_slot);
		if(!count($array_cointaining_slot_matches)){/*take no action*/}
		else if(count($array_cointaining_slot_matches=1)==)
								{
									//pass a differnet return value
								}
		else if(count($array_cointaining_slot_matches=2)==)
								{
									//pass a differnet return value
								}
		else if(count($array_cointaining_slot_matches=3)==)
								{
									//soething is going wromg report an action
								}
		if(count(preg_grep("/k/",$array_the_slot))==1)
								{
									//that a aking is already in the stack

								}
		
		else if(count(preg_grep("/k/",$array_the_slot))==2)
								{
									//that a a two kings is already in the stack

								}
		
		else if(count(preg_grep("/k/",$array_the_slot))==3)
								{
									//that something is going wrong

								}
		
		if(count(preg_grep("/j/",$array_the_slot)))
								{
									if((count(preg_grep("/s/",$array_the_slot))>0) || (count(preg_grep("/s/",$array_the_slot))>))
									{
									//the card is black eyed jack
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
						}		
				if($the_discared_card_rank=='k')
						{
							//the king card is in the discrad pile and i have queen in the slots
						}
				
				if($the_discared_card_rank=='j')
						{	
							if($the_last_discarded[1]=='s' || $the_last_discarded=='h')
								{
											//a black eyed jack is at the discard and i havequuen at the slot
								}
						}
				}		

			   }
//####################################################
}



?>