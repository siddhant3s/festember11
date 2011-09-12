<?php
//##############################################################
//takes in two arguments
	//1.mysqlconnection
	//2.currentuserindex
	//3.odds for current user
//returns
	//the odds
//##############################################################
?>
<?php
function get_the_odds($mysqli_connection,$current_user_index)
{
//##############################################################
global $table_allusers;
global $current_user_index;
//##############################################################

$extract_the_user_odds=mysqli_query($mysqli_connection,"select (involved+earned) from '$table_allusers' where index_='$current_user_index'");


$fetched_odds_for_logged_in=mysqli_fetch_array($conn_start_up,$extract_the_user_odds);
$odds_for_current_user=$fetched_odds_for_logged_in['involved+earned'];
//##############################################################
	//add something from the root database if required
//##############################################################

return $odds_for_current_user;
}
?>