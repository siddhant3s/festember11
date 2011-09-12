<?php
//##############################################################
//takes in two arguments
	//1.id_first user
	//2.id_second_user
	//3.bet1
	//4.bet2
//returns
	//game id for success
	//0 failure
//##############################################################

//##############################################################
	//set the invloved keys to 1 in either of the user ids 
	//shuffle the card stack
	//set  active game counter=1
	//activate
 //##############################################################

 //##############################################################
	//function to be used in proceed.php
 //##############################################################

function start_game($id_1,$id_2,$bet1,$bet2)
{
$game_id=0;
//##############################################################
global $table_allusers;
global $table_allgames;
global $conn_proceed;
global $card_stack;
//##############################################################
if((isset($id1))&&(isset($id2))){$game_id=md5($id1.$id2);}
	//if this step falis zero is returned
$this_card_stack=$card_stack;
shuffle($this_card_stack);
$cards_in_db=implode(',',$this_card_stack);
$cards_in_db='00'.$cards_in_db;

//##############################################################
	//games table query
$query_in_games_table="insert into '$table_allgames'(game_id,id1,id2,bet1,bet2,card_stack,active,status1,status2) values('$game_id','$id1','$id2','$bet1','$bet2','$cards_in_db',1,'0(){000,000,000,000}','0(){000,000,000,000}')";
$result_in_games_table=mysqli_query($conn_proceed,$query_in_games_table);//or die(mysqli_error($conn_proceed));
	if(!mysqli_affected_rows($conn_proceed))
		{
		//confirm action
		}
//##############################################################


//##############################################################
	//users table query
$query1_inusers_table="update $table_allusers set invloved=1 where user_id=$id1";
$updated_userid1=mysqli_query($conn_proceed,$query_inusers_table);
	if(!mysqli_affected_rows($conn_proceed))
		{
		//confirm action
		}


$query2_inusers_table="update $table_allusers set invloved=1 where user_id=$id2";
$updated_userid1=mysqli_query($conn_proceed,$query_inusers_table);
	if(!mysqli_affected_rows($conn_proceed))
		{
		//confirm action
		}
//##############################################################

return $game_id;
}
?>



