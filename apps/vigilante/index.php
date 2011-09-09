<?php
$rpath = "../";
include('../fb.php');
var_dump($user);
//$_SESSION['id']=session_id();
$_SESSION['namee']=$user['id'];
$_SESSION['player']=$user['name'];
$_SESSION['balance']="1000";
$json;
try{
include('db_conn.php');
$r=mysql_query('SELECT `level` FROM `'.$DB_NAME.'`.`vigilante_users` WHERE name=\''.$_SESSION['namee'].'\';');
if(!$r)
	throw new Exception(mysql_error());
if(!($r=mysql_fetch_row($r))){
	if(!mysql_query("INSERT INTO `$DB_NAME`.`vigilante_users` (`name`,`level`) VALUES('{$_SESSION['namee']}',1);" ))
		throw new Exception(mysql_error());
	$r[0]=1;
	$_SESSION['new_user']=1;
	}
$level=$r[0];
$_SESSION['level']=$level;
$_SESSION['persons']=10+$level;
$_SESSION['coins']=10+5*floor($level/10);
$_SESSION['score']=20+floor($level/10);
$_SESSION['time']=40+10*$level;
$_SESSION['addons']=($level>5?'s':'').($level>5 && $level%2==0?'b':'');
$map;
if($level<3)
	$map=1;
else{
	if(!($r=mysql_query('SELECT COUNT(*) FROM `'.$DB_NAME.'`.`vigilante_maps`;')))
		throw new Exception(mysql_error());
	else{
		$map=mysql_result($r,0);
		$map=mt_rand(1,$map);
	}
}
$desc=mysql_query('SELECT * FROM `'.$DB_NAME.'`.`vigilante_maps` LIMIT '.$map.',1;');
if(!desc)
	throw new Exception(mysql_error());
$map=mysql_fetch_row($desc);
$_SESSION['map']=$map[0];
unset($map);
$json=json_encode(array('namee'=>$_SESSION['player'],'level'=>$_SESSION['level'],'map'=>$_SESSION['map'],'persons'=>$_SESSION['persons'],'coins'=>$_SESSION['coins'],'score'=>$_SESSION['score'],'time'=>$_SESSION['time'],'addons'=>$_SESSION['addons']));
}catch(Exception $e){
	echo '<br/>Error: '.$e->getMessage();
	session_destroy();
	die('Error!');
}
?>
<html>
<head>
	<title>Festember: Vigilante</title>
	<link rel="shortcut icon" href="images/favicon.png" type="image/png"></link>
	<link rel="stylesheet" type="text/css" href="index.css"></link>
	<link rel="Favicon
	<!--[if lt IE 9]>
		<script type="application/javascript" src="excanvas.js"></script>
	<![endif]-->
	<script src="http://connect.facebook.net/en_US/all.js"></script>
	<script type="text/javascript">
		var ob=<?php echo $json; ?>;
		var appId=<?php echo $facebook->getAppId(); ?>;
	function wallPost(msg){
		FB.ui({
 		"name": msg,
  //to do
		"link":"http://google.com",
		picture:"http://cloud.graphicleftovers.com/11239/item25994/slot-Converted.jpg",
		caption:"Click on the link above to play Festember Games!",
		description:"In a lonely desert rose a city greater than heaven itself. Men and women flock to it, to find joy, fortunes, glory and themselves. Come this September, history will repeat itself as amidst the arid plains of Trichy will rise a new Vegas. Festember 11 - Vegas style!",
		"method":"feed"
		});
	}
<?php
if(isset($_SESSION['new_user'])){
	echo 'wallPost("'.$_SESSION['player'].' started playing Vigilante on Festember Games!"';
	unset($_SESSION['new_user']);
}
?>
	</script>
	<script type="application/javascript" src="index.js"></script>
</head>
<body onload="bodyLoad()">
<div id="fb-root"></div>
<script src="../gameapi.js"></script>
<div id="bodydiv">

<div class="header">
	<a href="http://www.festember.in/"><img src="images/festember.png" alt="Festember 11" class="header" /></a>
</div>

<div id="welcome">
<h1>Welcome to Vigilante</h1>
<br/>
<p><em>Rules of Play</em><br/><br/>
The objective of the game is to collect the coins straying around in the casino and make some easy money. The drunk and ecstastic people won't notice you picking up the coins unless you are in their DIRECT FIELD OF SIGHT. so, all you have to do is to collect 20 points, without getting caught by the security camera or any of the persons around.<br/>
If you are seen by any person around while picking up a coin, there is a high probability that you will be caught. If more persons see you at the same time, the probability is higher. If you get seen by the security camers, you are sure to get caught.</p>
<br/><p><em>Scores</em><br/>
For each level you clear, you are awarded 100 points. Clear more levels to earn more points! As you go up the levels, the number of persons increases, the time limit reduces and coins are less laying around.</p>
<br/><p><em>How to play?</em><br/>
Move the Barman using the arrow keys. The persons roam around on their own will.<br/><strong>Picking up coins: </strong>Face towards the coin and press <em>A</em> to pick up the coin to score points. You need to pick a minimum number of coins in each level to upgrade to the next level!<br/><strong>Using Booze Bomb: </strong/>Press <em>S</em> to throw a Booze Bomb around you. Using a Booze Bomb costs you 2 coins. It sprays a mist of whiskey around you so that any person or camera does not see you picking up coins!</p>

&nbsp;&nbsp;&nbsp;<input type="button" value="Start Game!" onclick="toggleWelcome()" />
</div>
<div id="gameback" onclick="hideGame()"></div>
<div id="game">
<div id="wrapper">
<canvas id="backgroundCanvas" >HTML5 canvas are not supported! Please update your browser to a newer version: IE9, Firefox 1.5 or Chrome 4.1 or higher.
</canvas>
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
