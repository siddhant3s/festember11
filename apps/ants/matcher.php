
<?php
/*
this script is executed on the reciept of the user id from the first script
the function checks if the user is currently involved if yes sends to a different script; else sends to a another script
*/
//start executed on some start button click and then this script is executed with the start script
//id 
//postion of ants in involved
function matcher()
{
global $user;
global $table_allusers;
//##############################################################

//##############################################################
$the_fb_id=$user['id'];
$the_current_average=get_the_average();
$the_user_rating=get_the_rating();
$thefinalsuccesstoken=0;
//##############################################################
$result_set_currently_matched=mysql_query("update $table_allusers set involved='2' where user_id='$the_fb_id'");
error_log("1#!#!#!#!#!##!##!#!##!#!##!##!#".mysql_error());
// $answer_set_currently_matched=mysql_affected_rows();
// error_log("2#!#!#!#!#!##!##!#!##!#!##!##!#".$answer_set_currently_matched."****");
// if(!$answer_set_currently_matched)
// 		{
// 			whisk(4);
// 			exit(1);
// 		}
//##############################################################

	{
$result_get_all_uninvloved_but_logged=mysql_query("select user_id from $table_allusers where logged=1 and involved=2");
error_log("15#!#!#!#!#!##!##!#!##!#!##!##!#".mysql_error());
$the_opponent=0;
$min_difference=10000000000000000000;
while(false!=($his_id=mysql_fetch_array($result_get_all_uninvloved_but_logged)))
		{
		$his_rating=get_the_rating($his_id['user_id']);
		error_log("3#!#!#!#!#!##!##!#!##!#!##!##!#".$his_rating);
		if(($his_rating-$the_user_rating)<0){$this_case_difference=$the_user_rating-$his_rating;}
		else	{$this_case_difference=$his_rating-$the_user_rating;}
		if($this_case_difference<$min_difference){	
								$result_release_earlier_match=mysql_query("update $table_allusers set involved='2' where user_id='$the_opponent'");
								
								
								$min_difference=$this_case_difference;
								$the_opponent=$his_id['user_id'];
								$result_plot_this_match=mysql_query("update $table_allusers set involved=3 where user_id='$the_opponent'");
								error_log("5#!#!#!#!#!##!##!#!##!#!##!##!#".mysql_error());
								$answer_plot_this_match=mysql_affected_rows();
								error_log("6#!#!#!#!#!##!##!#!##!#!##!##!#".mysql_error());
				/*				if(!$answer_set_currently_matched)
									{
										whisk(5);
										exit(1);
									}*/
							}
		}
if(($the_opponent)  && ($opponent==$the_fb_id))
		{
		
		$result_confirm_opponent=mysql_query("select involved from $table_allusers where user_id='$the_opponent'");
		error_log("7#!#!#!#!#!##!##!#!##!#!##!##!#".mysql_error());
		$answer_confirm_opponent=mysql_fetch_array($result_confirm_opponent);
		error_log("8#!#!#!#!#!##!##!#!##!#!##!##!#".mysql_error());
		error_log("8909009#!#!#!#!#!##!##!#!##!#!##!##!#".$the_opponent);
		if($answer_confirm_opponent==3)
			{
				$result_set_opponent1_match=mysql_query("update $table_allusers set opponent='$the_fb_id' where user_id='$the_opponent'");
				error_log("9#!#!#!#!#!##!##!#!##!#!##!##!#".mysql_error());
				$answer_set_opponent1_match=mysql_affected_rows();
				error_log("10#!#!#!#!#!##!##!#!##!#!##!##!#".mysql_error());
				if(!$answer_set_opponent1_match)
					{
						whisk(7);
						exit(1);
					}
				



				$result_set_opponent2_match=mysql_query("update $table_allusers set opponent='$the_opponent' where user_id='$the_fb_id'");
				error_log("11#!#!#!#!#!##!##!#!##!#!##!##!#".mysql_error());
				$answer_set_opponent2_match=mysql_affected_rows();
				error_log("12#!#!#!#!#!##!##!#!##!#!##!##!#".mysql_error());
				if(!$answer_set_opponent1_match)
					{
						whisk(8);
						exit(1);
					}
				$thefinalsuccesstoken=1;						

			}

		}

	else
		{
				$result_set_opponent2_match=mysql_query("update $table_allusers set opponent='AI' where user_id='$the_fb_id'");
				error_log("13#!#!#!#!#!##!##!#!##!#!##!##!#".mysql_error());
				$answer_set_opponent2_match=mysql_affected_rows();
				error_log("14#!#!#!#!#!##!##!#!##!#!##!##!#".mysql_error());
				if(!$answer_set_opponent1_match)
					{
						whisk(9);
						exit(1);
					}
		

				$thefinalsuccesstoken=1;


		}
	}
if($thefinalsuccesstoken==1)
	{
		echo "<h1>the <$the_fb_id> has been matched against <$the_opponent>";
		
	}
}
?>