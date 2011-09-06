<?php
$rpath = "../";
include("../fb.php");
?>
<html>
<head>
<title>hi</title>
    <script src="http://connect.facebook.net/en_US/all.js"></script>
    <script>
    var appId = <?php echo $facebook->getAppId(); ?>;
    </script>
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

//The output of the on executing the above code would be:

//When the user clicks on the share button, it will be posted on the player's wall, like this:



//The following is used to send an application request to the player's friends.

/*FB.ui({
  "message":"Festember Casino games are out! Play casino games to win free t-shirts, food coupons and more",
  data:"tracking information of the user",
  "method":"apprequests",
});*/

}
</script>
<input type="button" value="Click on this button to share" onclick="publish();">
</body>
</html>