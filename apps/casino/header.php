<?php include("constant.php"); ?>
<?php
	$con = mysql_connect($host,$username,$dbpassword) or die("Could not connect to database");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
$db_select = mysql_select_db("festember11",$con);
 ?>
