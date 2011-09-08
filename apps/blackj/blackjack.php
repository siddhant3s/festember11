

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 

 
<link href="d.css" rel="stylesheet" type="text/css"> 
<head>
<link href="jquery1.css" rel="stylesheet" type="text/css"> 
<style type="text/css"> 

#blackj{
opacity:0.6;
float:center;
background-color:black;

}
#blackj:hover{
opacity:1;
}
body {
  background-color: black;
  font-family: Arial, Helvetica, sans-serif;
  font-size: 10pt;
  margin-top: 1em;
  text-align: center;
}
 
#header
{
  background-color: grey;
  border-color: lavender;
  border-style: solid;
  border-width: 1px;
  color: #ffffc0;
  margin-bottom: 1ex;
  padding: 4px 1em;
margin:0 auto;
width:280px;
opacity:0.4;
}
#header:hover{
opacity:0.6;
-webkit-box-shadow:5px 5px 5px #ffffff;
-moz-box-shadow:5px 5px 5px #ffffff;
box-shadow:5px 5px 5pc #ffffff;
}
 
#header h2
{
	margin: 0px;
	padding: 0px;
}

#Ptable
{
width: 950px;
margin: 0 auto;
border:none;
z-index:-1;

}

 
.playingField {
 border:none;
  color: #000000;
width:850px;

margin:0 auto;

 
  padding: 4px;
  text-align: left;
}
 
.activeField {
 

}
#glownow{
border:none;
 --webkit-border-radius: 50px; 
-moz-border-radius: 50px; 
border-radius: 50px;
background-color:violet;
opacity:0.2;
size:50px;


}
 
.cardArea {
  font-size: 20pt;
  height: 6em;
  position: relative;
 --webkit-border-radius: 20px; 
-moz-border-radius: 20px; 
border-radius: 20px; 
width:850px;
margin:0 auto;
opacity:0.9;




}
 
.textBox {
  background-color: lavender;
  border-color:  #006000 #90f090 #90f090 #006000;
  border-style: solid;
  border-width: 0px;
  clear: right;
  color: #000000;
  float: right;
  font-family: "Times New Roman", serif;
  font-size: 11pt;
  font-weight: bold;
  margin-bottom: .5em;
  padding: .1em;
  text-align: center;
  width: 12em;
 --webkit-border-radius: 20px; 
-moz-border-radius: 20px; 
border-radius: 20px; 
}
 
.name {
  background-color: black;
  border-color: #60c060 #006000 #006000 #60c060;
  color: #ffffc0;
-webkit-box-shadow:5px 5px 5pc #7D0552;
-moz-box-shadow:5px 5px 5pc #7D0552';
box-shadow:5px px 5pc #7D0552;
opacity:0.6;
}
.name:hover {
opacity:1.0;
}
 
