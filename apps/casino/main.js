var status=0,curMoney=0,money,userid,card1,card2,card3,card4,card5,card6,card7,card8,card9,canvas;
		
		$(document).ready(function(){
					
					$.ajax({url: "putdata.php",success: function(html){money=html;}});
				
				canvas = oCanvas.create({
					canvas: "#gcanvas",
				});
				cardt = canvas.display.image({rotation:45,x: 650,y: 20,image: "images/back.png"}); 
				canvas.addChild(cardt);
				card1 = canvas.display.image({rotation:45,x: 650,y: 20,image: "images/back.png"});
				canvas.addChild(card1);
				card2 = canvas.display.image({rotation:45,x: 650,y: 20,image: "images/back.png"}); 
				canvas.addChild(card2);
				card3 = canvas.display.image({rotation:45,x: 650,y: 20,image: "images/back.png"}); 
				canvas.addChild(card3);
				card4 = canvas.display.image({rotation:45,x: 650,y: 20,image: "images/back.png"}); 
				canvas.addChild(card4);
				card5 = canvas.display.image({rotation:45,x: 650,y: 20,image: "images/back.png"}); 
				canvas.addChild(card5);
				card6 = canvas.display.image({rotation:45,x: 650,y: 20,image: "images/back.png"}); 
				canvas.addChild(card6);
				card7 = canvas.display.image({rotation:45,x: 650,y: 20,image: "images/back.png"}); 
				canvas.addChild(card7);
				card8 = canvas.display.image({rotation:45,x: 650,y: 20,image: "images/back.png"}); 
				canvas.addChild(card8);
				card9 = canvas.display.image({rotation:45,x: 650,y: 20,image: "images/back.png"}); 
				canvas.addChild(card9);
			
			
			status=1;
		});
		function add(i){
		if(status==1||status==2){
			i=parseInt(i);
			if(money>=parseInt(curMoney+i)){
				curMoney+=i;
				document.getElementById("money").value=curMoney;
			}	
			else{
				alert1("no balance left");
			}		
		}
		else{
			alert1("cant bet now");
		}
		}
		function sub(){
		if(status==1){
			if(curMoney>=5){
				curMoney+=-5;
				document.getElementById("money").value=curMoney;
			}	
			else{
				alert1("cant steal the casino");
			}		
		}
		else{
			alert1("cant bet now");
		}
		}
		function bet(){
			var u1,u2,d1,d2,c1,c2,c3,c4,c5,betMoney=0,temp,temp1,temp2,temp3,temp4;
			if(curMoney!=0||status==2){
				$("#bet").attr({disabled:'disabled'});
				status++;
			if(status==2){
			betMoney=curMoney;
			curMoney=0;
			document.getElementById("money").value=curMoney;
			document.getElementById("bmoney").value=betMoney;
			
			$.ajax({type: "POST",url: "getdata.php",success: function(html){
					var string=html.split('-');
					money=parseInt(string[0]);
					u1=parseInt(string[1]);
					u2=parseInt(string[2]);
					c1=parseInt(string[3]);
					c2=parseInt(string[4]);
					c3=parseInt(string[5]);
					var k=u1%13+1;	
					if(parseInt(u1/13)==0){temp="h"+k;}
					else if(parseInt(u1/13)==1){temp="s"+k;}
					else if(parseInt(u1/13)==2){temp="c"+k;}
					else if(parseInt(u1/13)==3){temp="d"+k;}
					k=u2%13+1;
					if(parseInt(u2/13)==0){temp1="h"+k;}
					else if(parseInt(u2/13)==1){temp1="s"+k;}
					else if(parseInt(u2/13)==2){temp1="c"+k;}
					else if(parseInt(u2/13)==3){temp1="d"+k;}
					k=c1%13+1;
					if(parseInt(c1/13)==0){temp3="h"+k;}
					else if(parseInt(c1/13)==1){temp3="s"+k;}
					else if(parseInt(c1/13)==2){temp3="c"+k;}
					else if(parseInt(c1/13)==3){temp3="d"+k;}
					k=c2%13+1;
					if(parseInt(c2/13)==0){temp4="h"+k;}
					else if(parseInt(c2/13)==1){temp4="s"+k;}
					else if(parseInt(c2/13)==2){temp4="c"+k;}
					else if(parseInt(c2/13)==3){temp4="d"+k;}
					k=c3%13+1;
					if(parseInt(c3/13)==0){temp2="h"+k;}
					else if(parseInt(c3/13)==1){temp2="s"+k;}
					else if(parseInt(c3/13)==2){temp2="c"+k;}
					else if(parseInt(c3/13)==3){temp2="d"+k;}
					animate1(temp);
					setTimeout(function(){animate2(temp1);},200);
					setTimeout(function(){animate3();},400);
					setTimeout(function(){animate4();},600);
					setTimeout(function(){animate5(temp3);},200);
					setTimeout(function(){animate6(temp4);},200);
					setTimeout(function(){animate7(temp2);},400);
					setTimeout(function(){$("#bet").removeAttr("disabled");},5000);
			}});
			setTimeout(function(){dat="money="+betMoney;
						$.ajax({type: "POST",data:dat,url: "putmoney.php"});},600);
			function animate1(url){
			
			card1.animate({
					x:395,
					y:350,
					rotation:90,
					
				}, "short", "ease-in-out", function () {
				this.fill = "#f00";
			canvas.redraw();
			
			});
			var hey=function(){
			canvas.removeChild(card1);	
			card1 = canvas.display.image({
				x: 320,
				y: 350,
				image: "images/"+url+".png"
				});
			canvas.addChild(card1);		
			canvas.redraw();
			}
			setTimeout(hey,700);	
		}
		function animate2(url){
			
			card2.animate({
					x:480,
					y:350,
					rotation:90,
					
				}, "short", "ease-in-out", function () {
				this.fill = "#f00";
			canvas.redraw();
			
			});
			var hey=function(){
			canvas.removeChild(card2);	
			card2 = canvas.display.image({
				x: 405,
				y: 350,
				image: "images/"+url+".png"
				});
			canvas.addChild(card2);		
			canvas.redraw();
			}
			setTimeout(hey,700);	
		}
		function animate3(){
			card3.animate({
					x:395,
					y:20,
					rotation:90,
					
				}, "short", "ease-in-out", function () {
				this.fill = "#f00";
			canvas.redraw();
			
			});
		}
		function animate4(){
			card4.animate({
					x:480,
					y:20,
					rotation:90,
					
				}, "short", "ease-in-out", function () {
				this.fill = "#f00";
			canvas.redraw();
			
			});
		}
			function animate5(url){
						
						card5.animate({
								x:250,
								y:175,
								rotation:90,
								
							}, "short", "ease-in-out", function () {
							this.fill = "#f00";
						canvas.redraw();
						
						});
						var hey=function(){
						canvas.removeChild(card5);	
						card5 = canvas.display.image({
							x: 180,
							y: 175,
							image: "images/"+url+".png"
							});
						canvas.addChild(card5);		
						canvas.redraw();
						}
						setTimeout(hey,700);	
					}
						function animate6(url){
						
						card6.animate({
								x:350,
								y:175,
								rotation:90,
								
							}, "short", "ease-in-out", function () {
							this.fill = "#f00";
						canvas.redraw();
						
						});
						var hey=function(){
						canvas.removeChild(card6);	
						card6 = canvas.display.image({
							x: 280,
							y: 175,
							image: "images/"+url+".png"
							});
						canvas.addChild(card6);		
						canvas.redraw();
						}
						setTimeout(hey,700);	
					}
						function animate7(url){
						
						card7.animate({
								x:450,
								y:175,
								rotation:90,
								
							}, "short", "ease-in-out", function () {
							this.fill = "#f00";
						canvas.redraw();
						
						});
						var hey=function(){
						canvas.removeChild(card7);	
						card7 = canvas.display.image({
							x: 380,
							y: 175,
							image: "images/"+url+".png"
							});
						canvas.addChild(card7);		
						canvas.redraw();
						}
						setTimeout(hey,700);	
					}
			$("#bet").attr({
					value:'call'
			});
			$("#sub").hide();
			$("#money").hide();
			$("#five").click(function(){});
			$("#ten").click(function(){});
			$("#twenty").click(function(){});
			$("#fifty").click(function(){});
			
			
		}
		else if(status==3){
						$("#fold").attr({
							disabled:'disabled'
						});
						betMoney=document.getElementById("bmoney").value;
						betMoney*=3;
						document.getElementById("bmoney").value=betMoney;
						$.ajax({url: "getdata1.php",success: function(html){
								var string=html.split('-');
								money=parseInt(string[0]);
								c4=parseInt(string[1]);
								c5=parseInt(string[2]);
								d1=parseInt(string[3]);	
								d2=parseInt(string[4]);	
								k=c4%13+1;
								if(parseInt(c4/13)==0){temp="h"+k;}
								else if(parseInt(c4/13)==1){temp="s"+k;}
								else if(parseInt(c4/13)==2){temp="c"+k;}
								else if(parseInt(c4/13)==3){temp="d"+k;}
								k=c5%13+1;
								if(parseInt(c5/13)==0){temp1="h"+k;}
								else if(parseInt(c5/13)==1){temp1="s"+k;}
								else if(parseInt(c5/13)==2){temp1="c"+k;}
								else if(parseInt(c5/13)==3){temp1="d"+k;}
								k=d1%13+1;
								if(parseInt(d1/13)==0){temp2="h"+k;}
								else if(parseInt(d1/13)==1){temp2="s"+k;}
								else if(parseInt(d1/13)==2){temp2="c"+k;}
								else if(parseInt(d1/13)==3){temp2="d"+k;}
								k=d2%13+1;
								if(parseInt(d2/13)==0){temp3="h"+k;}
								else if(parseInt(d2/13)==1){temp3="s"+k;}
								else if(parseInt(d2/13)==2){temp3="c"+k;}
								else if(parseInt(d2/13)==3){temp3="d"+k;}
								animate8(temp);
								setTimeout(function(){animate9(temp1);},200);
								setTimeout(function(){animate10(temp2);},400);
								setTimeout(function(){animate11(temp3);},600);
						}});
						setTimeout(function(){
							dat="money="+betMoney
						$.ajax({type: "POST",data:dat,url: "putmoney.php"});},200);
			function animate8(url){
						
						card8.animate({
								x:550,
								y:175,
								rotation:90,
								
							}, "short", "ease-in-out", function () {
							this.fill = "#f00";
						canvas.redraw();
						
						});
						var hey=function(){
						canvas.removeChild(card8);	
						card8 = canvas.display.image({
							x: 480,
							y: 175,
							image: "images/"+url+".png"
							});
						canvas.addChild(card8);		
						canvas.redraw();
						}
						setTimeout(hey,700);	
					}
					function animate9(url){
						
						card9.animate({
								x:650,
								y:175,
								rotation:90,
								
							}, "short", "ease-in-out", function () {
							this.fill = "#f00";
						canvas.redraw();
						
						});
						var hey=function(){
						canvas.removeChild(card9);	
						card9 = canvas.display.image({
							x: 580,
							y: 175,
							image: "images/"+url+".png"
							});
						canvas.addChild(card9);		
						canvas.redraw();
						}
						setTimeout(hey,700);	
					}
					function animate10(url){
						canvas.removeChild(card3);	
						card3 = canvas.display.image({
							x: 325,
							y: 20,
							image: "images/"+url+".png"
							});
						canvas.addChild(card3);		
						canvas.redraw();
						
					}
					function animate11(url){
						canvas.removeChild(card4);	
						card4 = canvas.display.image({
							x: 425,
							y: 20,
							image: "images/"+url+".png"
							});
						canvas.addChild(card4);		
						canvas.redraw();
						
					}	
								
				var value;		
			setTimeout(function(){
			$.ajax({type: "GET",data:dat,url: "result.php",success: function(html){
				value=html;
							
								setTimeout(function(){
									$("#inputs").hide();
					$("#coins").hide();
					$("#binfo").hide();
									canvas.clear();
									var text = canvas.display.text({
					x: -177,
					y: 270,
					align: "center",
					font: "bold 30px sans-serif",
	
					fill: "#0aa"
				});
				text.text="you have won "+value;
				canvas.addChild(text);
				text.animate({
						x:400,
					}, "long", "ease-in-out", function () {
		
						canvas.redraw();
					});
				setTimeout(function(){	
				text.animate({
						x:1000,
					}, "long", "ease-in-out", function () {
		
						canvas.redraw();
					});},3000);
					setTimeout(function(){window.location.reload();},5000);
								},8000);
			}});},200);

			}
		}
		else{
			alert1("bet amount");
		}
		}
	function alert1(string){
		$("#alert").slideDown(300);
		setTimeout(function(){
			$("#alertp").html(string);
		},300);
		setTimeout(function(){
			$("#alertp").html("");
			$("#alert").slideUp(300);
		},3000);
	}	
