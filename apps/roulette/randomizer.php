<?php

$name='';
if(isset($_GET['name']))
	$name=$_GET['name'];
$min=0;
$max=4;
$val=0;

   $val=round(($min+lcg_value()*(abs($max-$min))),3);
   $bal=round(fmod($val,0.005),3);
   $val=$val-($bal);
   $dbc=mysqli_connect('localhost','festember','vegas11','festember11');
   $query="INSERT INTO roulette_verify VALUES (NULL,'$name','$val','')";
   $res=mysqli_query($dbc,$query);
   mysqli_close($dbc);
   echo $val;

?>
