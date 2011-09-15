
<?php
function new_user($the_conn)
{
$the_id=$user['id'];
$result_insert_new_user=mysql_query("insert into '$table_allusers' (user_id,logged) values('$the_id',1)");
var_dump(mysql_error());exit();
	//might need to include a key for theis in the root database ;later
$answer_insert_new_user=mysql_affected_rows($the_conn);

	if(!$answer_insert_new_user)
		{
			whisk(2);
			exit();
		}
return 1;
}
?>