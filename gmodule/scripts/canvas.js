var s1,s2,s3,s4,s5,rc;
function glowstar(s,star){
s1=document.getElementById('s1');
s2=document.getElementById('s2');
s3=document.getElementById('s3');
s4=document.getElementById('s4');
s5=document.getElementById('s5');
var rating=document.getElementById('ratingtext');
if(s){
	rc=0;
	switch(star){
		case 5:s5.src="images/s1.png";rating.innerHTML=" < "+(++rc)+".0 > ";
		case 4:s4.src="images/s1.png";rating.innerHTML=" < "+(++rc)+".0 > ";
		case 3:s3.src="images/s1.png";rating.innerHTML=" < "+(++rc)+".0 > ";
		case 2:s2.src="images/s1.png";rating.innerHTML=" < "+(++rc)+".0 > ";
		case 1:s1.src="images/s1.png";rating.innerHTML=" < "+(++rc)+".0 > ";break;
		default:alert("unexpected error");
	}
}
else{
	switch(star){
		case 5:s5.src="images/s0.png";
		case 4:s4.src="images/s0.png";
		case 3:s3.src="images/s0.png";
		case 2:s2.src="images/s0.png";
		case 1:s1.src="images/s0.png";rating.innerHTML="";break;
		default:alert("unexpected error");
	}
}
}
function hideiframe(){
parent.document.getElementById('iframe').style.display = "none";
//picture.src = "images/loader.gif";
}


function rateit(star){
picHref = document.getElementById('canvasimage');
picHref = picHref.value.split(".");
picHref = picHref[0];
	if(window.ActiveXObject){
		var request3 = new ActiveXObject("Microsoft.XMLHTTP");
	}
	else if(XMLHttpRequest){
		var request3 = new XMLHttpRequest();
	}
	the_url='rateimg.php?rateRef='+picHref+'&rateIt='+star;
	request3.open("GET",the_url);
	request3.onreadystatechange = function(){
	if(request3.readyState==4){
			if(request3.responseText=="c"){
				alert('Warning! You have already voted!');
				document.getElementById('stars').style.display = 'none';
			}
			else if((request3.responseText!="a")&&(request3.responseText!="b")){
				document.getElementById('stars').style.display =  'none';
				document.getElementById('ratingsuccess').style.display =  'inline';
			}
			else
				alert("Please Login to rate the pictures");
			}}
request3.send(null);
//document.getElementById('ableRating').style.display = 'none';
//document.getElementById('disableRating').style.display = 'inline';
//rateOnce.value = 1;
}
function viewrating(){
picHref = document.getElementById('canvasimage');
picHref = picHref.value.split(".");
picHref = picHref[0];
	if(window.ActiveXObject){
		var request3 = new ActiveXObject("Microsoft.XMLHTTP");
	}
	else if(XMLHttpRequest){
		var request3 = new XMLHttpRequest();
	}
	the_url='rateimg.php?viewRef='+picHref;
	request3.open("GET",the_url);
	request3.onreadystatechange = function(){
	if(request3.readyState==4){
			if((request3.responseText!="a")&&(request3.responseText!="b")){
				var response = request3.responseText;
				document.getElementById('currentrating').innerHTML =  'Current Rating : ( '+response+' / 5.0 ) ';
			}
			else
				alert("Ajax Response Text Error");
			}}
request3.send(null);
//document.getElementById('ableRating').style.display = 'none';
//document.getElementById('disableRating').style.display = 'inline';
//rateOnce.value = 1;
}

function gotooriginal(){
picHref = document.getElementById('canvasimage').value;
window.open("imgoriginal.php?img="+picHref);
}
