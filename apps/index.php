<?php
include("fb.php");
?>
<!doctype html>
<html>
  <head>
    <title>Festember Games</title>
    <script src="http://connect.facebook.net/en_US/all.js"></script>
    <script>
      var appId = <?php echo $facebook->getAppId(); ?>; //<?php echo $user["id"] ?>
    </script>
  </head>
  <body>
    <h3>Festember11 Games coming up soon!</h3>
    Hi <?php echo $user["name"]; ?>!<br>
    <div id="fb-root"></div>

    <script src="gameapi.js"></script>
    You have won the game of roulette. <input type="button" value="Share it with your friends" onclick="pub();">

  </body>
</html>
