
window.onload = function() {
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
};