function info(){
	$("#binfo").hide();	
	  $("#info").show(); 
}
function binfo(){
	$("#info").hide();	
	  $("#binfo").show(); 
}
function fold(){
	var value=document.getElementById('bmoney').value;
	$("#inputs").hide();
	$("#coins").hide();
	$("#binfo").hide();
	canvas.clear(false);
	canvas.clear(false);
	canvas.clear(false);
	var text = canvas.display.text({
	x: -177,
	y: 270,
	align: "center",
	font: "bold 30px sans-serif",
	
	fill: "#0aa"
});
text.text="you have lost "+value;
canvas.addChild(text);
text.animate({
		x:400,
	}, "long", "ease-in-out", function () {
		
		canvas.redraw();
	});
setTimeout(function(){	
text.animate({
		x:1000,
	}, "long", "ease-in-out", function () {
		
		canvas.redraw();
	});},3000);
	setTimeout(function(){window.location.reload();},5000);
}	

function next()
{
if(document.getElementById("next").value=="NEXT"){
$("#rules_div").animate({height:0},"slow",function(){
document.getElementById("rule_p").style.display="none";
document.getElementById("rule_p1").style.display="block";

$(this).animate({height:300},"slow");
document.getElementById("next").value="PREV";
});}
else
{
$("#rules_div").animate({height:0},"slow",function(){
document.getElementById("rule_p1").style.display="none";
document.getElementById("rule_p").style.display="block";

$(this).animate({height:300},"slow");
document.getElementById("next").value="NEXT";
});}


}

