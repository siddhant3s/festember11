<?php
require_once("allglobals.php");
?>



<?php
function whisk($a)
{
global $redirection;
$the_overall_url=$redirection."?err=".$a;
header("Location:$the_overall_url");	
}	



?>



