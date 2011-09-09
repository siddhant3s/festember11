<?php
include("getuser.php");
include("../../connect.php");
$num=0;
$time=0.0;

	if(isset($_GET['num']))
        $num=(int)$_GET['num'];
	if(isset($_GET['time']))
        $time=(float)$_GET['time'];

	$carray=array(0,32,15,19,4,21,2,25,17,34,6,27,13,36,11,30,8,23,10,5,24,16,33,1,20,14,31,9,22,18,29,7,28,12,35,3,26);
	$dbtime=0.0;
	$dbnum=0;
	$sql="SELECT stoptime, predict_num FROM roulette_verify WHERE username='$usid'";
	$res=mysql_query($sql);
	$re=mysql_fetch_array($res);
	$dbtime=$re['stoptime'];
	$dbnum=$re['predict_num'];
        $sql="DELETE FROM roulette_verify WHERE username='$usid'";
        $res=mysql_query($sql);
	$c1=$dbnum-8;
	$c2=$dbnum-9;
	$c3=$dbnum-7;
	if(($c1)<0)
        $c1=$carray[36-(7-$dbnum)];
        else
        $c1=$carray[$dbnum-8];
	if(($c2)<0)
	$c2=$carray[36-(8-$dbnum)];
	else
	$c2=$carray[$dbnum-9];
	if(($c3)<0)
	$c3=$carray[36-(6-$dbnum)];
	else
	$c3=$carray[$dbnum-7];
	echo "$c1 $c2 $c3 $carray[$num]";
	if($time==$dbtime)
	{
		if($carray[$num]==$c1 || $carray[$num]==$c2 || $carray[$num]==$c3)
			echo "Verified";
		else
			echo "Failed Num Check";
	}
	else
		echo "Failed Time Check";

?>

