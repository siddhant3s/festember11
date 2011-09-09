<?php 
$rpath = "../";
include("../fb.php");
include("../game.php");
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Festember11 - Roulette</title>

<link rel="stylesheet" type="text/css" href="main.css" />

</head>

<body bgcolor="#000000">
<div id="fb-root"></div>
<div id="canvas_div" style="position:relative;" height=500px width=1200px> 

<canvas id='canvas' height=500px width=1200px > <p> Your Browser does not support Canvas!!! </p></canvas>

</div>
<script language='javascript' src="jquery.js"></script>
<script src="http://connect.facebook.net/en_US/all.js"></script>
<script>var appId = <?php echo $facebook->getAppId(); ?>;</script>
<script language='javascript' src="ocanvas.js" ></script>

<script src="../gameapi.js" type="text/javascript"></script>
<script language='javascript'>
console.log("<?php echo getCash(); echo $user["name"]; echo $user["id"];  ?>");

function getMyCash() {
return <?php echo getCash(); ?>
}

function getMyXP() {
return <?php echo getXP(); ?>
}

function boastcash() {
      obj = {
          name:"<?php echo $user["name"]; ?> has been playing Roulette in Festember Casino!!! And he possesses $<?php echo getCash(); ?>!!!",
          link:"http://www.festember.in/11/games/",
          picture:"http://www.pragyan.org/~boopathi/festember11/apps/roulette/roulette_share.jpg",
          caption:"Casino Games at FESTEMBER 11",
          description:"Play the Game, Try your Luck and Hit the Jackpot!!!",
       }
       pub(obj);  
}

function boastwin() {
      obj = {
          name:"<?php echo $user["name"]; ?> has just hit Jackpot and won 300$ in Roulette in the Festember11 Casino Games!",
          link:"http://www.festember.in/11/games/",
          picture:"http://www.pragyan.org/~boopathi/festember11/apps/roulette/roulette_share.jpg",
          caption:"Casino Games at FESTEMBER 11",
          description:"Join the fun and see if you Get Lucky!!!!",
       }
       pub(obj);  
}

function pub(o) {
       o.method = "feed";
        FB.ui(o);
      }
</script>
<script language='javascript' src="myscript.js" ></script>
</body>

</html>
