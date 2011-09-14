<?php
	$gamelinkpath="../apps/";
$rpath = "";
include("game.php");
?>
<html>
<head>
<title>festember games</title>
<link href="main.css" type="text/css" rel="stylesheet"/>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.3/jquery.min.js" ></script>
<script src="http://connect.facebook.net/en_US/all.js"></script>
</head>
<body style="margin:0; ">
<div id="fb-root"></div>
<script src="gameapi.js"></script>
<div id="wrapper">
<div id="facebooklike">
<iframe src="http://www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fapps%2Fapplication.php%3Fid%3D263593520331172%26sk%3Dwall&amp;width=292&amp;colorscheme=light&amp;show_faces=false&amp;border_color=%23444&amp;stream=false&amp;header=false&amp;height=62" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:292px; height:62px;" allowTransparency="true" style="position:absolute; "></iframe>
</div>
<div id="games">
<a href="<?php echo $gamelinkpath ;?>longline/" id="g1"></a>
<a href="<?php echo $gamelinkpath ;?>mankatha/" id="g2"></a>
<a href="<?php echo $gamelinkpath ;?>roulette/" id="g3"></a>
<a href="<?php echo $gamelinkpath ;?>poker/" id="g4"></a>
<a href="<?php echo $gamelinkpath ;?>claw/" id="g5"></a>
</div>
</div>
</body></html>
