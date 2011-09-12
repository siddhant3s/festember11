<?php
session_start();
$rpath = "../";
include("../game.php");

if(!isset($_POST['txtchar']))
{
    	header('Location:index.php');
	
}
else
{
       
	$money=getCash();
	if($_POST['txtchar']>$money)
	{ 
	    header('Location:start.php?alertnobalance=1&m1=' . $money . "&m2=" . $_POST['txtchar']);
	    
	}
	else
	{
	    $_SESSION['cht']=$_POST['txtchar'];
	    $q="INSERT INTO game_info( `starttime` , `bidamount` , `gameid` , `playerid`)  VALUES (now(), ".$_POST['txtchar'].", '4', '" . $user["id"] ."' )";
	    mysql_query($q);
	   
	}
}
?>
<?php

if(!isset($_SESSION['cht'])){
	header('Location:index.php');
}
else{
function P2J($Phpbet,$JA)
{
echo "<script>var ".$JA.";</script>";
echo "<script>".$JA."='".$Phpbet."'</script>";
}
$bet=$_SESSION['cht'];
if($bet>=100)
{
P2J($bet, 'point');
}
else
{
		header('Location:start.php');
	
	}
}
?>
<html>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.3/jquery.min.js"></script>

<meta charset="utf-8">
<title>Mankatha</title>
<style type="text/css" media="screen">@import "screen.css";</style>
<style type="text/css">
#hint3{
	position:absolute;
	top: 300px;
	left: 400px;
     width: 71px;
     height: 90px;
    }
</style>
<script type="text/javascript" charset="utf-8">

var k=1;
document.onkeyup = KeyCheck;       
function KeyCheck(e)
{	document.getElementById("hint").style.visibility='hidden'; 
   var KeyID = (window.event) ? event.keyCode : e.keyCode;
    switch(KeyID)
   {
     case 13: if(k)
	 {selectedfull();
	            trashFull1();
				k=0;;
					 }
	 else
	 {
		 trashFull1();
	 }
	 break;
   }
	}
var numbers;
function background()
{
$("#trash").css("border","10px solid black");
return false;
}
function background2()
{
$("#trash").css("border","0px solid black");
return false;
}
window.onload=function(){
document.getElementById("hint2").style.visibility='hidden';
document.getElementById("hint1").style.visibility='hidden';
document.getElementById("trash").style.visibility='hidden';
document.getElementById("trash2").style.visibility='hidden';
document.getElementById("hint3").style.visibility="hidden";
var jsonurl="getarray.php";
$(document).ready(function(){
	$.getJSON("getarray.php",function (json){
		numbers=json;
		len=numbers.length;
	});
});
};
var len;
var drag1=0;
var flag=0;
var num=0;
var nump=0;
var numc=0;
var dom1;
var i=-1;
var classFull;
var t=1;
var ch=0;
function drag(target, e) {
	drag1=1;
document.getElementById("hint3").style.visibility="hidden";
e.target.setAttribute("style","cursor: pointer;");
document.getElementById("hint").style.visibility='hidden';
if(flag==0){
 	$("#hint1").css("visibility","visible");
	}

else if(flag==1){
	document.getElementById("hint2").style.visibility='visible';
	}

e.dataTransfer.setData('Text', target.id);

}

function drop(target, e) {
var id = e.dataTransfer.getData('Text');
target.appendChild(document.getElementById(id));
trashFull1();
e.preventDefault();

}
function drop1(target, e) {
var id = e.dataTransfer.getData('Text');
target.appendChild(document.getElementById(id));
selectedfull();
e.preventDefault();
}

