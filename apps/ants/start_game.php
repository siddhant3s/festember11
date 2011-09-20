<?php
//##############################################################
//takes in two arguments
	//1.id_first user
	//3.bet1
	
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

function start_game($id1,$bet1)
{
$game_id=0;//returned 0 if the function fails
//##############################################################
global $table_allusers;
global $table_allgames;
global $card_stack;
//##############################################################
	//get the opponent
$result_get_the_opponent=mysql_query("select opponent from $table_allusers where user_id='$id1'");
error_log("1~~~~~~~~~~~~~~~~~~~~~~".mysql_error());
$answer_get_the_opponent=mysql_fetch_array($result_get_the_opponent);
$the_opponent=$answer_get_the_opponent['opponent'];
$id2=$the_opponent;
if($id2='AI')
	{
	$bet2=$bet1;
	}

//##############################################################
if((isset($id1))&&(isset($bet1))){$game_id=md5($id1.$id2.time());}
else	{whisk(57);exit(1);}


//##############################################################

$this_card_stack=$card_stack;
shuffle($this_card_stack);
$cards_in_db=implode(',',$this_card_stack);
$cards_in_db='00'.$cards_in_db;

//##############################################################
	//games table query
$query_in_games_table="insert into $table_allgames(game_id,id1,id2,bet1,bet2,card_stack,active,status1,status2,avail_draw,avail_discard) values('$game_id','$id1','$id2','$bet1','$bet2','$cards_in_db','1','0(){000,000,000,000}','0(){000,000,000,000}','0','0')";
error_log("2~~~~~~~~~~~~~~~~~~~~~~".mysql_error());
$result_in_games_table=mysql_query($query_in_games_table);//or die(mysqli_error($conn_proceed));
	if(!mysql_affected_rows())
		{
		//confirm action
		whisk(16);
		exit(1);
		}
//##############################################################


//##############################################################
	//users table query
$query1_inusers_table="update $table_allusers set involved='1' where user_id='$id1'";
error_log("3~~~~~~~~~~~~~~~~~~~~~~".mysql_error());
$updated_userid1=mysql_query($query1_inusers_table);
	if(!mysql_affected_rows())
		{
		//confirm action
		whisk(25);	
		exit(1);
		}
//##############################################################
if($the_opponent!='AI')
{
$query2_inusers_table="update $table_allusers set invloved='1' where user_id='$id2'";
error_log("4~~~~~~~~~~~~~~~~~~~~~~".mysql_error());
$updated_userid1=mysql_query($query2_inusers_table);
	if(!mysql_affected_rows())
		{
		//confirm action
		}
}
//##############################################################
error_log("5~~~~~~~~~~~~~~~~~~~~~~".$game_id);
return $game_id;
}
?>