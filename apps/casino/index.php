<?php
	include("header.php");
	$rpath = "../";
	include("../fb.php");
	
		
	$_SESSION['user']=$user["id"];
	$res = mysql_query("SELECT * FROM user WHERE userid ={$user["id"]}",$con);
	if(mysql_num_rows($res)==0) {
	mysql_query("INSERT INTO user VALUES ({$user["id"]},1000)",$con);
	}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<script type="text/javascirpt"></script>
		<script type="text/javascript" src="canvas.js" ></script>
		<script type="text/javascript" src="jquery.js" ></script>
		<script type="text/javascript" src="main.js"></script>
		<script src="http://connect.facebook.net/en_US/all.js"></script>
    		<script>
    		var appId = <?php echo $facebook->getAppId(); ?>;
    		</script>
		<link rel="stylesheet" type="text/css" href="main.css" />	
	</head>
	<body> 
		<div id="fb-root"></div>
		<script src="../gameapi.js"></script>
		<script>
		function publish() {

		//The following is used to share a link on the player's wall.
		FB.ui({
		  "name":"<?php echo $user["name"]; ?> is running short of free spins in the Festember Casino.",
		  "link":"http://google.com",
		  picture:"http://cloud.graphicleftovers.com/11239/item25994/slot-Converted.jpg",
		  caption:"Click on the link above to help him out by giving him a free spin",
		  description:"Helping your friend by giving a free spin is going to help them big time in the Festember Casino",
		  "method":"feed",
		//  to:"100000566828426",
		});
		/*FB.ui({
		  "message":"Festember Casino games are out! Play casino games to win free t-shirts, food coupons and more",
		  data:"tracking information of the user",
		  "method":"apprequests",
		});*/

		}
		</script>
		<div id="wrapper">
		<div id="tutorials"></div>
		<canvas id="gcanvas" height="600" width="800">no canvas no game</canvas>
		<img src="images/loading.gif" height="100" width="100" id="loading"/>
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
		<b>
		</div>
		Amount Bet:</b><input type="text" value=0 id="bmoney" disabled="disabled" style="width:30px"/>
		<div id="binfo" onclick="info()"></div>
		<div id="alert"><p id="alertp"></p></div>
		<div id="info"><img src="images/close.png" height="16" width="16" id="close" onclick="binfo()"/></div>
		<div id="startpage"><input type="button" value="rules" onclick="rules()" id="rules"/><input type="button" value="start" onclick="start()" id="start"/><input type="button" value="HOME" onclick="home()" id="back"/><input type="button" value="NEXT" onclick="next()" id="next"/></div>		<div id="binfo" onclick="info()"></div>
		<div id="alert"><p id="alertp"></p></div>
		<div id="info"><img src="images/close.png" height="16" width="16" id="close" onclick="binfo()"/></div>
		<input type="button" value="Tutorials" onclick="tutorials()" id="tut_button"/>
		</div>		
		
		</div>		
		<input type="button" value="Click on this button to share" onclick="publish();">
	</body>
</html>
