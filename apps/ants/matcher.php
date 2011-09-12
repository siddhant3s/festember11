
<?php
/*
this script is executed on the reciept of the user id from the first script
the function checks if the user is currently involved if yes sends to a different script; else sends to a another script
*/
//start executed on some start button click and then this script is executed with the start script
//id 
//postion of ants in involved
function matcher($the_id)
{
global $ONGAME;
global $thesql_connection;
global $the_ants_position_in_invloved;
$query_to_check_involvement="select involved from festember_logged_in where user_id='$the_id'";
$result_to_check_invlovement=mysqli_query($thesql_connection,$query_to_check_involvement);
//invloved ll have a set of numbers -n this style 1-0-0-1-0-1 etc which shows whether the user in logged in in the game //
$involved_ants=substr($query_to_check_invlovement,($the_ants_positon_in_invloved-1),1);//(-1 important)
if($invloved_ants)
	{
	//already invloved put in custom error log
			{}
	//and whisk to i have o decide  as a variable ONGAME
	header("Location:$ONGAME");
	exit();
	}
else

	{



	}


}
