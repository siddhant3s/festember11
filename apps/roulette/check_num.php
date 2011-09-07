<?php
$num=0;
$name='';
$time=0.0;

	if(isset($_GET['num']))
        $num=(int)$_GET['num'];
	if(isset($_GET['name']))
	$name=$_GET['name'];
	if(isset($_GET['time']))
        $time=(float)$_GET['time'];

	$carray=array(0,32,15,19,4,21,2,25,17,34,6,27,13,36,11,30,8,23,10,5,24,16,33,1,20,14,31,9,22,18,29,7,28,12,35,3,26);
	$dbtime=0.0;
	$dbnum=0;
	$dbc=mysqli_connect('localhost','root','Jude1234','roulette');
	
	$query="SELECT stoptime, predict_num FROM roulette_verify WHERE username='$name'";
	
	$res=mysqli_query($dbc,$query) or die("asdasd");
	$re=mysqli_fetch_array($res);
	$dbtime=$re['stoptime'];
	$dbnum=$re['predict_num'];
	mysqli_close($dbc);

	$dbc=mysqli_connect('localhost','root','Jude1234','roulette');
        $query="DELETE FROM roulette_verify WHERE username='$name'";
        $res=mysqli_query($dbc,$query) or die("asaaaaa");
	mysqli_close($dbc);
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
			echo "Failed";
	}
	else
		echo "Failed2";

?>

