var canvas,picture,stage,bitmap,canvasimage;
function imageshow(iframe){
canvas = iframe.getElementById("galleryimage");
if(canvas.getContext){
var ctx = canvas.getContext('2d');	//to access the rendered context
}
else{
alert("error");	//canvas not supported by browser
}

picture = new Image();
picture.onload=function(){
ctx.drawImage(picture,50,10,700,700);
};
canvasimage = iframe.getElementById('canvasimage').value;
//alert(canvasimage);
picture.src = "gmodule/fitsize/new_"+canvasimage;

//canvas.addChild(picture);
}


function showcanvas(imgdiv){
var img = imgdiv.getElementsByTagName('img');
img = img[0].src.split('/new_');
img = img[1];
var iframe = document.getElementById('iframe');
//alert(imgdiv.style.top);
var inneriframe = iframe.contentDocument || iframe.contentWindow.document;
inneriframe.getElementById('canvasimage').value=img;
inneriframe.getElementById('currentrating').innerHTML="View current rating";
inneriframe.getElementById('stars').style.display =  'inline';
inneriframe.getElementById('ratingsuccess').style.display =  'none';
document.getElementById('iframe').style.display="block";
imageshow(inneriframe);
}
