<?php 
$rpath = "../";
include("../game.php");
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Festember11 - Roulette</title>

<link rel="stylesheet" type="text/css" href="main.css" />

</head>

<body bgcolor="#000000">
<div id="wrapper">
<div id="frame"><iframe src="../header.php" scrolling="no" frameborder="0" width="1200" id="header"></iframe></div>
<div id="fb-root"></div>


<canvas id='canvas' height=500px width=1200px > <p> Your Browser does not support Canvas!!! </p></canvas>


<script language='javascript' src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.3/jquery.min.js"></script>
<script src="http://connect.facebook.net/en_US/all.js"></script>
<script>var appId = <?php echo $facebook->getAppId(); ?>;</script>
<script language='javascript' src="ocanvas.js" ></script>

<script src="../gameapi.js" type="text/javascript"></script>
<script language='javascript'>
console.log(<?php echo $user['id'];  ?>)
function getMyCash() {
return <?php echo getCash(); ?>
}

function getMyXP() {
return <?php echo getXP(); ?>
}

function boastcash() {
      FB.ui({
          name:"<?php echo $user["name"]; ?> is having the time of his life at Roulette in Festember Casino!!!",
          link:"http://www.festember.in/11/games/",
          picture:"http://www.pragyan.org/~boopathi/festember11/apps/roulette/roulette_share.jpg",
          caption:"Casino Games at FESTEMBER 11",
          description:"Play Games, Try your Luck and Hit the Jackpot Vegas Style!!!",
	  method:"feed",
       });
}
</script>
<script language='javascript' src="myscript.js" ></script>
</div>
</body>

</html>
