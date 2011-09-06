<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Score Page</title>
<style type="text/css">
<!--
.style1 {font-family: "AR CHRISTY"}
body {
	background-image: url(score%20pg%20copy.jpg);
	background-repeat: no-repeat;
	background-position:center;
	background-position:top;
}
-->
</style>
</head>

<body>
 <p align="center">
   <?php
  require_once('connectvars.php');

$name=$_GET['name'];
$time=$_GET['time'];
 if($time<60) $score=500;
	   else if($time<120) $score=400;
	   else if($time<180) $score=300;
	   else if($time<240) $score=200;
	   else if($time<300) $score=100;
$dbc = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD)
    or die('Error connecting to MySQL server.');
	mysql_select_db(DB_NAME,$dbc);
	$query="INSERT INTO longline_user VALUES ('$name','$score')";
	
	  $result = mysql_query($query)
    or die('Error querying database.');
	 mysql_close($dbc);
	 if($score!=0)
	 {
 ?>
</p>
 <h1 align="center" class="style1">&nbsp;</h1>
 <h1 align="center" class="style1">CONGRATS <?php echo $name;?>!!!!!!!!!!!!!!!</h1>
 <p align="center" class="style1">You won the game .</p>
 <p align="center" class="style1">Your score is <?php echo $score; ?> </p>
 <p align="center" class="style1"><img src="backtomp.png" border="0" usemap="#Map" />
<map name="Map" id="Map"><area shape="rect" coords="1,1,241,38" href="index.php" /></map></p>
 <p class="style1">&nbsp;</p>
 <?php }
 
 ?>
</body>
</html>
