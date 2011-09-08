<?php
	include("../../connect.php");
	    	$query="DELETE FROM mankatha_random";
	mysql_query($query);
$date=date_create();
	    $d=date_format($date,'Y-m-d H:i:s');
	    $q="INSERT into game_info(endtime,returnpercent) VALUES('{$d}','0')where playerid='" . $user["id"]."'";
	    mysql_query($q);
unset($_SESSION['cht']);
?>
<html>

<body><img src="ropa.png" alt="" style="position:absolute;left:250px;height:655px;" />
<div style="position:absolute; top:50%; left:45%; color:white;"?>
You lost this round.
<a href="start.php" style="position:absolute;left:5%;top:70%;"><img src="bpa.png" border="0" alt=""/></a>
<a href="index.php" style="position:absolute;left:5%;top:650%;"><img src="bq.png" border="0" alt=""/></a>
</div>
</body>
</html>
