<html>
	<head>
	<style type="text/css">
		
	</style>
	</head>
	<body>
		<div id="wholegame">
		<div id="gamescreen">
			<div id="bottle_1"></div>
			<div id="bottle_2"></div>
			<div id="bottle_3"></div>
			<div id="grabber"></div>
			<div id="claw"></div>
			<div id="obs"></div>
			<div id="basket"></div>
			<div id="score"></div>
			<div id="time"></div>
			<div id="pause"></div>
			<div id="pickinst"></div>
		</div>
		<div id="startmenu">
			<div id="startbutton"></div>
			<div id="htpbutton"></div>
			<div id="instructions">
				<div id="back"></div>
			</div>
		</div>
		<div id="pausemenu">
			<div id="mainmenubutton"></div>
			<div id="exitbutton"></div>
			<div id="contbutton"></div>
		</div>	
		<div id="gameover">
			<div id="startnewgame"></div>
		</div>
		</div>
	</body>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.3/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
var event;
var score = 0, time = 10;
var tu2=0;var tu3=0;var tu4=1;var tu5=0;
var penable = 0 , ienable = 0 , startscreen = 1 , genable = 0 , penable = 0;
        function pausetoggle(){
        	if(penable == 0){
        		$("#pausemenu").toggle();
        		$("#pausemenu").animate({left:138},600);
        		penable=1;
        	}else
        	{
        		$("#pausemenu").animate({left:640},600,function(){$("#pausemenu").toggle();});
        		penable=0;
        	}
        }
        function insttoggle(){
        	if(ienable == 0){
        		$("#instructions").toggle();
        		$("#instructions").animate({top:30},600);
        		ienable=1;
        	}else
        	{
        		$("#instructions").animate({top:480},600,function(){$("#instructions").toggle();});
        		ienable=0;
        	}
        }
        function gameovertoggle(){
        	if(genable == 0){
        		$("#pausemenu").css({"background-image":"url('images/pause.png')"});
        		$("#gameover").toggle();
        		$("#pause").trigger("click");
        		$("#gameover").animate({left:140},600,function(){genable=1;});
        	}else
        	{
        		$("#pausemenu").css({"background-image":"url('images/pause.png')"});
        		genable=0;
        		$("#pause").trigger("click");
        		$("#gameover").animate({left:640},600,function(){$("#gameover").toggle();$("#pausemenu").css({"background-image":"url('images/pausescreen.png')"});});
        	}
        	
        }
        function pickinsttoggle(){
        	if(penable == 0){
        		$("#pickinst").toggle();
        		$("#pickinst").animate({left:182},600);
        		penable=1;
        	}else
        	{
        		$("#pickinst").animate({left:-275},600,function(){$("#pickinst").toggle();});
        		penable=0;
        	}
        }

//startmenu n its children
$("#startmenu").css({"position":"absolute","left":"0","top":"0","height":"480","width":"640","background-image":"url('images/backdrop.png')"});
		$("#startbutton").css({"position":"absolute","top":"194","left":"245","height":"60","width":"144","background-image":"url('images/pause.png')"});
		$("#startbutton").bind("mouseleave",function(){$(this).css({"background-image":"url('images/pause.png')"});});		
		$("#startbutton").bind("mouseover",function(){$(this).css({"background-image":"url('images/startbackdrop.png')"});});
		$("#startbutton").bind("click",function(){reset();s5();startscreen=0; $("#startmenu").toggle(); $("#gamescreen").toggle(); if(ienable){$("#instructions").toggle(); ienable=0;}});
		$("#htpbutton").css({"position":"absolute","top":"240","left":"192","height":"60","width":"253","background-image":"url('images/pause.png')"});
		$("#htpbutton").bind("mouseleave",function(){$(this).css({"background-image":"url('images/pause.png')"});});		
		$("#htpbutton").bind("mouseover",function(){$(this).css({"background-image":"url('images/instructionsbackdrop.png')"});});
		$("#instructions").css({"position":"absolute","left":"143","top":"480","height":"357","width":"353","background-image":"url('images/instructions.png')"});
		$("#instructions").hide();
		$("#htpbutton").bind("click",function(){insttoggle();});
		$("#back").css({"position":"absolute","left":"298","top":"17","width":"21","height":"32","background-image":"url('images/pause.png')"});
		$("#back").bind("click",function(){insttoggle();});
		$("#back").bind("mouseover",function(){$(this).css({"background-image":"url('images/xglow.png')"});});
		$("#back").bind("mouseleave",function(){$(this).css({"background-image":"url('images/pause.png')"});});
