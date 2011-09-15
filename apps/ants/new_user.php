<?php

function new_user()
{
global $user;
global $table_allusers;
$the_id=$user['id'];
error_log("@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@".var_dump($user));
$result_insert_new_user=mysql_query("insert into '$table_allusers' (user_id,logged) values('$the_id',1)");
error_log("@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@".mysql_error());
	//might need to include a key for theis in the root database ;later
$answer_insert_new_user=mysql_affected_rows();

	if(!$answer_insert_new_user)
		{
			whisk(2);
			exit();
		}
return 1;
}

?>