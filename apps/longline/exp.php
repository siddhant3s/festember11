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
  "name":"<?php echo $user["name"]; ?> won the game Longline .",
  "link":"http://www.festember.in/11/apps/longline",
  picture:"http://www.clipartguide.com/_named_clipart_images/0511-0810-1304-1534_Face_Playing_Cards_clipart_image.jpg",
  caption:"Click on the link above to play the game-longline",
  description:"A card game played with 32 cards ",
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