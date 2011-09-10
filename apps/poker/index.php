<?php
	include("header.php");
	$rpath = "../";
	include("../fb.php");
?>
<!DOCTYPE HTML>
<html>
	<head>
		<script type="text/javascirpt"></script>
		<script type="text/javascript" src="canvas.js" ></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.3/jquery.min.js" ></script>
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
		function publish(value) {

		//The following is used to share a link on the player's wall.
		FB.ui({
		  "name":"<?php echo $user["name"]; ?> has just won a game of poker",
		  "link":"http://festember.in/11/",
		  picture:"http://www.donkeypoker.me/wp-content/uploads/2009/10/poker.jpg",
		  caption:"Click on the link to play",
		  description:"Join festember games to play poker in the Festember Casino",
		  "method":"feed",
		//  to:"100000566828426",
		},
		  function(response) {
		    if (response && response.post_id) {
		     	setTimeout(function(){window.location.reload();},500);
		    } else {
		      setTimeout(function(){window.location.reload();},5000);
		    }
		  });
		

		}
		</script>
		
		<div id="wrapper">
		<iframe src="../header.php" scrolling="no" frameborder="0" width="800" id="header"></iframe>
		<div id="tutorials"></div>
		<div id="wrapper1">
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
		<div id="tmoney">Amount Bet:</b><input type="text" value=0 id="bmoney" disabled="disabled" style="width:30px"/></div>
		<div id="binfo" onclick="info()"></div>
		<div id="alert"><p id="alertp"></p></div>
		<div id="info"><img src="images/close.png" height="16" width="16" id="close" onclick="binfo()"/></div>
		<div id="startpage"><input type="button" value="rules" onclick="rules()" id="rules"/><input type="button" value="start" onclick="start()" id="start"/><input type="button" value="HOME" onclick="home()" id="back"/><input type="button" value="NEXT" onclick="next()" id="next"/></div>		<div id="binfo" onclick="info()"></div>
		<div id="alert"><p id="alertp"></p></div>
		<div id="info"><img src="images/close.png" height="16" width="16" id="close" onclick="binfo()"/></div>
		<input type="button" value="Help" onclick="tutorials()" id="tut_button"/>
		</div>		
		</div>
		</div>		
	</body>
</html>
