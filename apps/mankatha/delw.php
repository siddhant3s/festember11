<?php
		session_start();
$connection=mysql_connect("localhost","festember","vegas11");

if(!$connection){

  die("Databaase connection failed:" . mysql_error());

}

$db_select=mysql_select_db("festember11",$connection);

if(!$db_select){

  die("Database connection failed:" . mysql_error());

}



	$query="DELETE FROM mankatha_random";
mysql_query($query);
?>
<html>

<body><img src="ropa.png" alt="" style="position:absolute;left:250px;height:655px;" />
<div style="position:absolute; top:50%; left:45%; color:white;"?>
You won this round.
<a href="start.php" style="position:absolute;left:5%;top:70%;"><img src="bpa.png" border="0" alt=""/></a>
<a href="index.php" style="position:absolute;left:5%;top:650%;"><img src="bq.png" border="0" alt=""/></a>
</div>
</body>
</html>