<?php
$rpath="../";
include("../fb.php");
?>
<?php
	include("../../connect.php");
	    	$query="DELETE FROM mankatha_random";
	mysql_query($query);
$q="UPDATE game_info 
SET endtime=now(),
 returnpercent='0',
 WHERE playerid='".$user['id']."'";
	    mysql_query($q);
unset($_SESSION['cht']);
?>
<html>
<title>you lost</title>
<body>
<div id="wrapper" style="background-image:url('mangatha cover.png');">
<div style="position:absolute; top:50%; left:45%; color:white;"?>
You lost this round.
<a href="start.php" style="position:absolute;left:5%;top:70%;"><img src="bpa.png" border="0" alt=""/></a>
<a href="index.php" style="position:absolute;left:5%;top:650%;"><img src="bq.png" border="0" alt=""/></a>
</div>
</div>
</body>
</html>
