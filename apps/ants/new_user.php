<?php
global $rpath;
$rpath="../";
require_once("../game.php");
var_dump($user);

/*
function new_user()
{
global $user;
global $table_allusers;
$the_id=$user['id'];
var_dump($user);
exit(1);
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
return $user;
}
var_dump(new_user())
exit();*/
?>