//gamescreen n its children				
		$("#gamescreen").css({"position":"absolute","left":"0","top":"0","height":"480","width":"640","background-image":"url('images/background.png')"});
		$("#gamescreen").hide();
		$("#pause").css({"position":"absolute","left":"594","top":"438","height":"40","width":"38","background-image":"url('images/pause.png')"});
		$("#pause").bind("mouseover",function(){$(this).css({"background-image":"url('images/pauseglow.png')"});});
		$("#pause").bind("mouseleave",function(){$(this).css({"background-image":"url('images/pause.png')"});});
		$("#pickinst").css({"position":"absolute","left":"-275","top":"144","height":"172","width":"275","background-image":"url('images/spacedrop.png')"});
		$("#pickinst").hide();
		$("#time").css({"position":"absolute","left":"350","top":"450","height":"40","width":"40","color":"white"});		
		$("#score").css({"position":"absolute","left":"90","top":"450","height":"40","width":"40","color":"white"});        
        $("#grabber").css({"position":"absolute","left":"20","top":"-252","height":"100%","width":"73","background":"url('images/untitled-1.png') no-repeat"});
		$("#bottle_1").css({"position":"absolute","top":"300","left":"600","width":"25","height":"149","background":"url('images/12.png') no-repeat"});
		$("#bottle_2").css({"position":"absolute","top":"300","left":"600","width":"25","height":"149","background":"url('images/13.png') no-repeat"});
		$("#bottle_3").css({"position":"absolute","top":"300","left":"600","width":"25","height":"149","background":"url('images/14.png') no-repeat"});
		$("#basket").css({"position":"absolute","top":"365","left":"600","width":"150","height":"100","background":"url('images/tub.png') no-repeat"});
		$("#pausemenu").css({"position":"absolute","left":"640","top":"90","height":"288","width":"364","background-image":"url('images/pausescreen.png')"});
        $("#pausemenu").hide();
        $("#mainmenubutton").css({"position":"absolute","left":"99","top":"75","height":"55","width":"175","background-image":"url('images/pause.png')"});
        $("#mainmenubutton").bind("mouseover",function(){$(this).css({"background-image":"url('images/mainmenuhover.png')"});});
        $("#mainmenubutton").bind("mouseleave",function(){$(this).css({"background-image":"url('images/pause.png')"});});
        $("#mainmenubutton").bind("click",function(){penable=0; tu=0; startscreen=1; $("#pausemenu").toggle(); $("#pausemenu").css({"left":"640"});$("#gamescreen").toggle(); $("#startmenu").toggle();});
        $("#exitbutton").css({"position":"absolute","left":"148","top":"173","height":"46","width":"76","background-image":"url('images/pause.png')"}); 
        $("#exitbutton").bind("mouseover",function(){$(this).css({"background-image":"url('images/exithover.png')"});});
        $("#exitbutton").bind("mouseleave",function(){$(this).css({"background-image":"url('images/pause.png')"});});
        $("#contbutton").css({"position":"absolute","left":"110","top":"124","height":"46","width":"146","background-image":"url('images/pause.png')"});
        $("#contbutton").bind("mouseover",function(){$(this).css({"background-image":"url('images/continuehover.png')"});});
        $("#contbutton").bind("mouseleave",function(){$(this).css({"background-image":"url('images/pause.png')"});});
        $("#contbutton").bind("click",function(){$("#pause").trigger("click");});
        function reset()
        {
        	score = 0;	time = 10;
        	$("#grabber").css({"position":"absolute","left":"20","top":"-252","height":"100%","width":"73","background":"url('images/untitled-1.png') no-repeat"});
        	$("#bottle_1").css({"position":"absolute","top":"300","left":"600","width":"25","height":"149","background":"url('images/12.png') no-repeat"});
        	$("#bottle_2").css({"position":"absolute","top":"300","left":"600","width":"25","height":"149","background":"url('images/13.png') no-repeat"});
        	$("#bottle_3").css({"position":"absolute","top":"300","left":"600","width":"25","height":"149","background":"url('images/14.png') no-repeat"});
        	$("#basket").css({"position":"absolute","top":"365","left":"600","width":"150","height":"100","background":"url('images/tub.png') no-repeat"});
        	$("#basket").hide();
        	document.getElementById("score").innerHTML=score;
        	document.getElementById("time").innerHTML=time;
        }
        
        setInterval("timer()",1000);
        function timer()
        {
        	time--;
        	if(time>=0)
        	document.getElementById("time").innerHTML=time;
        	if(time==0)
        	{
        		gameovertoggle();
        		time=0;
        		document.getElementById("time").innerHTML=0;
        	}
        }
        
        $(document).bind("keydown",function (event)
        {
			var key=event.keyCode;
			if(key==66)pickinsttoggle();
		});

