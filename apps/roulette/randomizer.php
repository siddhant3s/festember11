<?php
include("getuser.php");
include("../../connect.php");

$min=0;
$max=4;
$val=0;

   $val=round(($min+lcg_value()*(abs($max-$min))),3);
   $bal=round(fmod($val,0.005),3);
   $val=$val-($bal);
   $sql="INSERT INTO roulette_verify VALUES (NULL,{$usid},{$val},'-1') ON DUPLICATE KEY UPDATE stoptime={$val} AND predict_num='-1'";
   $result=mysql_query($sql);
   echo $val;

?>