function home()
{
document.getElementById("next").style.display="none";
document.getElementById("start").style.display="block";
document.getElementById("back").style.display="none";
document.getElementById("rules").style.display="block";
document.getElementById("coins").style.display="none";
document.getElementById("inputs").style.display="none";
document.getElementById("gcanvas").style.display="none";
document.getElementById("rule_p").style.display="block";
document.getElementById("rule_p1").style.display="none";

document.getElementById("rules_div").style.display="none";


}




function start()
{
document.getElementById("start").style.display="none";
document.getElementById("back").style.display="none";
document.getElementById("rules").style.display="none";
document.getElementById("inputs").style.display="block";
document.getElementById("tut_button").style.display="block";
document.getElementById("gcanvas").style.display="block"
document.getElementById("binfo").style.display="block";
document.getElementById("coins").style.display="block";
}

function rules()
{
document.getElementById("back").style.display="block";
document.getElementById("start").style.display="none";
document.getElementById("rules").style.display="none"; 
 			var scanvas = oCanvas.create({
					canvas: "#scanvas",
				});
	
if(!document.getElementById("rules_div"))
{
 

rdiv=document.createElement("div");
rule_p=document.createElement("p");
rule_p.setAttribute("id","rule_p");
rule_p.innerHTML="RULES:<br/><br/>1.The player is initially asked to bid some amount, following which, five cards are dealt. <br/>  <br/>2. Each player must decide to either fold or call. If the player folds he gives up his cards and his ante bet. If the player calls, the call must be equal to two times the ante bet.<br/><br/>  3.  The dealer will then deal two more community cards, for a total of five. The dealer will also turn over his own two cards.<br/><br/>4.The player hand shall be scored according the highest poker value of the player's two cards and the five community cards. Likewise, the dealer shall use his own two cards and the five community cards.<br/>";

rdiv.appendChild(rule_p);
rdiv.setAttribute("id","rules_div");
document.getElementById("startpage").appendChild(rdiv);
document.getElementById("rule_p").style.fontWeight="bold"; 	
document.getElementById("rule_p").style.color="#fff";
document.getElementById("rule_p").style.fontSize=18+"px";

rule_p=document.createElement("p");
rule_p.setAttribute("id","rule_p1");
rule_p.innerHTML="RULES:<br/><br/><div id=\"divtable_rules\"><table id=\"table_rules\" border=\"1\" width=\"500px\"><tr><th>HAND</th><th>MULTIPLIER</th></tr><tr><td>ROYAL FLUSH</td><td>15</td></tr><tr><td>STRAIGHT FLUSH</td><td>7</td></tr><tr><td>4 OF A KIND</td><td>5</td></tr><tr><td>FULL HOUSE</td><td>3</td></tr><tr><td>FLUSH</td><td>2</td></tr>         <tr><td>ALL OTHER</td><td>1</td></tr> </table></div>";

rdiv.appendChild(rule_p);
rdiv.setAttribute("id","rules_div");
document.getElementById("startpage").appendChild(rdiv);
document.getElementById("rule_p1").style.fontWeight="bold"; 	
document.getElementById("rule_p1").style.color="#fff";
document.getElementById("rule_p1").style.fontSize=18+"px";
document.getElementById("rule_p1").style.display="none";







document.getElementById("rules_div").style.display="block";
document.getElementById("rules_div").style.position="absolute";
document.getElementById("rules_div").style.top=0+"px";
document.getElementById("rules_div").style.height=0+"px";
document.getElementById("rules_div").style.width=0+"px";
document.getElementById("rules_div").style.top=0+"px";
document.getElementById("rules_div").style.zindex=2;

}

document.getElementById("next").style.display="block";
document.getElementById("rules_div").style.display="block";
document.getElementById("rules_div").style.top=0+"px";
document.getElementById("rules_div").style.height=0+"px";
document.getElementById("rules_div").style.width=0+"px";
document.getElementById("rules_div").style.padding=8+"px";
document.getElementById("rules_div").style.top=0+"px";

    $("#rules_div").animate({width:750},"slow");
    $("#rules_div").animate({height:300},"slow");
 

}























