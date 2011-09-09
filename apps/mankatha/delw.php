<?php
$rpath = "../";
include("../fb.php");
?>
<?php
	include("../../connect.php");
	$query="DELETE FROM mankatha_random";
	mysql_query($query);
	$q="INSERT into game_info(endtime,returnpercent) VALUES(now(),'100')";
	mysql_query($q);
?>
<html>
<head>
<title>you won!!!</title>
<script src="http://connect.facebook.net/en_US/all.js"></script>
</head>
<body>
<div id="fb-root"></div>
    <script>
    var appId = <?php echo $facebook->getAppId(); ?>;
    </script>
<script src="../gameapi.js"></script>
<script>
function publish() {
 FB.ui({
  "name":"<?php echo $user["name"]; ?> has won the game of Mankatha in the Festember Casino!",
  "link":"http://festember.in/11/apps/",
  picture:"http://www.casinoreviewbank.com/dictionary_images/Card_Game.jpg",
  caption:"Ulley Veliye....Ulley Veliye....Ulley Veliye....Ulley Veliye....",
  description:"Come to the Festember Casino to gamble with virtual money and win goodies and prizes worth of INR 15,000/-",
  "method":"feed",
 });
}
</script>
<?php unset($_SESSION['cht']); ?>
<body><img src="ropa.png" alt="" style="position:absolute;left:250px;height:655px;" />
<div style="position:absolute; top:50%; left:45%; color:white;"?>
You won this round.
<a href='#' onClick="return publish()"><img name="jsbutton" src="fb.jpg" alt="javascript button"></a>
<a href="start.php" style="position:absolute;left:5%;top:70%;"><img src="bpa.png" border="0" alt=""/></a>
<a href="index.php" style="position:absolute;left:5%;top:650%;"><img src="bq.png" border="0" alt=""/></a>
</div>
</body>
</html>
