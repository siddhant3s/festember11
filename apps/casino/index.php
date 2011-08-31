<?php include("header.php");?>
<?php
	session_start();
	$_SESSION['user']=$_GET['user'];
?>
<!DOCTYPE HTML>
<html>
	<head>
		<script type="text/javascirpt">
			
		</script>
		<script type="text/javascript" src="canvas.js" > 
		</script>
		<script type="text/javascript" src="jquery.js" > 
		</script>
		<script type="text/javascript" src="main.js">
			
		</script>
		<link rel="stylesheet" type="text/css" href="main.css" />	
	</head>
	<body> 
		<div id="wrapper">
		<canvas id="gcanvas" height="600" width="800">no canvas no game</canvas>
		<div id="coins">
		<img src="images/5.png" height="60" width="60" id="five" onclick="add('5')"/>
		<img src="images/10.png" height="60" width="60" id="ten" onclick="add('10')"/>
		<img src="images/25.png" height="60" width="60" id="twenty" onclick="add('25')"/>
		<img src="images/50.png" height="60" width="60" id="fifty" onclick="add('50')"/>
		</div>
		<div id="inputs"><input type="button" value="-" onclick="sub()" id="sub"/>
		<input type="text" value=0 id="money" disabled="disabled" style="width:30px"/>
		<input type="button" value="bet" id="bet" onclick="bet()"/>
		<input type="button" value="fold" onclick="fold()" id="fold"/>
		<b>Amount Bet:</b><input type="text" value=0 id="bmoney" disabled="disabled" style="width:30px"/>
		</div>
		<div id="binfo" onclick="info()"></div>
		<div id="alert"><p id="alertp"></p></div>
		<div id="info"><img src="images/close.png" height="16" width="16" id="close" onclick="binfo()"/></div>
		<div id="startpage"><input type="button" value="rules" onclick="rules()" id="rules"/><input type="button" value="start" onclick="start()" id="start"/><input type="button" value="HOME" onclick="home()" id="back"/><input type="button" value="NEXT" onclick="next()" id="next"/></div>		<div id="binfo" onclick="info()"></div>
		<div id="alert"><p id="alertp"></p></div>
		<div id="info"><img src="images/close.png" height="16" width="16" id="close" onclick="binfo()"/></div>
		</div>		
		</div>		
		
	</body>
</html>