//gameover
        $("#gameover").css({"position":"absolute","left":"640","top":"90","height":"271","width":"359","background-image":"url('images/gameover.png')"});
        $("#gameover").hide();
        //$("#gameover").bind("click",function(){$("#gameover").toggle();});
        $("#startnewgame").css({"position":"absolute","left":"88","top":"169","height":"55","width":"175","background-image":"url('images/pause.png')"});
        $("#startnewgame").bind("mouseover",function(){$(this).css({"background-image":"url('images/mainmenuhover.png')"});});
        $("#startnewgame").bind("mouseleave",function(){$(this).css({"background-image":"url('images/pause.png')"});});
        $("#startnewgame").bind("click",function(){reset();startscreen=1;$("#startmenu").toggle(); $("#gamescreen").toggle(); if(genable)gameovertoggle();});
		var dir=0;
		var flag=1,lift=0;
		var f,f1,f2;
		var completed=1;
		var tu=0;
		var drop=0;
	
	    $("#pause").bind("click",function(){
	    	if(genable==0)
	    	{
	    		pausetoggle();
	    	if(tu==0)
	    	{tu=1;   
	    		$("#bottle_1").stop("true");
	    		$("#bottle_2").stop("true");
                $("#bottle_3").stop("true");
				$("#basket").stop("true");         
			}
			else if(tu==1 )
			{tu=0;
				if(lift==0)
				{
					if(sel==0)
					{
						if(!side1)
						{
							if(left($("#bottle_1"))>300)$("#bottle_1").animate({left:-50},4000,"linear",function(){s5();});
							else  $("#bottle_1").animate({left:-50},2000,"linear",function(){s5();});}
							else 
							{
								if(left($("#bottle_1"))<300)$("#bottle_1").animate({left:600},4000,"linear",function(){s5();});
								else  $("#bottle_1").animate({left:600},2000,"linear",function(){s5();});
							}
						}
						 if(sel==1)
						 {
						 	if(!side2)
						 	{
						 		if(left($("#bottle_2"))>300)$("#bottle_2").animate({left:-50},4000,"linear",function(){s5();});
						 		else $("#bottle_2").animate({left:-50},2000,"linear",function(){s5();})
						 	}
						 	else
						 	{
						 		if(left($("#bottle_2"))<300)$("#bottle_2").animate({left:600},4000,"linear",function(){s5();});
						 		else $("#bottle_2").animate({left:600},2000,"linear",function(){s5();});
						 	}
						 }
						 if(sel==2)
						 {
						 	if(!side3)
						 	{
						 		if(left($("#bottle_3"))>300)$("#bottle_3").animate({left:-50},4000,"linear",function(){s5();});
						 		else $("#bottle_3").animate({left:-50},2000,"linear",function(){s5();});
						 	}
						 	else
						 	{  
						 		if(left($("#bottle_3"))<300)$("#bottle_3").animate({left:600},4000,"linear",function(){s5();});
						 		else $("#bottle_3").animate({left:600},2000,"linear",function(){s5();});
						 	}
						 }
					}
					if(top($("#bottle_3"))>100&&top($("#bottle_3"))<300)s12();
					if(top($("#bottle_2"))>100&&top($("#bottle_2"))<300)s12();
					if(top($("#bottle_1"))>100&&top($("#bottle_1"))<300)s12();
					if((tu4==0||completed==0)&&((left($("#basket"))>-150)&&(left($("#basket"))<550)))
					{
						if(!side8)
						{
							if(left($("#basket"))>300)$("#basket").animate({left:-150},5000,"linear",function(){$("#basket").hide();s9();});
							else $("#basket").animate({left:-150},2500,"linear",function(){$("#basket").hide();s9();});
						}
						else
						{
							if(left($("#basket"))<300)$("#basket").animate({left:550},5000,"linear",function(){$("#basket").hide();s9();});
							else $("#basket").animate({left:550},2500,"linear",function(){$("#basket").hide();s9();});
						}
					}
				}
			}
		});
	
	
		$(document).bind("keydown",function(event){
			var key=event.keyCode;
			var pos=$("#grabber").position();
			
			 if(key==27&&(tu==0))
			 {
			 	$("#grabber").stop(true);
			 	$("#pause").trigger("click");
			 }
			 else if(key==27&&(tu!=0))
			 {
			 	$("#pause").trigger("click");
			 }
			
			if(key==39&&tu==0&&tu3==0)
			{
				if(pos.left<500)
				{
					if(dir==1)
					{
						$("#grabber").stop(true);
						if(!lift==0)
						{
							$("#bottle_1").stop(true);
							$("#bottle_2").stop(true);
							$("#bottle_3").stop(true);
						}
		//$("#grabberend").stop(true);
			//$("#grabber").animate({left:pos.left-80},400,"linear",function(){dir=0;});
			        }
			         dir=0;
			         $("#grabber").animate({left:pos.left+80},500,"linear",function(){$("#grabber").clearQueue();});
			         if(lift==1) $("#bottle_1").animate({left:pos.left+100},500,"linear",function(){$("#bottle_1").clearQueue();});
			         if(lift==2) $("#bottle_2").animate({left:pos.left+100},500,"linear",function(){$("#bottle_2").clearQueue();});
			         if(lift==3) $("#bottle_3").animate({left:pos.left+100},500,"linear",function(){$("#bottle_3").clearQueue();});
		  //$("#grabberend").animate({left:pos.left+60},500,"linear",function(){$("#grabberend").clearQueue();
		   //});
		        }
			}
			else if(key==37&&tu==0&&tu3==0)
			{
				if(pos.left>73)
				{
					if(dir==0)
					{
						$("#grabber").stop(true);
						if(!lift==0)
						{
							$("#bottle_1").stop(true);
							$("#bottle_2").stop(true);
							$("#bottle_3").stop(true);
						}
			//$("#grabberend").stop(true);
			//$("#grabber").animate({left:pos.left+80},400,"linear",function(){dir=1;});
	                }
			        dir=1;
			        $("#grabber").animate({left:pos.left-80},500,"linear",function(){$("#grabber").clearQueue();});
			//$("#grabberend").animate({left:pos.left-100},500,"linear",function(){$("#grabberend").clearQueue();});
			        if(lift==1) $("#bottle_1").animate({left:pos.left-60},500,"linear",function(){$("#bottle_1").clearQueue();});
			        if(lift==2) $("#bottle_2").animate({left:pos.left-60},500,"linear",function(){$("#bottle_2").clearQueue();});
			        if(lift==3) $("#bottle_3").animate({left:pos.left-60},500,"linear",function(){$("#bottle_3").clearQueue();});
			     }
			}
			
		
			/*
		if(key==37)
			{   
			  
			$("#grabber").css({ "left" : "-=5"});
			
			}
	    if(key==39)
		   {
		   	$("#grabber").css({ "left" : "+=5"});
		   
		   }
			
			*/
			

			else if(key==32 &&tu==0 && lift==0&&tu3==0)
			{tu3=1;
				if(flag==1)
				{
            //$("#grabber").css({"top":"-177"});
			//var pos1=document.getElementById('grabber').style;
			 
			//$("#grabber").animate({height:pos1+340},500,"linear",function(){$("#grabber").clearQueue();});
			var temp=1;
			var init=setInterval(function(){
			   flag=0;
			   if(tu==0){
				if(top($("#grabber"))<0&&temp==1&&top($("#grabber"))>=-252)
				{
				$("#grabber").css({"top":top($("#grabber"))+3}); 
				//document.getElementById('grabber').style.top+=3;
				temp=1;}
				if(top($("#grabber"))==0)
				{temp=0;
					//document.getElementById('grabber').style.top-=3;
					$("#grabber").css({"background":"url('images/untitled-2.png') no-repeat"});
					$("#grabber").css({"top":top($("#grabber"))-3});
					
									if(sel==0)
				{
				if(left($("#bottle_1"))>left($("#grabber"))  && left($("#bottle_1"))<(left($("#grabber"))+60))
				{$("#bottle_1").stop(true); lift=1; $("#bottle_1").css({"left":left($("#grabber"))+27}); drop=1;}
				}
				if(sel==1)
				{
			   if(left($("#bottle_2"))>left($("#grabber"))  && left($("#bottle_2"))<(left($("#grabber"))+60))
				{$("#bottle_2").stop(true); lift=2;$("#bottle_2").css({"left":left($("#grabber"))+27}); drop=2;}
				}
				if(sel==2)
				{
				if(left($("#bottle_3"))>left($("#grabber"))  && left($("#bottle_3"))<(left($("#grabber"))+60))
				{$("#bottle_3").stop(true); lift=3;$("#bottle_3").css({"left":left($("#grabber"))+27}); drop=3;}
				}
				}
				if(temp==0&&top($("#grabber"))>=-252)
				{
				$("#grabber").css({"top":top($("#grabber"))-3});
				
				if(lift==1)
				$("#bottle_1").css({"top":top($("#bottle_1"))-3});
				if(lift==2)
				$("#bottle_2").css({"top":top($("#bottle_2"))-3});
				if(lift==3)
				$("#bottle_3").css({"top":top($("#bottle_3"))-3});
				//document.getElementById('grabber').style.top-=3;
				}
				if(top($("#grabber"))==-252)
				{
				if(lift==0)
				{$("#grabber").css({"background":"url('images/untitled-1.png') no-repeat"});}
				if(lift==1)
				{
				f=0;tu2=0;
				completed=0;
				s9();
				}
				if(lift==2)
				{
				f1=0;tu2=0;
				completed=0;
				s9();
				}
				if(lift==3)
				{
				f2=0;tu2=0;
				completed=0;
				s9();
				}
				temp=1;
				flag=1;
				clearInterval(init);
                                tu3=0;
				}
				
				    }
			},10);
			
			}
			}
			else
			if(drop!=0)
			{
			
                          if(tu3==0){$("#grabber").css({"background":"url('images/untitled-1.png') no-repeat"});
			switch(drop)
			{
			case 1:tu3=1;$("#bottle_1").stop("true");$("#bottle_1").animate({top:350},500,"linear",function(){s10();
				$("#bottle_1").clearQueue();completed=1;$("#bottle_1").hide();lift=0;tu3=0;});break;
			case 2:tu3=1;$("#bottle_2").stop("true");$("#bottle_2").animate({top:350},500,"linear",function(){s10();
				$("#bottle_2").clearQueue();completed=1;$("#bottle_2").hide();lift=0;tu3=0;});break;
		    case 3:tu3=1;$("#bottle_3").stop("true");$("#bottle_3").animate({top:350},500,"linear",function(){s10();
				$("#bottle_3").clearQueue();completed=1;$("#bottle_3").hide();lift=0;tu3=0;});break;
			}}
			}
		});
