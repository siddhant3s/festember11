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
//##############################################################
global $user;
global $table_allusers;
global $table_allgames;
//##############################################################
$thereturnstring="";
//##############################################################
$thecurrentuserid=$user['id'];
//##############################################################
	//get the game hash
$the_game_hash=$_SESSION['thegamehashforants'];
//##############################################################
	//draw pile always open so
$thereturnstring="@";
//##############################################################
$query_get_the_user_status="select id1,id2 from $table_allgames where game_id='$the_game_hash' and active='1'";
$result_get_the_user_status=mysql_query($query_get_the_user_status);
$answer_get_the_user_status=mysql_fetch_array($result_get_the_user_status);
$id1_extracted=$answer_get_the_user_status['id1'];
$id2_extracted=$answer_get_the_user_status['id2'];
//##############################################################
$the_current_user_id=$user['id'];

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

$result_get_the_status_of_current_user=mysql_query("select $the_status_keystring from $table_allgames where game_id='$the_game_hash'");

$answer_get_the_status_of_current_user=mysql_fetch_array($result_get_the_status_of_current_user);
error_log("||||||||||||||||||--".$the_current_user_status."--||||||||||||||||||");
$the_current_user_status=$answer_get_the_status_of_current_user[$the_status_keystring];
//##############################################################
	//variable to locate if the user has been attacked
$attack_mode_counter=$the_current_user_status[0];
if(($attack_mode_counter!='R'))
	{

		whisk(83);
		exit(1);
	}	

if($the_current_user_status[1]=='A')
	{
		//the opposite 
		$the_attack_mode_parameter=1;
	}
//##############################################################
$the_last_colony_card=substr($the_current_user_status,2,3);
$the_stack_cards=substr($the_current_user_status,strpos($the_current_user_status,'{'));
$all_stack_cards_only=substr($the_stack_cards,1,15);
$the_array_of_stack_cards=explode(',',$all_stack_cards_only);
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
