var canvas,picture,stage,bitmap,canvasimage;
function imageshow(iframe){
canvas = iframe.getElementById("galleryimage");
if(canvas.getContext){
var ctx = canvas.getContext('2d');	//to access the rendered context
}
else{
alert("error");	//canvas not supported by browser
}

picturedummy = new Image();
picturedummy.src = "gmodule/images/blank.jpg";
picturedummy.onload=function(){
ctx.drawImage(picturedummy,50,10,700,700);
};


picture = new Image();
canvasimage = iframe.getElementById('canvasimage').value;
//alert(canvasimage);
picture.src = "gmodule/fitsize/new_"+canvasimage;
picture.onload=function(){
ctx.drawImage(picture,50,10,700,700);
};

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
