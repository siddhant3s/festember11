
<?php
function go()
{
//##############################################################
global $conn_start_up;
//##############################################################


//##############################################################
//pass the user identification key
$current_user_index=get_the_id($conn_start_up,'');
if(!$current_user_index)
	{
	//log one error
	}
//##############################################################


//##############################################################
//extract the user current ranks
$extract_the_user_odds=mysqli_query($conn_start_up,"select (involved+earned) from '$table_allusers' where index_='$current__user_index'");
//change the formula here


$fetched_odds_for_logged_in=mysqli_fetch_array($conn_start_up,$extract_the_user_odds);
$odds_for_current_user=$fetched_odds_for_logged_in['involved+earned'];
//##############################################################

//##############################################################
//pass the user rank and id to be  matched
match_the_user($current_user_index,$odds_for_current_user);
//no return
//##############################################################
}
?>