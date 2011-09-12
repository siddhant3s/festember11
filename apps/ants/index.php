<html>
<head>
<style type="text/css">
body{background-image:url(back.jpg);opacity:1.0;}
#complete{width:80%;height:99%;margin:auto;border-color:white;border-style:solid;}
#picture{width:99%;height:300px;margin:auto;border-color:white;border-style:solid;}
#logo{width:99%;height:160px;margin:auto;border-color:white;border-style:solid;margin-bottom:5px;border-radius:35px;}
#navigation{width:99%%;height:100px;background-color:black;opacity:0.8;z-index:9;border-radius:35px;border-style:ridge;}
.linkdivs{width:15%;height:60%;border-color:white;border-style:solid;float: left;margin-left: 28px;text-align:center;border-radius:70px;padding-right: 7px;padding-top:35px; }
#firstlinkdiv{margin-left: 120px;}

</style>
<script type="text/javascript" src="/jquery/jquery-1.7.2.min.js">
$(document).ready(function(){
	$("#firstlinkdiv").click(function(){
		$("#picture").load("placeyourbet.php");
		});
			$("#firstlinkdiv").mouseover(function(){
		$("this").css("background-color","green");
		});
	})
</script>
</head>
<body>
<div id="complete">
<div id="picture">

</div>
<div id="logo">
</div>
<div id="navigation">
<div class="linkdivs" id="firstlinkdiv"> PLAY</div>
<div class="linkdivs"> RULES</div>
<div class="linkdivs"> HELP</div>
<div class="linkdivs"> CREDITS</div>
</div>
</div>
</body>
</html>