function tutorials()
{

var val1="<br><br>1.The player is initially asked to bid some amount, following which, five cards are dealt. <br>  <br>";
var val2="NO idea";
$("#tutorials").css({
"display":"block"
});


document.getElementById("tut_button").value="close";
document.getElementById("tut_button").onclick=function(){$("#tutorials").css({
"display":"none"
});
$("#tut_div").css({"display":"none"});
};

rdiv=document.createElement("div");
subdiv=document.createElement("div");
subdiv.setAttribute("id","tut_div1");
button1=document.createElement("input");
button1.setAttribute("type","button");
button1.setAttribute("value","next");
button1.setAttribute("id","tut_button1");
subdiv.appendChild(button1);
rule_p=document.createElement("p");
rule_p.setAttribute("id","tut_p");
rule_p.innerHTML=val1;

rdiv.appendChild(rule_p);
rdiv.appendChild(subdiv);
rdiv.setAttribute("id","tut_div");


document.getElementById("wrapper").appendChild(rdiv);
$("#tut_div").css({
"display":"block",
"position":"absolute",
"top":"0px",
"z-index":"20"
});
$("#tut_p").css({
"position":"absolute",
"top":"250px",
"left":"400px",
"width":"200px"
});
$("#tut_div1").css({
"font-weight":"bold",
"color":"#ff",
"font-size":"16px",
"display":"block",
"position":"absolute",
"left":"300px",
"top":"10px"
});
document.getElementById("five").style.zIndex = 20;
document.getElementById("ten").style.zIndex = 20;
document.getElementById("twenty").style.zIndex = 20;
document.getElementById("fifty").style.zIndex = 20;
document.getElementById("bet").style.zIndex = 20;	
document.getElementById("tut_button").style.zIndex=30;
document.getElementById("tut_button1").onclick=function()
{
if(document.getElementById("tut_p").innerHTML==val1){

document.getElementById("tut_p").innerHTML=val2;
$("#tut_p").css({
"position":"absolute",
"top":"470px",
"left":"22px",
});
document.getElementById("five").style.zIndex = 0;
document.getElementById("ten").style.zIndex = 0;
document.getElementById("twenty").style.zIndex = 0;
document.getElementById("fifty").style.zIndex = 0;
document.getElementById("inputs").style.zIndex=30;
document.getElementById("bet").style.zIndex=30;
}
else{
document.getElementById("tut_p").innerHTML=val1;
$("#tut_p").css({
"position":"absolute",
"top":"250px",
"left":"400px",

});
document.getElementById("five").style.zIndex = 20;
document.getElementById("ten").style.zIndex = 20;
document.getElementById("twenty").style.zIndex = 20;
document.getElementById("fifty").style.zIndex = 20;
document.getElementById("bet").style.zIndex = 0;	

}

};
}
