<?php
global $rpath;
$rpath="../";
require_once("../game.php");
require_once("allglobals.php");
require_once("whisk.php");

?>


<?php
function new_user($the_conn)
{
$the_id=get_the_fb_id();
$result_insert_new_user=mysql_query("insert into '$table_allusers' (fb_id,logged) values('$the_id',1)");
	//might need to include a key for theis in the root database ;later
$answer_insert_new_user=mysqli_affected_rows($the_conn);

	if(!$answer_insert_new_user)
		{
			whisk(2);
			exit();
		}
return 1;
}
?>