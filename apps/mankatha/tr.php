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
<script src="jquery1.js"></script>
<meta charset="utf-8">
<title>Mankatha</title>
<style type="text/css" media="screen">@import "screen.css";</style>
<style type="text/css">
#hint3{
	position:absolute;
	top: 300px;
	left: 650px;
     width: 71px;
     height: 90px;
    }
</style>
<script type="text/javascript" charset="utf-8">
var k=1;
document.onkeyup = KeyCheck;       
function KeyCheck(e)
{	
document.getElementById("hint").style.visibility='hidden'; 
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
	$.getJSON("getarray.php?c=1",function (json){
		numbers=json;
		len=numbers.length;
	});
});
};
var a=0;
var ch=0;
var len=0;
var drag1=0;
var flag=0;
var num=0;
var nump=0;
var numc=0;
var dom1;
var i=-1;
var classFull;
var t=1;
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
setTimeout("trashFull1()",0);

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
$(".trashfull1").css("background-image",url);
if(ch==len/2)
{    var a = jquerycall();
     var url="url(" + a + ".gif)";
	 $(".trashfull1").css("background-image",url);
	 setTimeout("win()","1000");
	 }
else if((drag1==1)&&(ch!=(len/2)))
{	ch++;
	drag1=0; 
	setTimeout("animation()","300");
	return false;
}
else if(k==0)
{
	setTimeout("trashFull2()","300");
	return false;
}
}
	function jquerycall(){
		var a;
		console.log("making ajax call...");
		$.get("getarray.php?c=0",function (data){
			console.log("data recieved... " + data);
		  a=data;
		});
		console.log("data returned... a = " + a);
		return a;
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
	
 
      var url="url(" + a + ".gif)";
	 $(".trashfull1").css("background-image",url);
	 setTimeout("lose()","1000");
	     
 numc=numbers[i];
 var url="url(" + numbers[i] + ".gif)";
 $(".trashfull2").css("background-image",url);
  

}
function animation(){
	document.getElementById("hint3").style.visibility="visible";
	$( "#hint3" ).animate({
    top: "-=60",
    left: "+=335"
  }, {
    duration: 1000,
  });
  setTimeout("animation1()","1000");
  return false;	
}
var leftpos=650;
var toppos=300;
function animation1(){
	document.getElementById("hint3").style.visibility="hidden";
	setTimeout("trashFull2()","0");
	return false;	
}
function lose(){
    if(t){
	/*document.write("<img src=\"ropa.png\" alt=\"\" style=\"position:absolute;left:250px;height:655px;\" />");
	document.write("<div style=\"position:absolute; top:50%; left:45%; color:white;\">");
	document.write("You lost this round. Your lose "+point);
	document.write("<a href=\"start.php\" style=\"position:absolute;left:5%;top:70%;\"><img src=\"bpa.png\" border=\"0\" alt=\"\"/></a>");
	document.write("<a href=\"index.php\" style=\"position:absolute;left:5%;top:650%;\"><img src=\"bq.png\" border=\"0\" alt=\"\"/></a>");
    document.write("</div>");*/
	console.log("sorry... you lost the game... :(");
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
<div id="hint3"><img src="55.gif"/></div>
</div>
</div>
</div>

</body>
</html>