
<?php
session_start();
global $rpath;
$rpath="../";
require_once("allglobals.php");
require_once("../game.php");
require_once("whisk.php");
require_once("turn.php");
global $user;
$first_turn_over=0;
$a_the_ampersand=0;
//#######################################################################################
	//get the game hash from the session;
		$the_current_hash=$_SESSION['thegamehashforants'];
		if(!$the_current_hash)
			{
			
				whisk();
				exit(1);
			}
//#######################################################################################

$the_value_returned_from_turn=turn($the_current_hash,1);
$a_the_ampersand=preg_match("/^&&&/",$the_value_returned_from_turn);
if($a)
{
$first_turn_over=1;
}
else if($a)
{
$first_turn_over=0;
}
//#######################################################################################
?>
<html>
<head>
<style type="text/css">
body{background-image:url(back.jpg);opacity:1.0;}
#complete{width:80%;height:99%;margin:auto;border-color:white;border-style:solid;}
#head_logo{width:99%;height:107px;margin:auto;border-color:white;border-style:solid;}
#status{width:99%;height:75px;margin:auto;border-color:white;border-style:solid;margin-bottom:5px;border-radius:35px;background-color:black;opacity:0.7;}
#whose_turn{width:24%;height:91%;background-color:green;opacity:0.8;z-index:9;border-top-left-radius:35px;border-bottom-left-radius:35px;border-style:ridge;padding-bottom:2px;padding-top:2px;}
#allcards_here{width:99%;height:64%;;margin:auto;border-color:white;border-style:solid;border-radius:7px;display:block;vertical-align:inherit; }
#opponents_cards{width:99%;height:90px;border-color:white;border-style:solid; ;margin: auto;}
#oppslot1{margin-left: 30px;;width:66px;height:80px;float:left;border-color:white;border-style:solid;margin-right:40px;margin-top: 3px;}
#oppslot2{margin-left: 30px;width:66px;height:80px;float:left;border-color:white;border-style:solid;margin-right:40px;margin-top: 3px;}
#oppslot3{margin-left: 30px;width:66px;height:80px;float:left;border-color:white;border-style:solid;margin-right:40px;margin-top: 3px;}
#opponentcolonyfull{margin-left: 50px;width:500px;height:82px;float:left;border-color:white;border-style:solid;margin-right:40px;margin-top: 3px;border-radius:10px;}
#draw_and_discard{width:99%;height:135px;border-color:white;border-style:solid;;margin: auto;border-radius:10px;}
#my_cards{width:99%;height:140px;border-color:white;border-style:solid;margin: auto;border-radius:25px;}
.class_of_cards_at_colony_and_my{width:75px;height:120px;border-color:white;border-style:solid;border-color:white;border-style:solid;}
.class_of_cards_at_opponent{width:64px;height:85px;border-color:white;border-style:solid;}
#draw{float: left;margin-left:350px;}
#discard{float: left;margin-left:200px;}
#mycolonyfull{width:600px;height:122px;border-color:white;border-style:solid;float: left;margin-top: 5px;margin-left:20px;margin-right: 20px;}
#myslot1{float:left;margin-left:20px;margin-right:30px;margin-top:5px;}
#myslot2{float:left;margin-left:20px;margin-right:30px;margin-top:5px;}
#myslot3{float:left;margin-left:20px;margin-right:30px;margin-top: 5px;}
#draw{margin-top: 4px;}
#oppcol{width: 66px;height: 80px;float: left;border-color: white;border-style: solid;}
#discard{margin-top: 4px;}
</style>
<script type="text/javascript" src="jquery-1.3.2.min.js">
</script>
</head>
<body>
<div id="complete">
<div id="head_logo"></div>
<div id="status">
<div id="whose_turn">
<?php
if($not_the_first_hit){echo "<h1>opponent's turn</h1>";}
else if($not_the_first_hit){echo "<h1>your turn</h1>";}
?>
</div>
<div id="last_move"></div>
</div>
<div id="allcards_here">
<div id="opponents_cards">
<div id="oppslot1"></div>
<div id="oppslot2"></div>
<div id="oppslot3"></div>
<div id="opponentcolonyfull">
<div id="oppcol"></div>
</div>
</div>
<div id="draw_and_discard">
<div id="draw" class="class_of_cards_at_colony_and_my"></div>
<div id="discard"  class="class_of_cards_at_colony_and_my"></div>
</div>
<div id="my_cards">
<div id="mycolonyfull">
<div id="mycol"  class="class_of_cards_at_colony_and_my"></div>
</div>
<div id="myslot1"  class="class_of_cards_at_colony_and_my"></div>
<div id="myslot2"  class="class_of_cards_at_colony_and_my"></div>
<div id="myslot3"  class="class_of_cards_at_colony_and_my"></div>
</div>
</div>
</div>
<script>
$(document).ready(function(){$("")})
</script>
</body>
</html>
