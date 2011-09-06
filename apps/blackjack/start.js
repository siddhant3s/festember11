$(document).ready(function() {


 $("body").css("display", "none");
 
    $("body").fadeIn(2000);
	
	$(".button").illuminate({

		'intensity': '0.5',
                  
		'color': '#6A287E',

		'blink': 'true',

		'blinkSpeed': '100',

		'outerGlow': 'true',

		'outerGlowSize': '70px',

		'outerGlowColor': '#F9B7FF'

	});
	$(".si").illuminate();
	$(".button").mouseover(function () {
      $(this).animate({width:"8em",opacity:1},"fast");
});
	
	});
