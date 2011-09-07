<?php
	if(isset($_GET['num']))
	$num=$_GET['num'];
	if(isset($_GET['name']))
        $name=$_GET['name'];
	$dbc=mysqli_connect('localhost','festember','vegas11','festember11');
	
	$query="UPDATE roulette_verify SET predict_num='$num' WHERE username='$name'";
	
	$res=mysqli_query($dbc,$query) or die("nononono");
	
	mysqli_close($dbc);


?>

