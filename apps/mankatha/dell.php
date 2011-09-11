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
<body style="margin:0px;">
<div id="wrapper" style="background-image:url('mangatha cover.png'); width:800px; height:600px;">
<div style="color:white;"?>
<p style="position:absolute;left:350px;top:350px;">You lost this round.</p>
<a href="start.php" style="position:absolute;left:50px;top:400px;"><img src="bpa.png" border="0" alt=""/></a>
<a href="index2.php" style="position:absolute;left:550px;top:400px;"><img src="bq.png" border="0" alt=""/></a>
</div>
</div>
</body>
</html>
