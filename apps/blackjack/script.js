$(document).ready(function() {

var sheet = document.createElement('style');
sheet.innerHTML = ".card {border: 1px solid black; background-color: blue;opacity:0.9} ";

document.body.appendChild(sheet);



 
$("body").effect("pulsate", { times:2 }, 300);

 
    $("body").fadeIn(100);
 

 
$("#glownow").illuminate({'blinkSpeed':'500'});
 $("#header").illuminate({

		'intensity': '10',
                  
		'color': '#6A287E',

		'blink': 'true',

		'blinkSpeed': '1000',

		'outerGlow': 'true',

		'outerGlowSize': '150px',

		'outerGlowColor': '#F9B7FF'

	});

 $("#header").hide("explode", 400);

$("#header").fadeIn(1600);




$("#ptable").illuminate();
$(".result").illuminate();
$(".result").effect("pulsate",{times:3},"fast");
$("#powered").illuminate();
 
$("#lk").illuminate();	
	
	$(".name").effect("pulsate",{times:3},"fast");
 $("#rules").mouseover(function () {
$(this).animate({width:"9em",opacity:0.4},"fast");
 

     


});

$("#deal").effect("pulsate",{times:3},"slow");
 $("#rules").mouseout(function () {
      $(this).animate({width:"8em",opacity:1},"fast");
});
 

 $("#deal").mouseover(function () {
      $(this).animate({width:"9em",opacity:0.5},"fast");

});
 $("#deal").mouseout(function () {
      $(this).animate({width:"8em",opacity:1},"fast");
});

 $("#increase").mouseover(function () {
       $(this).animate({width:"9em",opacity:0.5},"fast");
});
 $("#decrease").mouseover(function () {
      $(this).animate({width:"9em",opacity:0.5},"fast");
});
 $("#split").mouseover(function () {
       $(this).animate({width:"9em",opacity:0.5},"fast");
});
 $("#double").mouseover(function () {
      $(this).animate({width:"9em",opacity:0.5},"fast");
});
 $("#surrender").mouseover(function () {
       $(this).animate({width:"9em",opacity:0.5},"fast");;
});
 $("#hit").mouseover(function () {
      $(this).animate({width:"9em",opacity:0.5},"fast");
});
 $("#stand").mouseover(function () {
      $(this).animate({width:"9em",opacity:0.5},"fast");
});
 $("#stand").mouseout(function () {
      $(this).animate({width:"8em",opacity:1},"fast");

});
 $("#hit").mouseout(function () {
      $(this).animate({width:"8em",opacity:1},"fast");
});
 $("#surrender").mouseout(function () {
      $(this).animate({width:"8em",opacity:1},"fast");
});
 $("#increase").mouseout(function () {
      $(this).animate({width:"8em",opacity:1},"fast");
});
 $("#decrease").mouseout(function () {
      $(this).animate({width:"8em",opacity:1},"fast");
});
 $("#double").mouseout(function () {
      $(this).animate({width:"8em",opacity:1},"fast");
});
 $("#split").mouseout(function () {
      $(this).animate({width:"8em",opacity:1},"fast");
});


   $("#rules").illuminate();

	

$("#feedbj").click(function(){
$("#showfeed").show(1000);

});
	$("#closemee").click(function(){
$("#showfeed").hide(1000);

});
	$("#winclosenow").click(function(){
$("#happy").hide(1000);

});
	$("#loseclose").click(function(){
$("#sad").hide(1000);

});
//document.getElementById("deal").addEventListener("click",startRound,false);


	
});



