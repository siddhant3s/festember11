<?php
include("fb.php");
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
    <script src="gameapi.js"></script>
<script>
function publish() {
/*FB.ui({
  "name":"<?php echo $user["name"]; ?> is running short of free spins in the Festember Casino.",
  "link":"http://google.com",
  picture:"http://cloud.graphicleftovers.com/11239/item25994/slot-Converted.jpg",
  caption:"Click on the link above to help him out by giving him a free spin",
  description:"Helping your friend by giving a free spin is going to help them big time in the Festember Casino",
  "method":"feed",
  to:"100000566828426",
});*/

FB.ui({
  "message":"Festember Casino games are out! Play casino games to win free t-shirts, food coupons and more",
  data:"tracking information of the user",
  "method":"apprequest",
});

}
//FB.api("/100000566828426/feed","post",{message:"hi"});
</script>
<input type="button" value="Click here to Share" onclick="publish();">
</body>
</html>

<?php

die;
class Festigame
{
protected $vari;
public function __construct() {
$this->vari = "100a";
}

public function __toString() {
  return "The value of $vari is : " . $this->vari;
}
}

//echo (new Festigame());

$rpath = "";
include("fb.php");

print_r($facebook->api("/me/friends"));

//$arr["from"] = $user["id"];
//$arr["to"] = "100000566828426";
$arr["message"] = "hello!";
$facebook->api("/me/feed",$arr);
?>