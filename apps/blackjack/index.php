<?php
include("../fb.php");
include("../game.php");


?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 

 
<link href="d.css" rel="stylesheet" type="text/css"> 
<head>
<style type="text/css">
body{
color:white;
background-color:black;
}
input.button {
  margin-top: .25em;
  width: 8em;
margin:5px;
padding:5px;

 cursor:pointer;
 background:white;

 

 --webkit-border-radius: 20px; 
-moz-border-radius: 20px; 
border-radius: 20px; 

}
 
 input.button:hover{
 background:brown;
color:white;
border-color:#7F5217;
-webkit-box-shadow:15px 15px 15px #ffffff;
-moz-box-shadow:15px 15px 15px #ffffff;
box-shadow:15px 15px 15px #ffffff;

 }
 #powered{
 size:200px;
 }
#si{
width:400px;
margin:0 auto;
}
#shine{
width:600px;
margin: 0 auto;
}
#nick{
opacity:0.8;
background-color:white;
font-weight:bold;
}
#pnick{
display:none;
}
#nick:hover{
opacity:1;
background:brown;
color:white;
font-weight:bold;
}

</style>
<script src="jquery.js" type="text/javascript"></script>
<script src="jquery-1.6.2.js" type="text/javascript"></script>
<script src="jquery.js" type="text/javascript"></script>
<script src="illuminate.js" type="text/javascript"></script>
<script src="start.js" type="text/javascript"></script>
<script src="script.js" type="text/javascript"></script>

   <script src="../http://connect.facebook.net/en_US/all.js"></script>
   <script src="../gameapi.js" type="text/javascript"></script>

<script>
      var appId = <?php echo $facebook->getAppId(); ?>;
     function sharewin() {
      obj = {
          name:"<?php echo $user["name"]; ?> has won the game of Blackjack in Festember Casino!",
          link:"http://www.festember.in/11/games/",
          picture:"http://1.bp.blogspot.com/_bNEcw3z5M20/TBpGFBUkWKI/AAAAAAAAADA/1MPHBgQQYTw/s320/online-blackjack.gif",
          caption:"Casino Games at FESTEMBER 11",
          description:"Play the game now to get goodies and stuff..!",
       }
       pub(obj);  
}

function pub(o) {
       o.method = "feed";
        FB.ui(o);
      }
    </script>


</head>
<body> 
<script type="text/javascript">

function doit()
{

self.location="blackjack.php";


}



</script>
<div align="center" id="shine">
<br><br>
<img src="blackjack.jpg" width="600px" id="lk"/>
 
<br><input type="button" class="button" value="play blackjack" onclick="doit()"></button>
<input type="button" class="button" value="fb share" onclick="sharewin()"></button>
</div>
<div align="right" id="si" class="si">
<h2 id="illu" class="si"><font face="monotype corsiva" id="powered">Powered by festember for u..!</font></h2>

</div>


</body>
</html>