function top(obj){
	var position=obj.position();
	return parseInt(position.top);
}		

function left(obj){
    var position=obj.position();
    return parseInt(position.left);
}

var sel=0;

var side1,side2,side3;

window.onload=function(){
$("#basket").hide();
//document.getElementById('grab').focus();
//s5();
//s7();
}
function s4(){   $("#bottle_1").css({"top":"310"}); $("#bottle_2").css({"top":"310"}); $("#bottle_3").css({"top":"310"});
if(completed==1)
{
if(sel==0)
{
$("#bottle_1").show();
//alert("w");
var temp1=Math.random();
		  if(temp1>=0.5)
		  {
		  	side1=0;
		  $("#bottle_1").css({"left":"600"});
		  }
		  else
		  {
		    side1=1;
		     $("#bottle_1").css({"left":"0"});
		  }	

if(!side1)
$("#bottle_1").animate({left:left($("#bottle_1"))-600},3000,"linear",function(){s5();});
else
$("#bottle_1").animate({left:left($("#bottle_1"))+600},3000,"linear",function(){s5();});
}

 if(sel==1)
{
//alert("w1");
$("#bottle_2").show();
var temp1=Math.random();
		  if(temp1>=0.5)
		  {
		  	side2=0;
		  $("#bottle_2").css({"left":"600"});
		  }
		  else
		  {
		    side2=1;
		$("#bottle_2").css({"left":"0"});
		  }	
if((!side2))
$("#bottle_2").animate({left:left($("#bottle_2"))-600},3000,"linear",function(){s5();});
else
$("#bottle_2").animate({left:left($("#bottle_2"))+600},3000,"linear",function(){s5();});
}

 if(sel==2)
{
//alert("w2");
$("#bottle_3").show();
var temp1=Math.random();
		  if(temp1>=0.5)
		  {
		  	side3=0;
		 $("#bottle_3").css({"left":"600"});
		  }
		  else
		  {
		    side3=1;
		  $("#bottle_3").css({"left":"0"});
		  }	
if(!side3)
$("#bottle_3").animate({left:left($("#bottle_3"))-600},3000,"linear",function(){s5();});
else
$("#bottle_3").animate({left:left($("#bottle_3"))+600},3000,"linear",function(){s5();});
}
}
	}  

