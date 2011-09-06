
<html>

<?php


function P2JArray($PhpArray,$JA)
{
echo "<script>var ".$JA." = Array();</script>";
for($i=0;$i<count($PhpArray);$i++){
echo "<script>".$JA."[".$i."]='".$PhpArray[$i]."'</script>";
}
}

$numbers =range(1,52);
shuffle($numbers);

P2JArray($numbers, 'numbers');

?>

<head>
<style>
span{
	position:relative;}
	</style>
<script src="jquery.js"></script>

    <meta charset="utf-8">
<title>Mankatha</title>
<style type="text/css" media="screen">@import "screen.css";</style>
</head>
<body>
<span class="block"><img src="54.gif" draggable="true" id="files" ondragstart="drag(this, event)" /></span>
<div id="selected" ondrop="drop1(this, event)" ondragenter="return false" ondragover="return false"></div>
<div id="trash" ondrop="drop(this, event)" ondragenter="return background()" ondragover="return background2()"></div>
<div id="trash2"></div>
<div id="hint1"></div>
<div id="hint2"></div>
<script type="text/javascript" charset="utf-8">
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

};
var flag=0;
var point=0;
var num=0;
var nump=0;
var numc=0;
var dom1;
var i=-1;
var classFull;
function drag(target, e) {
if(flag==0){
	document.getElementById("hint1").style.visibility='visible';
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
function win() {
	point+=10;
	document.write("You won this round. Your score is "+point);
	document.write("<br /><form action=\"test1.php\"><input type=\"submit\" value=\"Play Again\" /></form>");
	document.write("<form action=\"sample1.php\"> <input type=\"submit\" value=\"Quit\" /></form>");
}
function trashFull2(){
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
 $( ".block" ).animate({
    left: 100
  }, {
    duration: 1000,
  });
 $(".trashfull2").css("background-image",url);
 if(numc%13==num%13)
 {
	 	setTimeout("lose()","1000");
		return false;
 }
}
function lose(){
    document.write("You lost this round. Your score is "+point);
	document.write("<br /><form action=\"test1.php\"> <input type=\"submit\" value=\"Play Again\" /></form>"); 
	document.write("<form action=\"sample1.php\"> <input type=\"submit\" value=\"Quit\" /></form>");
	}
</script>

</body>
</html>