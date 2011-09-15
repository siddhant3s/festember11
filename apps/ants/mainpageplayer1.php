<?php
//########################################################
	//another script has to see the ai id and then it sends to the correct script

//########################################################
function inspect($gamehash)
{
$the_final_string_to_anaylyse="";
//########################################################
	//allglobals here
global $conn_pag2;
global $the_cards_priority_string;
//########################################################
	//get the id
	$myid=get_the_id($conn_pag2);
//########################################################
	//get the keynumber for this user
		$result_get_the_key_number=mysqli_query($conn_pag2,"select id1,id2 from '$table_allgames' where game_id='$gamehash'");
		$answer_get_the_key_number=mysqli_fetch_arrray($result_get_the_key_number);
		if($myid==$answer_get_the_key_number['id1']){$the_key_number=1;$opponentid=$answer_get_the_key_number['id2'];$the_counter_key_number=2;}
		else if($myid==$answer_get_the_key_number['id1']){$the_key_number=2;$opponentid=$answer_get_the_key_number['id1'];$the_counter_key_number=1;}	
		else {/*take an action*/}
//########################################################
	//check requirements
	//get the status for the user
	$counter_status_key_string='status'.$the_counter_key_number;
	$status_key_string='status'.$the_key_number;
	$result_get_the_status=mysqli_query($conn_pag2,"select '$status_key_string','$counter_status_key_string',avail_draw,avail_discard from '$table_all_games' where game_id='$gamehash'");
	$answer_get_the_status=mysqli_fetch_array($result_get_the_status);
	$current_status_string_for_the_user=$answer_get_the_status[$status_key_string];
	$current_status_string_for_the_opponent=$answer_get_the_status[$counter_status_key_string];
	$current_colony_string_for_the_user=$answer_get_the_status['avail_draw'];
	$current_discard_string_for_the_user=$answer_get_the_status['avail_discard'];
	$array_of_discarded_cards=explode(',',$current_discard_string_for_the_user);
//#######################################################
//FOR MAIN USER
	//the_current_colony_card_position
	
	//get the colony of the user
	$token_the_current_colony=preg_match("/\(([a-z,]+)\)/",$current_status_string_for_the_user,$the_current_colony_match);
		if(!$token_the_current_colony)
				{
					//take an action
					whisk(11);
					exit(1);
				}
		else
				{	
				$the_current_colony=$the_current_colony_match[0];
				$the_current_colony=str_replace("(","",$the_current_colony);
				$the_current_colony=str_replace(")","",$the_current_colony);
				$the_colony_array=explode(",",$the_current_colony);
				}
	$the_current_colony_card=$the_colony_array[0];


	//get the slots
	
	$token_the_slot=preg_match("/\{([a-z,]+)\}/",$current_status_string_for_the_user,$the_current_slot_match);
		if(!$token_the_slot)
				{
					//take an action
					whisk(12);
					exit(1);
				}
		else
				{	
				$the_current_slot=$the_current_slot_match[0];
				$the_current_slot=str_replace("(","",$the_current_slot);
				$the_current_slot=str_replace(")","",$the_current_slot);
				$slot_card_array=explode(",",$the_current_slot);
				}
	$the_current_slotcards=$slot_card_array;	

//########################################################
//FOR THE OPPONENT
	$token_the_opponent_colony=preg_match("/\(([a-z,]+)\)/",$current_status_string_for_the_opponent,$the_current_opponent_colony_match);
		if(!$token_the_opponent_colony)
				{
					//take an action
					whisk(14);
					exit(1);

				}
		else
				{	
				$the_current_opponent_colony=$the_current_opponent_colony_match[0];
				$the_current_opponent_colony=str_replace("(","",$the_current_opponent_colony);
				$the_current_opponent_colony=str_replace(")","",$the_current_opponent_colony);
				$the_opponent_colony_array=explode(",",$the_current_opponent_colony);
				}
	$the_current_opponent_colony_card=$the_opponent_colony_array[0];
//########################################################
	//compare with the priority string and get the next required card
		$the_current_position_of_the_user=strpos($the_cards_priority_string,$the_current_colony_card[3]);
			//gives the postion of the last comlony card of the user in the priority string
		$the_required_colony_rank=$the_cards_priority_string[$the_current_position_of_the_user+1];
//########################################################	
	//see if the draw pile has that card
		//availthe draw pile
	$the_current_avail_draw_pile=$answer_get_the_status['avail_draw'];
	$the_next_avail_draw_card=substr(the_current_avail_draw_pile,0,3);
	if($the_next_avail_draw_card[0]==$the_current_colony_card[0]){$samecolor=1;}
	else if(!($the_next_avail_draw_card[0]=$the_current_colony_card[0])){$samecolor=0;}
	else{/*take an action*/}
//########################################################	
	//if the cards of the same color
	//########################################################	
	   {//BLOCK INSPECTS THE POSSIBILITIES WITH THE NEXT CARD IF DRAWN FROM THE DRAW PILE
		if($samecolor==1)
			{
				//anaylysis based on if the current user puts the next card on his draw and then check for attack chances and resurrections agianst those attacks
				if($the_next_avail_draw_card[2]==$the_required_colony_rank)//check if same as required card
					{
					//check for attack if i draw the next card
					$the_chance_attack=attack($gamehash,$the_required_colony_rank,$opponentid,$the_counter_key_number,1);
					if($the_chance_attack==1 || $the_chance_attack==4)//from the draw pile
						{
					$resurrection_returned=resurrection($gamehash,$the_required_colony_rank,$myid,$the_key_number,1);
						//resurrection returned after the sexond acred has bee drawn from the draw pile
						//that the attack has been after the currentbuser placed the first card from the draw into his colony
						//he nopponent p[laces the second to current card to attack
						
						if(!$resurrection_returned)
									{
								$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'a';
										
									}
						else if($resurrection_returned)
							{
								if(preg_match("/a/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'b';}
								if(preg_match("/b/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'c';}
								if(preg_match("/c/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'d';}
								if(preg_match("/d/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'e';}
								if(preg_match("/e/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'f';}
								if(preg_match("/g/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'g';}
								if(preg_match("/n/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'h';}
								if(preg_match("/f/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'i';}
								if(preg_match("/h/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'j';}
								if(preg_match("/i/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'k';}
								if(preg_match("/j/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'l';}
								if(preg_match("/k/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'m';}								
								if(preg_match("/l/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'n';}
								if(preg_match("/m/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'o';}
								
								
								

							}
						}
					else if($the_chance_attack==3)//direct from slots
						{
					$resurrection_returned=resurrection($gamehash,$the_required_colony_rank,$myid,$the_key_number,0);
						//resurrection returned afetr the ONLY ONE has bee drawn from the draw pile
						//that the attack has been after the current user placed the first card from the draw into his colony
						//the opponent places a card from his slot into the users draw to prevent attack

						if(!$resurrection_returned)
									{
								$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'p';
										
									}
						else if($resurrection_returned)
							{
								if(preg_match("/a/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'q';}
								if(preg_match("/b/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'r';}
								if(preg_match("/c/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'s';}
								if(preg_match("/d/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'t';}
								if(preg_match("/e/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'u';}
								if(preg_match("/g/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'v';}
								if(preg_match("/n/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'w';}
								if(preg_match("/f/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'x';}
								if(preg_match("/h/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'y';}
								if(preg_match("/i/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'z';}
								if(preg_match("/j/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'A';}
								if(preg_match("/k/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'B';}								
								if(preg_match("/l/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'C';}
								if(preg_match("/m/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'D';}
								
								
								

							}



						}
					}
				else
					{
					$the_position_of_next_card_in_draw=strpos($the_cards_priority_string,$the_next_avail_draw_card[2]);
					if($the_positition_of_next_card_in_draw<$the_current_position_of_the_user)//if the  card rank has already been bypassed there can be two laternativesther placiojng this card reinforecs it or the rank has been bypassed on theaccount of ablack eyed jack
						{
							$array_occurences_considered_card=preg_match("/$the_next_avail_draw_card[2]/",$the_colony_array);
							if(!count($array_occurences_considered_card))
							{
								//if the card considered in the draw pile not there in the colony
								//we have put a black-eyed jack in place of the considered card to continue progression of the teritory
									//search for the jack
								//getthecolor
								$the_color_of_my_colony=$the_colony_array[0][0];
								if($the_color_of_my_colony=='r')
									{$black_eyed_jack_suit='h';}
								
								else if($the_color_of_my_colony=='b')
									{$black_eyed_jack_suit='c';}
								else
									{
									 whisk(27);
									exit();
									 }
								if(isset($black_eyed_jack_suit))
									{
									//RETURN A A VALUE HERE
									$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'E';
									}
							}
							else if(count($array_occurences_considered_card)==1)
							{
								//now there is alreday a card of the same rank in the clony in this case placing the card again creates a reinforcement
									{
										//check for attack posibility if i on't place nay card at this position
										//that if i dont place this card i take a chance of getting attacked but the vjance becomes real only if the card capabale of posing a thereat ;lies in the  the other users slots and draw pile before i get the next card::	

										//if no such imminent threat i can try to attack with that card
										//if attack not possible reinforce
										
										$vulnerability_of_attack_at_this_position=attack($gamehash,$the_next_avail_draw_card[2],$opponentid,$the_counter_key_number,1);



										if($vulnerability_of_attack_at_this_position==1 || $vulnerability_of_attack_at_this_position==4)//from the draw pile
											{
											$resurrection_returned_against_vulnerability=resurrection($gamehash,$the_next_avail_draw_card[2],$the_key_number,1);
											$resurrection_returned=$resurrection_returned_against_vulnerability;
												//assumption-that the current card in the draw oile was discarded and the next draw card used to attcak so resurrection expected by the next to next of next draw card
												if(!$resurrection_returned)
												{
													$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'F';


												}
												else if($resurrection_returned)
												{
											if(preg_match("/a/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'G';}
											if(preg_match("/b/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'H';}
											if(preg_match("/c/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'I';}
											if(preg_match("/d/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'J';}
											if(preg_match("/e/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'K';}
											if(preg_match("/g/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'L';}
											if(preg_match("/n/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'M';}
											if(preg_match("/f/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'N';}
											if(preg_match("/h/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'O';}
											if(preg_match("/i/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'P';}
											if(preg_match("/j/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'Q';}
											if(preg_match("/k/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'R';}				
											if(preg_match("/l/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'S';}
											if(preg_match("/m/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'T';}

												}
												
												
											}
										else if($vulnerability_of_attack_at_this_position==3)//direct from slots
											{
											$resurrection_returned_against_vulnerability=resurrection($gamehash,$the_next_avail_draw_card[2],$myid,$the_key_number,0);
											//assumption-that the current card in the draw oile was discarded and the slot card used to attcak so resurrection expected by the next to next draw card
											$resurrection_returned=$resurrection_returned_against_vulnerability;
												if(!$resurrection_returned)
												{
													$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'U';


												}
												else if($resurrection_returned)
												{
											if(preg_match("/a/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'V';}
											if(preg_match("/b/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'W';}
											if(preg_match("/c/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'X';}
											if(preg_match("/d/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'Y';}
											if(preg_match("/e/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'Z';}
											if(preg_match("/g/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'1';}
											if(preg_match("/n/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'2';}
											if(preg_match("/f/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'3';}
											if(preg_match("/h/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'4';}
											if(preg_match("/i/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'5';}
											if(preg_match("/j/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'6';}
											if(preg_match("/k/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'7';}				
											if(preg_match("/l/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'8';}
											if(preg_match("/m/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'9';}

												}

											}
										else if(!$vulnerability_of_attack_at_this_position)	
											{
											//so no vulnerability
												//try to attack
												$offence_try_to_attack=attack($gamehash,$the_next_avail_draw_card[2],$myid,$the_key_number,0);
												
												//check if the current card in the opponent's clonony (rank)	 is same as the card_under consideration
												if($the_current_opponent_colony_card[2]==$the_next_avail_draw_card[2])
													{
													$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'`';
													}
												else
													{
														$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'~';
													}
												
											}

									}

							}

						}

					}
			}
		else
			{
				$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'$';
			}


	   }


	   {
		
		
		foreach($the_current_slotcards as $a_slotcard)
			{
				if($a_slotcard=="000")
					{	/*take no action*/		}
				else if($a_slot_card[2]==$the_required_colony_rank)
					{
						//yes the card is at the slots
							$attack_possibilty_at_placing_from_slots=attack($gamehash,$the_required_colony_rank,$opponentid,$the_counter_key_number,0);
							if($attack_possibilty_at_placing_from_slots==1 || $attack_possibilty_at_placing_from_slots==4)//threat from the draw pile
							{
								$resurrection_returned=resurrection($gamehash,$the_required_colony_rank,$myid,$the_key_number,0);
													if(!$resurrection_returned)
												{
													$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'{';


												}
												else if($resurrection_returned)
												{
											if(preg_match("/a/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'}';}
											if(preg_match("/b/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'[';}
											if(preg_match("/c/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.']';}
											if(preg_match("/d/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.':';}
											if(preg_match("/e/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.';';}
											if(preg_match("/g/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'<';}
											if(preg_match("/n/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'>';}
											if(preg_match("/f/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.',';}
											if(preg_match("/h/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'.';}
											if(preg_match("/i/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'?';}
											if(preg_match("/j/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'/';}
											$this_character=chr(255);
											if(preg_match("/k/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.$this_character;}				
											if(preg_match("/l/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'=';}
											if(preg_match("/m/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.'|';}
												}
	
							//so the best optio as if joe is to discard the current cad
							}
							if($attack_possibilty_at_placing_from_slots==3)//threat fromthe opponents stacks
							{


							if(!$resurrection_returned)
												{
													$this_character=chr(254);
													$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.$this_character;


												}
												else if($resurrection_returned)
												{
											$this_character=chr(253);
											if(preg_match("/a/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.$this_character;}
											$this_character=chr(252);
											if(preg_match("/b/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.$this_character;}
											$this_character=chr(251);
											if(preg_match("/c/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.$this_character;}
											$this_character=chr(250);
											if(preg_match("/d/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.$this_character;}
											$this_character=chr(249);
											if(preg_match("/e/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.$this_character;}
											$this_character=chr(248);
											if(preg_match("/g/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.$this_character;}
											$this_character=chr(247);
											if(preg_match("/n/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.$this_character;}
											$this_character=chr(246);
											if(preg_match("/f/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.$this_character;}
											$this_character=chr(245);
											if(preg_match("/h/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.$this_character;}
											$this_character=chr(244);
											if(preg_match("/i/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.$this_character;}
											$this_character=chr(243);
											if(preg_match("/j/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.$this_character;}
											$this_character=chr(242);
											if(preg_match("/k/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.$this_character;}		
											$this_character=chr(241);
											if(preg_match("/l/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.$this_character;}
											$this_character=chr(240);
											if(preg_match("/m/",$resurrection_returned)){$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.$this_character;}

												}
							//if no black eyed jack
							//CHECK FOR REINFORCEMENT AT THE DRAW PILE
							}
					}
			}
	   }
 {

$dummy_token=0;
foreach($the_current_slotcards as $forblackjackcheck)
  {	
if(($forblackjackcheck[2]=='j') &&(($forblackjackcheck[1]=='h') ||($forblackjackcheck=='s')))
	{
	//YES A BLACKJACK PRESENT
	//RETURN A TOKEN
	$dummy_token=1;
	break;
	}
						
										
  }
if($dummy_token){$this_character=chr(174);$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.$this_character;}					$dummy_token=0				
//check if it is possible to trade  a card
  {

//return  a token to see
//CHECK FOR TRADING-ie check if 
foreach($the_current_slotcards as $forQUEENcheck)	
     {	
if(($forQUEENcheck[2]=='k') )
	    {
	//YES A queen PRESENT
	//RETURN A TOKEN
	//CHECK FOR the top card in discardc pile to be appropiate
	$total_number_of_discarede_cards=count($array_of_discarded_cards);
	if($array_of_discarded_cards[$total_number_of_discarede_cards-1][0]==$the_current_colony_card[0])
		{
		if($array_of_discarded_cards[$total_number_of_discarede_cards-1][2]=='q')
			{
			$dummy_token=1;
			break;
			}
							
		}
	    }

     }
  }
if($dummy_token){$this_character=chr(163);$the_final_string_to_anaylyse=$the_final_string_to_anaylyse.$this_character;}				
}
//########################################################	
			{

			}
//########################################################	

}
?>
