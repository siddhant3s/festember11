<?php include("../../connect.php");?>
<?php include("getuser.php");?>
<?php include("../gamearray.php");?>
<?php
	$sql="SELECT insert_ref FROM roulette_verify WHERE username='$usid'";
        $res=mysql_query($sql);
	$row=mysql_fetch_array($res);
	$refid=$row[0];
	
	$res=mysql_query("UPDATE game_info SET endtime=now(), returnpercent={$_POST['return_perc']} WHERE gameiid={$refid}");
	
	$sql="DELETE FROM roulette_verify WHERE username='$usid'";
        $res=mysql_query($sql);
?>

