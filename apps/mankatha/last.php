<?php	
include("../game.php");
	$last=array();
	$last=$_SESSION['last'];
	echo json_encode($last);
	?>