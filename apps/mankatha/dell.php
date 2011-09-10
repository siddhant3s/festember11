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
<div id="wrapper" style="background-image:url('mangatha cover.png'); width:800px; height:600px;">
<div style="color:white;"?>
You lost this round.
<a href="start.php" style="position:absolute;left:50px;top:400px;"><img src="bpa.png" border="0" alt=""/></a>
<a href="index.php" style="position:absolute;rigt:50px;top:400px;"><img src="bq.png" border="0" alt=""/></a>
</div>
</div>
</body>
</html>
