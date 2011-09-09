<?php
$rpath = "../";
include("../fb.php");
echo "$user:::" . print_r($user) . ":::<br>";
?>
<?php
include("../../connect.php");


	/*$query="DELETE FROM mankatha_random";
	mysql_query($query);*/
	$q="INSERT into game_info(endtime,returnpercent) VALUES(now(),'100')";
	mysql_query($q);
	 
?>
<html>
<head>
<title>hi</title>
<script src="http://connect.facebook.net/en_US/all.js"></script>
</head>
<body>
user :::<?php print_r($user); ?>:::
<div id="fb-root"></div>
    <script>
    var appId = <?php echo $facebook->getAppId(); ?>;
    </script>
<script src="../gameapi.js"></script>
<script>
function publish() {
 FB.ui({
  "name":"<?php echo $user["name"]; ?> has won<?php echo $_SESSION['cht'];?> ",
  "link":"http://google.com",
  picture:"http://cloud.graphicleftovers.com/11239/item25994/slot-Converted.jpg",
  caption:"Click on the link above to help him out by giving him a free spin",
  description:"Helping your friend by giving a free spin is going to help them big time in the Festember Casino",
  "method":"feed",
//  to:"100000566828426",
    });}
</script>
<?php unset($_SESSION['cht']); ?>
<body><img src="ropa.png" alt="" style="position:absolute;left:250px;height:655px;" />
<div style="position:absolute; top:50%; left:45%; color:white;"?>
You won this round.
<input type="button" value="Share it on facebook" onclick="publish();">
<a href="start.php" style="position:absolute;left:5%;top:70%;"><img src="bpa.png" border="0" alt=""/></a>
<a href="index.php" style="position:absolute;left:5%;top:650%;"><img src="bq.png" border="0" alt=""/></a>
</div>
</body>
</html>
