<?php
$connection=mysql_connect("localhost","festember","vegas11");

if(!$connection){

  die("Databaase connection failed:" . mysql_error());

}

$db_select=mysql_select_db("festember11",$connection);

if(!$db_select){

  die("Database connection failed:" . mysql_error());

}



$k=0;
$j=0;
$numbers=range(1,52);
shuffle($numbers);
$ref=$numbers[0];
$a=array();
$b=array();
$c=array();
$dec=mt_rand(1,100)/100;

for($i=1;$i<52;$i++)
{
	if($ref%13==$numbers[$i]%13)
	{
		$a[$k]=$numbers[$i];
		$k++;
	}
}
for($i=1;$i<52;$i++)
{	if($ref%13!=$numbers[$i]%13)
	 {
		 if($k<26)
		{	$a[$k]=$numbers[$i];
			$k++;
		}
		else 
		{
		$b[$j]=$numbers[$i];
		$j++;
		}
	 }
}

$x=0;
$y=0;
shuffle($a);
shuffle($b);
$c[0]=$numbers[0];

if($dec>0.7)
{
	for($i=1;$i<52;$i++)
	{
		if($i%2==0)
		{
			$c[$i]=$b[$y];
			$y++;
		}
		else
		{
			$c[$i]=$a[$x];
			$x++;
		}
	}
}
else
{
	for($i=1;$i<51;$i++)
	{
		if($i%2==0)
		{
			$c[$i]=$a[$x];
			$x++;
		}
		else
		{
			$c[$i]=$b[$y];
			$y++;
		}
	}
	
}
	$a=implode(",",$c);
	$query="INSERT INTO mankatha_random(rand)
		VALUES('{$a}')";
mysql_query($query);
	 echo json_encode($c);

 ?>
 
