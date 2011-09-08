<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>High Score</title>
<style type="text/css">
<!--
.style1 {
	font-family: "AR CHRISTY";
	color: #990033;
}
.style7 {
	color: #990099;
	font-size: large;
	font-family: Rockwell;
}
body {
	background-image: url(high%20scores.jpg);
	background-repeat: no-repeat;	
	background-position:center;
	background-position:top;
}
.style8 {
	font-family: "Courier New", Courier, monospace;
	font-size: 18px;
	color: #FFFF99;
}
-->
</style>
</head>

<body>
<?php
include("../../connect.php");

	$query="SELECT * FROM ".DB_TABLE." ORDER BY Score DESC LIMIT 5";
	
	  $result = mysql_query($query)
    or die('Error querying database.');



?>
<table width="270" border="2" align="center" cellpadding="1" cellspacing="1" bordercolor="#330066">
  <caption>&nbsp;
  </caption>
  <tr>
    <td width="125"><h2 align="center" class="style1">Name</h2></td>
    <td width="114" class="style1"><h2 align="center">Score</h2></td>
  </tr>
  <?php 
  while ($row = mysql_fetch_array($result)) {

?>
  <tr>
    <td class="style2"><h3 align="center" class="style7 style8"><?php echo $row['Name']; ?></h3></td>
    <td class="style2"><h3 align="center" class="style8"><?php echo $row['Score']; ?></h3></td>
  </tr>
  <?php }
   mysql_close($dbc);
 ?>
</table>
<div align="center"><a href="index.php" class="style7"></a><img src="backtomp.png" width="241" height="38" border="0" usemap="#Map" />
<map name="Map" id="Map"><area shape="rect" coords="4,6,238,36" href="index.php" /></map></div>
</body>
</html>
