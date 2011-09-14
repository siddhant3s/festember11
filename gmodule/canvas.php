<head></head>
<body onload="">
<script type="text/javascript" src="scripts/canvas.js"></script>
<script type="text/javascript" src="scripts/main.js"></script>
<link rel="stylesheet" type="text/css" href="styles/canvas.css">
<input type="hidden" value="new_37.jpg" id="canvasimage">
<img id="closeframe" title="click to collapse" src="images/close.png" onclick="hideiframe()">
<canvas id="galleryimage"  width="798" height="798">

</canvas>
<div id="rating"><span id="currentrating" onclick="viewrating()" class="ratingline">View current rating&nbsp;</span>
<span class="ratingline" id="stars"><span style="float:left">&nbsp;| Vote this picture </span>
<img id="s1" src="images/s0.png" onmouseover="glowstar(1,1)" onclick="rateit(1)" onmouseout="glowstar(0,1)" class="star">
<img id="s2" src="images/s0.png" onmouseover="glowstar(1,2)" onclick="rateit(2)" onmouseout="glowstar(0,2)" class="star">
<img id="s3" src="images/s0.png" onmouseover="glowstar(1,3)" onclick="rateit(3)" onmouseout="glowstar(0,3)" class="star">
<img id="s4" src="images/s0.png" onmouseover="glowstar(1,4)" onclick="rateit(4)" onmouseout="glowstar(0,4)" class="star">
<img id="s5" src="images/s0.png" onmouseover="glowstar(1,5)" onclick="rateit(5)" onmouseout="glowstar(0,5)" class="star">
<span id="ratingtext"></span> | &nbsp;
</span>
<span id="ratingsuccess" class="ratingline" >&nbsp;| &nbsp;&nbsp;&nbsp;&nbsp;<font color="#500050"><span id="successpng"></span>Rating successfully done </font> |</span>
<a target="_blank" onclick="gotooriginal()"><span class="ratingline" id="originalimage">&nbsp;see original image</span></a></div>
</body>