function s5()
{
$("#bottle_1").hide();
$("#bottle_2").hide();
$("#bottle_3").hide();
var r=Math.random();

if(r<=0.3)
{sel=0;s4();}
else if(r<=0.6)
{sel=1;s4();}
else
{sel=2;s4();}

}


var t=0;
 function s9(){
               if(tu5==1)
                   { tu5=0;
                      s5();

                   }
 //alert("workin");
      
  var temp9=Math.random();
  if((tu==0&&completed==0))
  { 
$("#basket").css({"background":"url('images/tub.png') no-repeat"});
$("#basket").show();
  
if(temp9>0.5)
{ $("#basket").css({left:490});
t=490;
side8=0;

$("#basket").animate({left:left($("#basket"))-490},5000,"linear",function(){$("#basket").hide();if((f==0 || f1==0 || f2==0) && completed==0){s9();}else {completed=1;s5();}});
}
 else
{
 $("#basket").css({left:-150});
 t=-150;
 side8=1;
 
$("#basket").animate({left:left($("#basket"))+640},5000,"linear",function(){$("#basket").hide();if((f==0 || f1==0 || f2==0) && completed==0){s9();}else {completed=1;s5();}});
}
}
}

function s10()
{
	if((left($("#bottle_1"))+10)>left($("#basket")) && (left($("#bottle_1")))<(left($("#basket"))+120)&&left($("#basket"))>0 )
	{$("#basket").css({"background":"url('images/tub1.png') no-repeat"});score++;}
	if(   (left($("#bottle_2"))+10)>left($("#basket")) && (left($("#bottle_2")))<(left($("#basket"))+120)&&left($("#basket"))>0)
	{$("#basket").css({"background":"url('images/tub1.png') no-repeat"});score++;}
	if(   (left($("#bottle_3"))+10)>left($("#basket")) && (left($("#bottle_3")))<(left($("#basket"))+120)&&left($("#basket"))>0 )
	{$("#basket").css({"background":"url('images/tub1.png') no-repeat"});score++;}
	document.getElementById("score").innerHTML=score;
}

function s12()
{ if(drop!=0)
	{                     
			switch(drop)
			{
			case 1:tu3=1;$("#bottle_1").stop("true");$("#bottle_1").animate({top:350},500,"linear",function(){s10();tu5=1;completed=1;
				$("#bottle_1").clearQueue();$("#bottle_1").hide();lift=0;tu3=0;tu5=1;});break;
			case 2:tu3=1;$("#bottle_2").stop("true");$("#bottle_2").animate({top:350},500,"linear",function(){s10();tu5=1;completed=1;
				$("#bottle_2").clearQueue();$("#bottle_2").hide();lift=0;tu3=0;tu5=1;});break;
		    case 3:tu3=1;$("#bottle_3").stop("true");$("#bottle_3").animate({top:350},500,"linear",function(){s10();tu5=1;completed=1;
				$("#bottle_3").clearQueue();$("#bottle_3").hide();lift=0;tu3=0;tu5=1;});break;
			}
	}
}


</script>
</html>
