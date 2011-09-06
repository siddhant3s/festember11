<?php
		session_start();
	$connection=mysql_connect("localhost","root","");
	if(!$connection){
		die("Databaase connection failed:" . mysql_error());
	}
	$db_select=mysql_select_db("delta",$connection);
	if(!$db_select){
		die("Database connection failed:" . mysql_error());
		}?>
<?php $numbers=range(1,52);
shuffle($numbers);
$number[0]=$numbers[0];
for($i=1;$i<52;$i++)
{	
	if(($numbers[$i]%13)!=($numbers[0]%13))
	{  
		$number[$i]=$numbers[$i];

	}
	else
		{   $number[$i]=$numbers[$i];
			break;
		} 
		
}
	$a=implode(",",$number);
	$query="INSERT INTO mankatha_random(rand)
		VALUES('{$a}')";
	mysql_query($query,$connection);
mysql_close($connection);

 echo json_encode($number);
 ?>
