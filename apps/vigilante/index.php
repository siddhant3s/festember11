<?php
require_once("db_conn.php");
$sql="select level,username from vigilante where username="$_GET[''];
$query=mysql_query($sql,$conn);
$result=mysql_fetch_array("$query","$conn");
switch($result)
{
case 1:
echo "<img src=\"/images/level1\" />";
break;
case 2:
echo "<img src=\"/images/level2\" />";
break;
case 3:
echo "<img src=\"/images/level3\" />";
break;
case 4:
echo "<img src=\"/images/level4\" />";
break;
}

?>
<html>
<head>
	<title>
		Vigilante
	</title>
	<link rel="stylesheet" type="text/css" href="index.css"></link>
	<!--[if lt IE 9]>
		<script type="application/javascript" src="excanvas.js"></script>
	<![endif]-->
	<script type="application/javascript" src="index.js"></script>
</head>
<body onload="bodyLoad()" onkeydown="keyPress(event)">
<input type="hidden" id="userinfo" value="username" />
<input type="hidden" id="levelinfo" value="1" />
<input type="hidden" id="leveldesc" value="" />
<input type="hidden" id="persons" value="5" />
<div id="checkdiv"></div>
<div id="wrapper">
<canvas id="backgroundCanvas" z-index=1>HTML5 canvas are not supported! Please update your browser to a newer version: IE7, Firefox 4.1 or Chrome 7</canvas>
<canvas id="scratchpadCanvas" z-index=2></canvas>
<canvas id="lidCanvas" z-index=3></canvas>
</div>
<div id="stockDiv">
<img src="images/personu.png" id="personu" />
<img src="images/coin.png" id="coin" />
<img src="images/persond.png" id="persond" />
<img src="images/personl.png" id="personl" />
<img src="images/personr.png" id="personr" />
<img src="images/baru.png" id="baru" />
<img src="images/bard.png" id="bard" />
<img src="images/barl.png" id="barl" />
<img src="images/barr.png" id="barr" />
<img src="images/levelbg.png" id="levelbg" />
</div>

</body>
</html>
