<?php
require_once("../game.php");
require_once("allglobals.php");
require_once("whisk.php");


$the_error_code=0;
?>






<?php
if((isset($_POST['submit'])) &&( isset($_POST['bet'])) )
{
	$done_match=0;
$current_users_balance=getCash();
$bet_entered=mysqli_real_escape_string($conn_moderator,$_POST['bet']);
   if(!is_numeric($bet_entered))
    {
    $the_error_code=1;
    whisk(1);
    exit(1);	
    }
if($bet_entered<=0)
	{
	echo "1";
	exit(1);			
	}
if($bet_entered>$current_users_balance)
	{
	echo "2";
	exit(1);
	}
else if(isset($_POST['confirmation']))	
	{
	$done_match=1;					
	}
else if($bet_entered==$current_users_balance) {
						echo "3";
						exit(1);
			 			}	
else {$done_match=1;}


if($done_match==1)
	{
	matcher();
	exit(1);				
	}
else
	{
	whisk(99);
	exit(1);
	}
}



























?>