<?php
require_once("allglobals.php");
require_once("apps/game.php");
?>
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

//##############################################################

//MAKE THE CONNECTION 
$conn_matcher;
//##############################################################
$the_fb_id=get_the_fb_id();
$the_current_average=get_the_average();
$the_user_rating=get_the_rating($the_fb_id);
$thefinalsuccesstoken=0;
//##############################################################
$result_set_currently_matched=mysqli_query($conn_matcher,"update '$table_allusers' set involved=2 where fb_id='$the_fb_id'");
$answer_set_currently_matched=mysqli_affected_rows($conn_matcher);
if(!$answer_set_currently_matched)
		{
			whisk(4);
			exit();
		}
//##############################################################

	{
$result_get_all_uninvloved_but_logged=mysqli_query($conn_matcher,"select fb_id from '$table_allusers' where logged=1 and involved=2");
$the_opponent=0;$min_difference=10000000000000000000;
foreach(false!=($his_id==mysqli_fetch_array($answer_get_all_uninvloved_but_logged)))
		{
		$his_rating=get_the_rating($his_id['fb_id']);
		if(($his_rating-$the_user_rating)<0){$this_case_difference=$the_user_rating-$his_rating;}
		else	{$this_case_difference=$his_rating-$the_user_rating}
		if($this_case_difference<$min_difference){	
								$result_release_earlier_match=mysqli_query($conn_matcher,"update '$table_allusers' set involved=2 where fb_id='$the_opponent'");
								$answer_release_earlier_match=mysqli_affected_rows($conn_matcher);
								if(!$answer_release_earlier_matched)
									{
										whisk(6);
										exit();
									}

								
								$min_difference=$this_case_difference;
								$the_opponent=$his_id['fb_id'];
								$result_plot_this_match=mysqli_query($conn_matcher,"update '$table_allusers' set involved=3 where fb_id='$the_opponent'");
								$answer_plot_this_match=mysqli_affected_rows($conn_matcher);
								if(!$answer_set_currently_matched)
									{
										whisk(5);
										exit();
									}
							}
		}
if($the_opponent)
		{
		
		$result_confirm_opponent=mysqli_query($conn_matcher,"select involved from '$table_allusers' where fb_id='$the_opponent'");
		$answer_confirm_opponent=mysqli_fetch_array($result_confirm_opponent);
		if($answer_confirm_opponent==3)
			{
				$result_set_opponent1_match=mysqli_query($conn_matcher,"update '$table_allusers' set opponent='$the_fb_id' where fb_id='$the_opponent'");
				$answer_set_opponent1_match=mysqli_affected_rows($conn_matcher);
				if(!$answer_set_opponent1_match)
					{
						whisk(7);
						exit(1);
					}
				



				$result_set_opponent2_match=mysqli_query($conn_matcher,"update '$table_allusers' set opponent='$the_opponent' where fb_id='$the_fb_id'");
				$answer_set_opponent2_match=mysqli_affected_rows($conn_matcher);
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
				$result_set_opponent2_match=mysqli_query($conn_matcher,"update '$table_allusers' set opponent='AI' where fb_id='$the_fb_id'");
				$answer_set_opponent2_match=mysqli_affected_rows($conn_matcher);
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
		//redirect to correct page
		
	}

}
