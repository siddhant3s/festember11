<?php
$rpath = "";
include("fb.php");
?>
<!doctype html>
<html>
  <head>
    <title>Festember Games</title>
    <style>
      body {width:760px;margin: auto; }
    </style>
    <script src="http://connect.facebook.net/en_US/all.js"></script>
    <script>
      var appId = <?php echo $facebook->getAppId(); ?>;
      function pub(o) {
        o.method = "feed";
        FB.ui(o);
      }
      
      obj = {
          name:"<?php echo $user["name"]; ?> has won the game of Roulette in Festember Casino!",
          link:"http://www.festember.in/11/games/",
          picture:"http://www.destination360.com/north-america/us/nevada/images/s/nevada-silver-legacy-resort-casino.jpg",
          caption:"Casino games at Festember 11",
          description:"Play the game now to get goodies and stuff",
       }
    </script>
  </head>
  <body>
    <h3>Festember11 Games coming up soon!</h3>
    Hi <?php echo $user["name"]; ?>!<br>
    <div id="fb-root"></div>
    <script src="gameapi.js"></script>
    You have won the game of roulette. <input type="button" value="Share it with your friends" onclick="pub(obj);">

  </body>
</html>
