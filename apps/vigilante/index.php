<?php
session_set_cookie_params(0);
session_start();
$_SESSION['id']=session_id();echo '<pre>';
//require('fb.php');
function getUserInfo(){
	$_SESSION['name']="nUsernmae".time();
	$_SESSION['player']="NavoPlayer";
	$_SESSION['balance']="1000";
}
$json;
try{
require('db_conn.php');
if(!$c)
	throw new Exception(mysql_error());
getUserInfo();
/*
"update.php?a="+score+"&b="+level+"&c="+timelimit+"&d="+user+"&e="+personcount+"&f="+coincount
 p0+p1 coins sec?s sco0*sc1 bb time0*time1*10s
 map
 level
 playername
*/
$r=mysql_query('SELECT `level` FROM `'.$DB_NAME.'`.`vigilante_users` WHERE name=\''.$_SESSION['name'].'\';',$c);
if(!$r)
	throw new Exception(mysql_error());
if(!($r=mysql_fetch_array($r))){
	if(!mysql_query("INSERT INTO `$DB_NAME`.`vigilante_users` (`name`,`level`) VALUES('{$_SESSION['name']}',1);" ,$c))
		throw new Exception(mysql_error());
	$r[0]=1;
	}
$level=$r[0];
$_SESSION['level']=$level;
$_SESSION['persons']=10+$level;
$_SESSION['coins']=10+5*floor($level/10);
$_SESSION['score']=20+floor($level/10);
$_SESSION['time']=30+10*$level;
$_SESSION['addons']=($level>5?'s':null);
$map;
if($level<3)
	$map=1;
else{
	if(!($r=mysql_query('SELECT COUNT(*) FROM `'.$DB_NAME.'`.`vigilante_maps`;',$c)))
		throw new Exception(mysql_error());
	else{
		$map=mysql_result($r,0);
		$map=mt_rand(1,$map);
	}
}
$desc=mysql_query('SELECT * FROM `'.$DB_NAME.'`.`vigilante_maps` LIMIT '.$map.',1;',$c);
if(!desc)
	throw new Exception(mysql_error());
$map=mysql_fetch_array($desc,0);
unset($map);
/*
$json=json_encode(array('name'=>$_SESSION['player'],'level'=>) );
*/
}catch(Exception $e){
	echo '<br/>Error: '.$e->getMessage();
	session_destroy();
	die('Error!');
}
var_dump($json);
?>
<html>
<head>
	<title>Festember Games: Vigilante</title>
	<link rel="shortcut icon" href="images/favicon.png" type="image/png"></link>
	<link rel="stylesheet" type="text/css" href="index.css"></link>
	<link rel="Favicon
	<!--[if lt IE 9]>
		<script type="application/javascript" src="excanvas.js"></script>
	<![endif]-->
	<script type="application/javascript" src="index.js"></script>
</head>
<body onload="bodyLoad()" onkeydown="keyPress(event)">
<div id="bodydiv">
<input type="hidden" id="infojson" value="<?php echo $json; ?>" />

<div class="header">
	<a href="http://www.festember.in/"><img src="images/festember.png" alt="Festember 11" class="header" /></a>
</div>
<div id="checkdiv"></div>

<div id="welcome">
<h1>Welcome to Vigilante</h1>
<br/>
<p><em>Rules of Play</em><br/><br/>
The objective of the game is to collect the coins straying around in the casino and make some easy money. The drunk and ecstastic people won't notice you picking up the coins unless you are in their DIRECT FIELD OF SIGHT. so, all you have to do is to collect 20 points, without getting caught by the security camera or any of the persons around.<br/>
If you are seen by any person around while picking up a coin, there is a high probability that you will be caught. If more persons see you at the same time, the probability is higher.</p>
<br/><p><em>Scores</em><br/>
For each level you clear, you are awarded 100 points. Clear more levels to earn more points! As you go up the levels, the number of persons increases, the time limit reduces and coins are less laying around.</p>
<br/><p><em>How to play?</em><br/>
Move the Barman using the arrow keys. The persons roam around on their own will. To pick up coins, face towards the coin and press <em>A</em> to pick up the coin to score points. You need to pick a minimum number of coins in ach level to upgrade to the next level!</p>

&nbsp;&nbsp;&nbsp;<input type="button" value="Start Game!" onclick="toggleWelcome()" />
</div>
<div id="gameback" onclick="hideGame()"></div>
<div id="game">
<div id="wrapper">
<canvas id="backgroundCanvas" >HTML5 canvas are not supported! Please update your browser to a newer version: IE9, Firefox 1.5 or Chrome 4.1 or higher</canvas>
<canvas id="scratchpadCanvas" z-index=1></canvas>
<canvas id="lidCanvas" z-index=2></canvas>
</div></div>
</div><!-- end bodydiv -->
<div id="footer">
	<a href="http://www.festember.in/"><img src="images/flogo.jpg" id="flogo"></img></a><br/>
	<div id="shoe">
		For Sponsorship, contact <b><em>marketing@festember.in</em></b>
	</div>
</div>
<div id="stockDiv" HIDDEN>
<img src="images/coin.png" id="coin" />
<img src="images/personu.png" id="personu" />
<img src="images/persond.png" id="persond" />
<img src="images/personl.png" id="personl" />
<img src="images/personr.png" id="personr" />
<img src="images/lives.gif" id="life" />
<img src="images/baru.png" id="baru" />
<img src="images/bard.png" id="bard" />
<img src="images/barl.png" id="barl" />
<img src="images/barr.png" id="barr" />
<!--<img src="images/levelbg.png" id="bgimage" />-->
<audio src="sounds/life.mp3" id="lifelost"></audio>
<audio src="sounds/collect.mp3" id="score"></audio>
<audio src="sounds/loss.mp3" id="lose"></audio>
<audio src="sounds/win.mp3" id="win"></audio>
</div>

</body>
</html>
