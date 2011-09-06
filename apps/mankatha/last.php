<?php	
	session_start();
	$last=array();
	$last=$_SESSION['last'];
	echo json_encode($last);
	session_destroy();
	?>