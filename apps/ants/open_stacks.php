<?php
//##############################################################
	//open stacks 
//##############################################################
	//takes nothing in
//##############################################################
	//returns a string
//##############################################################
	//i need to save the card status of the users in the fields
//##############################################################
function open_stacks()
{
global $conn_pag2;
global $table_allusers;
global $table_allgames;


$thereturnstring="";
//##############################################################
 	$thecurrentuserid=get_the_id($conn_pag2,);
//##############################################################
		//get the current game hash use the user id and the active counter for each game which is set as one
//##############################################################
//get the game hash
	$result_get_the_game_hash=mysqli_query($conn_pag2,"select game_id from '$table_allgames' where (id1='$currentuserid' or id2='$thecurrentuserid') and active=1");
	$answer_get_the_game_hash=mysqli_fetch_array($result_get_the_game_hash);
	$the_game_hash=$answer_get_the_game_hash['game_id'];
		if(!$the_game_hash)
			{
				//take an action
			}
//##############################################################
	//draw pile always open so
	$thereturnstring="@";
//##############################################################
$query_get_the_user_status="select id1,id2 from $table_allgames where game_id='$the_game_hash' and";
$result_get_the_user_status=mysqli_query($conn_pag2,$query_get_the_user_status);
$answer_get_the_user_status=mysqli_fetch_array($result_get_the_user_status);
$id1_extracted=$answer_get_the_user_status['id1'];
$id2_extracted=$answer_get_the_user_status['id2'];

$the_current_user_id=get_the_id($conn_pag2,);

if($the_current_user_id==$id1_extracted)
{
$the_index=1;
$the_status_keystring='status'.'1';
}

if($the_current_user_id==$id2_extracted)
{
$the_index=2;
$the_status_keystring='status'.'2';
}

$result_get_the_status_of_current_user=mysqli_query($conn_pag2,"select '$the_status_keystring' from '$table_allgames' where game_id='$the_game_hash'");
$answer_get_the_status_of_current_user=mysqli_fetch_array($result_get_the_status_of_current_user);
$the_current_user_status=$answer_get_the_status_of_current_user[$the_status_keystring];
//##############################################################
	//variable to locate if the user has been attacked
$attack_mode_counter=$the_current_user_status[0];
if($attack_mode_counter)
	{
		//the opposite 
	}
//##############################################################
$the_last_colony_card=substr($the_current_user_status,2,3);
$the_stack_cards=substr($the_current_user_status,strpos($the_current_user_status,'{'));
$all_stack_cards_only=substr($the_stack_cards,1,15);
$the_array_of_stack_cards=explode(','$all_stack_cards_only);
$the_counter_for_stack_fill=0;
foreach($the_array_of_stack_cards as $mystackarr)
	{
	if($mystackarr!='000')
		{
			
		}
		$the_counter_for_stack_fill+=1;
	}
if($the_counter_for_stack_fill)
	{
	if($the_counter_for_stack_fill==1)
		{
		//openstackone
		$thereturnstring="@a00";
		}
	
	if($the_counter_for_stack_fill==2)
		{
		//openstacktwo
		$thereturnstring="@ab0";
		}
	
	if($the_counter_for_stack_fill==3)
		{
		//openstackthree
		$thereturnstring="@abc";
		}
	}
else
	{
	$thereturnstring="@000";
	}

return $thereturnstring;
}
?>