function selectedfull(){
 classFull = "selected1";
trashDiv = document.getElementById("selected");
if (!trashDiv) { return;}
if (trashDiv.className != classFull)
{
trashDiv.className = classFull;
}

 i=0;
 num=numbers[0];
 
 var url="url(" + numbers[0] + ".gif)";
 
$(".selected1").css("background-image",url);

document.getElementById("hint1").style.visibility='hidden';

flag=1;
document.getElementById("hint2").style.visibility='hidden';
document.getElementById("trash").style.visibility='visible';
document.getElementById("trash2").style.visibility='visible';

}
function trashFull1(){
	document.getElementById("hint3").style.left=leftpos+'px';
document.getElementById("hint3").style.top=toppos+'px';
   classFull = "trashfull1";
document.getElementById("hint2").style.visibility='hidden';
trashDiv = document.getElementById("trash");
if (!trashDiv) { return;}
if (trashDiv.className != classFull)
{
trashDiv.className = classFull;
}
 
 i++;
 nump=numbers[i];
  var url="url(" + numbers[i] + ".gif)";
 
$(".trashfull1").css("background-image",url);
if(ch!=len)
{   ch++;
	if(nump%13==num%13)
{ 
     
	 setTimeout("win()","1000");
	 }
else if(drag1==1)
{	drag1=0; 
	setTimeout("animation()","300");
	return false;
}
else
{
	setTimeout("trashFull2()","300");
	return false;
}
}
else
{
	$.getJSON("last.php",function (json){
		number=json;
	});	
	var url="url(" + number + ".gif)";
 	$(".trashfull1").css("background-image",url);
	setTimeout("win()","1000");
}
}
function win(){
    if(t){document.location='delw.php';
		
	/*document.write("<img src=\"ropa.png\" alt=\"\" style=\"position:absolute;left:250px;height:655px;\" />");
	document.write("<div style=\"position:absolute; top:50%; left:45%; color:white;\">");
	document.write("You won this round. Your win "+point);
	document.write("<a href=\"start.php\" style=\"position:absolute;left:5%;top:70%;\"><img src=\"bpa.png\" border=\"0\" alt=\"\"/></a>");
	document.write("<a href=\"index2.php\" style=\"position:absolute;left:5%;top:650%;\"><img src=\"bq.png\" border=\"0\" alt=\"\"/></a>");
    document.write("</div>");
	*/} t=0;
}function trashFull2(){
  classFull = "trashfull2";
trashDiv = document.getElementById("trash2");
if (!trashDiv) { return;}
if (trashDiv.className != classFull)
{
trashDiv.className = classFull;
}
	
   i++;
 numc=numbers[i];
 var url="url(" + numbers[i] + ".gif)";
 $(".trashfull2").css("background-image",url);
 if(numc%13==num%13)
 {
	 	setTimeout("lose()","1000");
		return false;
 }
}
function animation(){
	document.getElementById("hint3").style.visibility="visible";
	$( "#hint3" ).animate({
    top: "-=60",
    left: "+=335"
  }, {
    duration: 1000,
  });
  setTimeout("animation1()",1000);
  return false;	
}
var leftpos=350;
var toppos=300;
function animation1(){
	document.getElementById("hint3").style.visibility="hidden";
	trashFull2();
	return false;	
}
function lose(){
    if(t){document.location='dell.php';
		
	/*document.write("<img src=\"ropa.png\" alt=\"\" style=\"position:absolute;left:250px;height:655px;\" />");
	document.write("<div style=\"position:absolute; top:50%; left:45%; color:white;\">");
	document.write("You lost this round. Your lose "+point);
	document.write("<a href=\"start.php\" style=\"position:absolute;left:5%;top:70%;\"><img src=\"bpa.png\" border=\"0\" alt=\"\"/></a>");
	document.write("<a href=\"index.php\" style=\"position:absolute;left:5%;top:650%;\"><img src=\"bq.png\" border=\"0\" alt=\"\"/></a>");
    document.write("</div>");
	*/} t=0;
}
</script>
<style type="text/css">
	#frame iframe{
	margin:0px;
	padding:0px;
}
#frame{
	margin:0px;
	padding:0px;
	height:100px;
}
#wrapper{
	height:600px;
	width:800px;
	background-image:url('mangatgha.jpg');
	position:absolute;
	-webkit-user-select: none;
-khtml-user-select: none;
-moz-user-select: none;
-o-user-select: none;
user-select: none;

}
</style>
</head>
<body style="margin:0px;">

<div id="wrapper">


<div class="one">
<div id="block1"><div id="block"><img src="deck1.png" draggable="true" id="files" ondragstart="drag(this, event) " /></div></div>
<div id="selected" ondrop="drop1(this, event)" ondragenter="return false" ondragover="return false"></div>
<div id="trash" ondrop="drop(this, event)" ondragenter="return background()" ondragover="return background2()"></div>
<div id="trash2"></div>
<div id="hint"><img src="one.png" draggable="false"/></div>
<div id="hint1"><img src="drophere1.png" draggable="false"/></div>
<div id="hint2"><img src="dropherec.png" draggable="false"/></div>
<div id="hint3"><img src="55.gif" draggable="false"/></div>
</div>
</div>
</div>

</body>
</html>
