<!DOCTYPE html>
<html>
<head>
<script src="jquery-1.1.3.1.js"></script>
    <meta charset="utf-8">
<title>HTML5 Drag and Drop Demo</title>
<style type="text/css" media="screen">@import "screen.css";</style>
</head>
<body>
<img src="55.gif" id="const"></img>

<img src="54.gif" draggable="true" id="files" ondragstart="drag(this, event)" />

<div id="trash" ondrop="drop(this, event)" ondragenter="return false" ondragover="return false"></div>
<div id="trash2"></div>

<script type="text/javascript" charset="utf-8">
var dom1;
var i=0;
var classFull;
function drag(target, e) {

e.dataTransfer.setData('Text', target.id);
}
function drop(target, e) {
var id = e.dataTransfer.getData('Text');
target.appendChild(document.getElementById(id));
trashFull1();
e.preventDefault();

}
function trashFull1(){
 classFull = "trashfull1";
trashDiv = document.getElementById("trash");
if (!trashDiv) { return;}
if (trashDiv.className != classFull)
{
trashDiv.className = classFull;
}
$(".trashfull1").css("background-image","url(1.gif)");

setTimeout("trashFull2()","200");

	return false;

}
function trashFull2(){
 classFull = "trashfull2";
trashDiv = document.getElementById("trash2");
if (!trashDiv) { return;}
if (trashDiv.className != classFull)
{
trashDiv.className = classFull;
}
$(".trashfull2").css("background-image","url(2.gif)");


	return false;

}

</script>

</body>
</html>