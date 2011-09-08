<?php
session_start();
if($_POST['a']>$_SESSION['score'] || $_POST['b']!=$_SESSION['level'] || $_POST['c']!=$_SESSION['time'] || $_POST['d']!=$_SESSION['player'] || $_POST['e']!=$_SESSION['persons'] || $_POST['f']!=$_SESSION['coincount']){
	if($_SESSION['tempscore']!=$_SESSION['score'] || $_SESSION['score']!=$_POST['a'])
		echo '0';
	else{
		require('db_conn.php');
		$_SESSION['level']+=1;
		
		$q="UPDATE  `$DB_NAME`.`vigilante_users` SET  `level`='{$_SESSION['level']}' WHERE  `vigilante_users`.`name`='{$_SESSION['namee']}' LIMIT 1;";
	 	if(!mysql_query($q))
			echo '0';
		else
			echo '1';
	}
}
?>
