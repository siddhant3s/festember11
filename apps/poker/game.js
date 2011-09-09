<?php Header ("Content-type: text/javascript");?> 
window.onload=function(){
	var canvas = oCanvas.create({
		canvas: "#gcanvas"
	});
	var h=(1,2,3,4,5,6,7,8,9,10,"j","q","k");
	var s=(1,2,3,4,5,6,7,8,9,10,"j","q","k");
	var c=(1,2,3,4,5,6,7,8,9,10,"j","q","k");
	var d=(1,2,3,4,5,6,7,8,9,10,"j","q","k");
	var cards=new Array();
	for(i=0;i<52;i++){
		if(i/13==0){
			cards[i]=canvas.display.image({
				x: 0,
				y: 0,
				image: "images/h"+h[i%13]+".png"
			});	
							
		} 
		if(i/13==1){
		               cards[i]=canvas.display.image({
				x: 0,
				y: 0,
				image: "images/s"+s[i%13]+".png"
			
			});
					
			}
		if(i/13==2){
		               cards[i]=canvas.display.image({
				x: 0,
				y: 0,
				image: "images/c"+c[i%13]+".png"
			});	
			
			}
		if(i/13==3){
		                    
		                cards[i]=canvas.display.image({
				x: 0,
				y: 0,
				image: "images/d"+d[i%13]+".png"
			});
			}		
			
	}
	var deck=new Array();
	function createdeck(){
		var data="table="+table;
		$.getJSON("deck.php",data,"get",
		 function(html){}
				
	         );
	}
	setTimeout(createdeck,100);	
}	
	



