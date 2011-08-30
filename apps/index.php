<?php
session_start();

require_once "facebook/src/facebook.php";
include_once "../facebook_details.php";//should contain app_id and app_secrete
$fbuser=$facebook->getUser();
$fbperm=array();
$fbperm['scope'] = "email,publish_stream";

$user = $facebook->api("/me");
?>
<!doctype html>
<html>
  <head>
    <title>Festember Games</title>
    <script src="http://connect.facebook.net/en_US/all.js"></script>
    <script>
      var appId = <?php echo $facebook->getAppId(); ?>;
    </script>
  </head>
  <body>
    <h3>Festember11 Games coming up soon!</h3>
    Hi <?php echo $user["name"]; ?>!<br>
    <div id="fb-root"></div>

    <script>
      FB.init({
        appId:appId,
        status:true,
        cookie:true,
        fbml:true,
        oauth:true,
      });
      function pub() {
        FB.ui({
          method:"feed",
          name:"<?php echo $user["name"]; ?> has won the game of roulette in Festember Casino!",
          link:"http://www.festember.in/11/games/",
          picture:"http://www.destination360.com/north-america/us/nevada/images/s/nevada-silver-legacy-resort-casino.jpg",
          caption:"Casino games at Festember 11",
          description:"Play the game now to get goodies and stuff",
       });
      }
    </script>
    You have won the game of roulette. <input type="button" value="Share it with your friends" onclick="pub();">

  </body>
</html>
