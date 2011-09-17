<?php

/*&&&&&&&*/
/*&&&&&&&*/
global $rpath;
$rpath="../";
require_once("../game.php");
require_once("allglobals.php");
require_once("whisk.php");
require_once("new_user.php");
require_once("matcher.php");
require_once("get_the_average.php");
require_once("get_the_rating.php");
require_once("start_game.php");
$the_error_code=0;
?>


<?php
$the_fb_id=$user['id'];
/*&&&&&&&*/
error_log("777#!#!#!#!#!##!##!#!##!#!##!##!#".$the_fb_id."{}{}{}{}{}}");
/*&&&&&&&*/
if(!$the_fb_id)
{
echo "you are not logged in";
exit(1);

}
if((isset($_POST['submit'])) &&( isset($_POST['bet'])))
{
	$done_match=0;
$current_users_balance=getCash();
$bet_entered=mysql_real_escape_string($_POST['bet']);
   if(!is_numeric($bet_entered))
    {
    $the_error_code=1;
    whisk($bet_entered);
    exit(1);	
    }

if($bet_entered<=0)
	{
	echo "1";
	exit(1);			
	}
if($bet_entered>$current_users_balance)
	{
	echo "2";
	exit(1);
	}
else if(isset($_POST['confirmation']))	
	{
	$done_match=1;					
	}
else if($bet_entered==$current_users_balance) {
						echo "3";
						exit(1);
			 			}	
else {$done_match=1;}


if($done_match==1)
	{
//##############################################################

//if the first take of the user in to the game create  a user id for him in the database
	//check
$result_check_the_user_existence=mysql_query("select played from $table_allusers where user_id='$the_fb_id'");
$answer_check_the_user_existence=mysql_fetch_array($result_check_the_user_existence);

if(!$answer_check_the_user_existence)
	    {	
		$inserted=new_user(); 
		
		if(!isset($inserted))
				{
					whisk(2);
					exit();
				}			
	    }

//##############################################################
$the_matcher_returned_value=matcher();
error_log("&&&&&&&&&&&&&&&*&*&*&*^^&^&^".$the_matcher_returned_value."&&&&&&&&&&&&&&&");
	error_log("^^^^^^^".$bet_entered);
	if($the_matcher_returned_value){$the_game_hash_fetched=start_game($the_fb_id,$bet_entered);}
	else {whisk(19);exit(1);}
//##############################################################
	error_log("&&&&&&&&&&&&&&&*&*&*&*^^&^&^".$the_game_hash_fetched."&&&&&&&&&&&&&&&");
	if($the_game_hash_fetched)
		{
		error_log("&&&&&&&&&&&&&&&".$the_game_hash_fetched."&&&&&&&&&&&&&&&");
		$this_game_maingamepage=$themaingamepage."?opponent=".$the_game_hash_fetched;
		header("Location:$thecheckpointpage");
		exit(1);
		}
	else
		{	
			whisk(42);
			exit(1);
		}
//##############################################################
	}
else
	{
error_log("!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!".$the_fb_id."^^^".$done_match."^^^^^^^".$current_users_balance."^^^^^^^".$bet_entered);
	whisk(99);
	exit(1);
	}


}
?>