.result { color: #c00000; 
 --webkit-border-radius: 20px; 
-moz-border-radius: 20px; 
border-radius: 20px;
margin-left:5px; 
opacity:0.8;
-webkit-box-shadow:10px 5px 5px #ffffff;
-moz-box-shadow:10px 5px 5px #ffffff;
box-shadow:10px 5px 5pc #ffffff;
-webkit-box-shadow:5px 5px 5pc #7D0552;
-moz-box-shadow:5px 5px 5pc #7D0552';
box-shadow:5px 5px 5pc #7D0552;}

 
.dollars { color: #006000; 

 --webkit-border-radius: 20px; 
-moz-border-radius: 20px; 
border-radius: 20px;
opacity:0.8;
-webkit-box-shadow:5px 5px 5pc #7D0552;
-moz-box-shadow:5px 5px 5pc #7D0552';
box-shadow:5px 5px 5pc #7D0552; }
 
.lost { color: #80b060;
 --webkit-border-radius: 20px; 
-moz-border-radius: 20px; 
border-radius: 20px;  }
 
#controlsArea {
  margin-top: 0.5em;
  text-align: left;
  border:none;
  float:center;
align:center;
width:850px;
margin:0 auto;
}
 

 
input.button {
  margin-top: .25em;
  width: 8em;
margin:5px;
padding:5px;

 cursor:pointer;
 background:thistle;

 

 --webkit-border-radius: 20px; 
-moz-border-radius: 20px; 
border-radius: 20px; 

}
 
 input.button:hover{
 background:brown;
color:white;
border-color:#7F5217;
-webkit-box-shadow:5px 5px 5pc #7D0552;
-moz-box-shadow:5px 5px 5pc #7D0552';
box-shadow:5px 5px 5pc #7D0552;

 }

 
.card {
  background-image: url("graphics/cardback.gif");
  border-color: #808080 #000000 #000000 #808080;
  border-width: 1px;
  border-style: solid;
  font-size: 20pt;
  position: absolute;
  width:  3.75em;
  height: 5.00em;
opacity:1;
-webkit-box-shadow:5px 5px 5pc #ffffff;
-moz-box-shadow:5px 5px 5pc #ffffff;
box-shadow:5px 5px 5pc #ffffff;
}
.card:hover{
opacity:1;
}
 
.front {
  background-color: #ffffff;
  color: #000000;
  position: absolute;
  width: 100%;
  height: 100%;
}
 
.red { color: #ff0000; }
 
.index {
  font-size: 50%;
  font-weight: bold;
  text-align: center;
  position: absolute;
  left: 0.25em;
  top:  0.25em;
}
 
.ace {
  font-size: 300%;
  position: absolute;
  left: 0.325em;
  top:  0.250em;
}
 
.face {
  border: 1px solid #000000;
  position: absolute;
  left: 0.50em;
  top:  0.45em;
  width:  2.6em;
  height: 4.0em;
}
 
.spotA1 { position: absolute; left: 0.60em; top: 0.5em; }
.spotA2 { position: absolute; left: 0.60em; top: 1.5em; }
.spotA3 { position: absolute; left: 0.60em; top: 2.0em; }
.spotA4 { position: absolute; left: 0.60em; top: 2.5em; }
.spotA5 { position: absolute; left: 0.60em; top: 3.5em; }
 
.spotB1 { position: absolute; left: 1.55em; top: 0.5em; }
.spotB2 { position: absolute; left: 1.55em; top: 1.0em; }
.spotB3 { position: absolute; left: 1.55em; top: 2.0em; }
.spotB4 { position: absolute; left: 1.55em; top: 3.0em; }
.spotB5 { position: absolute; left: 1.55em; top: 3.5em; }
 
.spotC1 { position: absolute; left: 2.50em; top: 0.5em; }
.spotC2 { position: absolute; left: 2.50em; top: 1.5em; }
.spotC3 { position: absolute; left: 2.50em; top: 2.0em; }
.spotC4 { position: absolute; left: 2.50em; top: 2.5em; }
.spotC5 { position: absolute; left: 2.50em; top: 3.5em; }
 
</style> 

<script src="jquery.js" type="text/javascript"></script>
<script src="jquery-1.6.2.js" type="text/javascript"></script>
<script src="jquery2.js" type="text/javascript"></script>

<script type="text/javascript" src="illuminate.js"></script>
<script src="script.js" type="text/javascript"></script>
<script src="game.js" type="text/javascript"></script>





</head>
<body background="fff.jpg" >

<!-- Header. -->
<div id="header">
 <img float="center" width="250px" id="blackj" src="fes.jpeg"></img>

</div>

<!-- Dealer's area. -->
<div id = "Ptable">

<div id="dealer" class="playingField" align="center">
  <div class="textBox name">Dealer</div>
  <div id="dealerScore" class="textBox">&nbsp;</div>

  <div id="dealerCards" class="cardArea"></div>
    <div id="credits" class="textBox dollars" align="center">&nbsp;</div>
  
    <div id="default" class="textBox dollars" align="center">&nbsp;</div>

</div>

<!-- Main player's area. -->

<div id="player0" class="playingField" align="center">
  <div class="textBox name">Player</div>
  <div id="player0Score"  class="textBox">&nbsp;</div>
  <div id="player0Bet"    class="textBox dollars">&nbsp;</div>
  <div id="player0Result" class="textBox result">&nbsp;</div>
<div id="player0Cards"  class="cardArea"  ></div>
</div>



<!-- Areas for the player's split hands.-->

<div id="player1" class="playingField" style="display:none;" align="center">
  <div class="textBox name">Player</div>
  <div id="player1Score"  class="textBox">&nbsp;</div>
  <div id="player1Bet"    class="textBox dollars">&nbsp;</div>
  <div id="player1Result" class="textBox result">&nbsp;</div>
  <div id="player1Cards"  class="cardArea"></div>
</div>

<div id="player2" class="playingField" style="display:none;">
  <div class="textBox name">Player</div>
  <div id="player2Score"  class="textBox">&nbsp;</div>
  <div id="player2Bet"    class="textBox dollars">&nbsp;</div>
  <div id="player2Result" class="textBox result">&nbsp;</div>
  <center><div id="player2Cards"  class="cardArea" align="center"></div></center>
</div>

<div id="player3" class="playingField" style="display:none;">
  <div class="textBox name">Player</div>

  <div id="player3Score"  class="textBox">&nbsp;</div>
  <div id="player3Bet"    class="textBox dollars">&nbsp;</div>
  <div id="player3Result" class="textBox result">&nbsp;</div>
  <div id="player3Cards"  class="cardArea"></div>

</div>

</div>

<!-- Game buttons. -->

<form id="controls" action="">
  <div id="controlsArea" align="center">

    
    <input id="deal"      class="button" type="reset" value="Deal"   />
    <input id="decrease"  class="button" type="reset" value="Decrease Bet"/>
    <input id="increase"  class="button" type="reset" value="Increase Bet" />
    <br />
    <input id="split"     class="button" type="reset" value="Split"      disabled="disabled" />
    <input id="double"    class="button" type="reset" value="Double"   "    disabled="disabled" />
    <input id="surrender" class="button" type="reset" value="Surrender"  disabled="disabled" />
    <br />

    <input id="hit"       class="button" type="reset" value="Hit"        disabled="disabled" />
    <input id="stand"     class="button" type="reset" value="Stand"    disabled="disabled" />
<div align="center">
    <input id="rules"     class="button" type="reset" value="Show Rules">

</div>
  </div>

</form>

<!-- Rules text. -->


</body>
</html>
