<?php
session_start();
//"update.php?a="+score+"&b="+level+"&c="+timelimit+"&d="+user+"&e="+personcount+"&f="+coincount
if($_GET['a']>$_SESSION['score'] || $_GET['b']!=$_SESSION['level'] || $_GET['c']!=$_SESSION['time'] || $_GET['d']!=$_SESSION['player'] || $_GET['e']!=$_SESSION['persons'] || $_GET['f']!=$_SESSION['coincount']){
	if($_SESSION['score']==$_GET['a'])
		echo '1';
	else{
		echo '0';
		$_SESSION['tempscore']=$_SESSION['score'];
	}
}
else echo '-1';
?>
