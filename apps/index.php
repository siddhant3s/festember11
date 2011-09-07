<?php
$rpath = "";
include("fb.php");
?>
<html>
<head>
<title>FESTEMBER 11</title>
<link href="main.css" type="text/css" rel="stylesheet"/>
<script type="text/javascript" src="jquery.js" ></script>
<script src="http://connect.facebook.net/en_US/all.js"></script>
<script type="text/javascript">
  var appId = <?php echo $facebook->getAppId(); ?>;
  function pokere()
  {
    $("#poker_img").css({
      "opacity":"1"
    });
  }
  function pokerl()
    {
    $("#poker_img").css({
      "opacity":"0"
    });
  }

  function mankathae()
  {
    $("#mang_img").css({
      "opacity":"1"
    });
  }

  function mankathal()
  {
    $("#mang_img").css({
      "opacity":"0"
    });
  }
  
  $(document).ready(function() {
  
    $("#roulette").hover(function() {
        $("#roul_img").css({
            "opacity":"1"
        });
    },function() {
        $("#roul_img").css({
            "opacity":"0"
        });
    });

    $("#claw").hover(function() {
        $("#claw_img").css({
            "opacity":"1"
        });
    },function() {
        $("#claw_img").css({
            "opacity":"0"
        });
    });

 $("#blackjack").hover(function() {
        $("#bljack_img").css({
            "opacity":"1"
        });
    },function() {
        $("#bljack_img").css({
            "opacity":"0"
        });
    });
 
 $("#slotm").hover(function() {
        $("#slot_img").css({
            "opacity":"1"
        });
    },function() {
        $("#slot_img").css({
            "opacity":"0"
        });
    });

 $("#slotm1").hover(function() {
        $("#slot1_img").css({
            "opacity":"1"
        });
    },function() {
        $("#slot1_img").css({
            "opacity":"0"
        });
    });
 $("#ants").hover(function() {
        $("#ants_img").css({
            "opacity":"1"
        });
    },function() {
        $("#ants_img").css({
            "opacity":"0"
        });
    });

});
</script>
</head>
<body>
<div id="fb-root"></div>
<script src="gameapi.js"></script>

<div style="position:absolute; background-color:rgba(225,225,225,.9); height:70px; width:100%;">
<div style="float:right; "><input type="button" value="Invite" onclick="invite();"> your friends to play the game and gain more xp points</div>
<iframe src="http://www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fapps%2Fapplication.php%3Fid%3D263593520331172%26sk%3Dwall&amp;width=292&amp;colorscheme=light&amp;show_faces=false&amp;border_color=%23444&amp;stream=false&amp;header=false&amp;height=62" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:292px; height:62px;" allowTransparency="true" style="position:absolute; "></iframe>
</div>

<div id="div_game"><img src="images/main casino pg.jpg" alt="casino" />
<div id="poker" onmouseover="pokere()" onmouseout="pokerl()"><a href="#"><img src="images/POKER1.png" alt="poker" width="380" id="poker_img"></a></div>
<div id="roulette"><a href="#"><img src="images/roulette1.png" alt="roulette" width="450" id="roul_img"></a></div>
<div id="mankatha" onmouseover="mankathae()" onmouseout="mankathal()"<a href="#">><img src="images/MANKATHA1.png" alt="mankatha" width="310" id="mang_img"></a></div>
<div id="claw" ><a href="#"><img src="images/CLAWS1.png" alt="claw" width="500" id="claw_img"></a></div>
<div id="blackjack"><a href="#"><img src="images/BLACK JACK1.png" alt="blackjack" width="530" id="bljack_img"></a></div>
<div id="slotm"><a href="#"><img src="images/slot1.png" alt="slot" width="360" height="280" id="slot_img"></a></div>
<div id="slotm1"><a href="#"><img src="images/slot1.png" alt="slot1" width="265" id="slot1_img"></a></div>
<div id="ants"><a href="#"><img src="images/ants1.png" alt="slot" width="300"id="ants_img"></a></div>
</div>
</body></html>
