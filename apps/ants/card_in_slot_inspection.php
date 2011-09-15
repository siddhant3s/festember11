<?php
//##############################################################
	//card_in_slot_inspection
//##############################################################
	//inspect if the slot is empty
//##############################################################
	//takes in 	
				//and current card under check
				//the field key
				//slotnumber
//##############################################################
		//returns the status
		//if not empty->return >>(-20)
		//if empty ->return>>(7)
		//if not empty but the card of different slot ->return -1			
//##############################################################
function card_in_slot_inspection($lastcolonycard,$thecurrentcard,$slotnumber)
{
global $conn_pag2;
//##############################################################
	//
	$the_stacks_position_string=open_stacks();
//##############################################################
 	$slot_status=$the_stacks_postion[$slotnumber];
	if(!$slot_status)
	{
	return (-20);
	}
	else if($slot_status)
	{
	return 7;
	}
//##############################################################
	$the_user_card_color=$lastcolonycard[0];
	$the_current_card_color=$thecurrent_card[0];
	if($the_user_card_color!=$thecurrent_card_color)
	{
	return (-1);
	}
	
//##############################################################
	//if control comes upto here report in error log
	{

		//take an action
	}
}
?>
