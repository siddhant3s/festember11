<?php 
include("../game.php");
$rpath = "../";
include("../fb.php");
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
<head>
<title>Slot Machine</title>

<link rel="stylesheet" type="text/css" href="main.css" />
<script language='javascript' src="jquery.js"></script>
<script src="../http://connect.facebook.net/en_US/all.js"></script>
<script src="../gameapi.js" type="text/javascript"></script>
<script language='javascript' src="ocanvas.js" ></script>
<script language='javascript' src="myscript.js" ></script>
<script>
var appId = <?php echo $facebook->getAppId(); ?>;
function sharewin() {
      obj = {
          name:"<?php echo $user["name"]; ?> has won the game of Roulette in Festember Casino!",
          link:"http://www.festember.in/11/games/",
          picture:"http://1.bp.blogspot.com/_bNEcw3z5M20/TBpGFBUkWKI/AAAAAAAAADA/1MPHBgQQYTw/s320/online-blackjack.gif",
          caption:"Casino Games at FESTEMBER 11",
          description:"Play the game now to get goodies and stuff..!",
       }
       pub(obj);  
}

function pub(o) {
       o.method = "feed";
        FB.ui(o);
      }
</script>
</head>

<body>
<div id="canvas_div" style="position:relative;" height=500px width=1200px> 
<canvas id='canvas' height=500px width=1200px > <p> Your Browser does not support Canvas!!! </p></canvas>

</div>
</body>

</html>
