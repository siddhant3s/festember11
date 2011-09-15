<?php
$rpath="../";
require_once("../game.php");
require_once("allglobals.php");
require_once("whisk.php");
$the_error_code=0;
?>






<?php
if((isset($_POST['submit'])) &&( isset($_POST['bet'])) )
{
	$done_match=0;
$current_users_balance=getCash();
$bet_entered=mysql_real_escape_string($_POST['bet']);
var_dump($bet_entered);
exit();
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
$result_check_the_user_existence=mysql_query("select user_id from '$table_allusers' where fb_id='$the_fb_id'");
$answer_check_the_user_existence=mysql_fetch_array($result_check_the_user_existence);
if(!(isset($answer_check_the_user_existence)))
	{	$inserted=new_user($conn_matcher);    }
		if(!$inserted)
				{
					whisk(2);
					exit();
				}			
//##############################################################
	if(matcher()){;exit(1);	}
	else {whisk(19);exit(1);}
	}
else
	{
	whisk(99);
	exit(1);
	}
}

?>
