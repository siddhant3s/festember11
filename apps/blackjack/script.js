$(document).ready(function() {

var sheet = document.createElement('style');
sheet.innerHTML = ".card {border: 1px solid black; background-color: blue;opacity:0.9} ";

document.body.appendChild(sheet);



 $("body").css("display", "none");
 
    $("body").fadeIn(1600);
$(".cardArea").css("display", "none")
$(".cardArea").slideDown("slow");

 
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

$("#ptable").illuminate();
$(".result").illuminate();
$("#powered").illuminate();
 
$("#lk").illuminate();	
	
	
 $("#rules").mouseover(function () {
$(this).animate({width:"9em",opacity:0.4},"fast");
      $(this).effect("bounce", { times:2},"fast");
     


});
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

	$("#rules").click(function(){
       
	 
	 location.href="rules.html";
	 
	
	});
	
//document.getElementById("deal").addEventListener("click",startRound,false);


	
});



