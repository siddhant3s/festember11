<?php
if(!isset($_POST['txtchar'])){
	header('Location:start.php');
	exit;}
else{
function P2J($Phpbet,$JA)
{
echo "<script>var ".$JA.";</script>";
echo "<script>".$JA."='".$Phpbet."'</script>";
}
$bet=$_POST["txtchar"];
if($bet>=100)
{
P2J($bet, 'point');
}
else
{
		header('Location:start.php');
	exit;
	}
}
?>
<html>
<head>
<script src="jquery.js"></script>
<meta charset="utf-8">
<title>Mankatha</title>
<style type="text/css" media="screen">@import "screen.css";</style>
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
var jsonurl="getarray.php";
$(document).ready(function(){
	$.getJSON("getarray.php",function (json){
		numbers=json;
	});
});
};
var flag=0;
var num=0;
var nump=0;
var numc=0;
var dom1;
var i=-1;
var classFull;
var t=1;
function drag(target, e) {
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
if(nump%13==num%13)
{ 
     
	 setTimeout("win()","1000");
	
}
else
{	
 setTimeout("trashFull2()","300");
	return false;
}
}
function win(){
    if(t){
	document.write("<img src=\"ropa.png\" alt=\"\" style=\"position:absolute;left:250px;height:655px;\" />");
	document.write("<div style=\"position:absolute; top:50%; left:45%; color:white;\">");
	document.write("You won this round. Your win "+point);
	document.write("<a href=\"start.php\" style=\"position:absolute;left:5%;top:70%;\"><img src=\"bpa.png\" border=\"0\" alt=\"\"/></a>");
	document.write("<a href=\"index.php\" style=\"position:absolute;left:5%;top:650%;\"><img src=\"bq.png\" border=\"0\" alt=\"\"/></a>");
    document.write("</div>");
	} t=0;
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
function lose(){
    if(t){
	document.write("<img src=\"ropa.png\" alt=\"\" style=\"position:absolute;left:250px;height:655px;\" />");
	document.write("<div style=\"position:absolute; top:50%; left:45%; color:white;\">");
	document.write("You lost this round. Your lose "+point);
	document.write("<a href=\"start.php\" style=\"position:absolute;left:5%;top:70%;\"><img src=\"bpa.png\" border=\"0\" alt=\"\"/></a>");
	document.write("<a href=\"index.php\" style=\"position:absolute;left:5%;top:650%;\"><img src=\"bq.png\" border=\"0\" alt=\"\"/></a>");
    document.write("</div>");
	} t=0;
}
</script>
</head>
<body>
<div>

<img src="mangatgha.png" alt="" id="bimage"/>
<div class="one">
<div id="block"><img src="deck1.png" draggable="true" id="files" ondragstart="drag(this, event) " /></div>
<div id="selected" ondrop="drop1(this, event)" ondragenter="return false" ondragover="return false"></div>
<div id="trash" ondrop="drop(this, event)" ondragenter="return background()" ondragover="return background2()"></div>
<div id="trash2"></div>
<div id="hint"><img src="one.png"/></div>
<div id="hint1"><img src="drophere1.png"/></div>
<div id="hint2"><img src="dropherec.png"/></div>
</div>
</div>
</div>

</body>
</html>