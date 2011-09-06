<?php
$rpath = "../";
include("../fb.php");

$con=mysql_connect(10.0.0.126,festember11,festember) or die("Could not connect to database");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
$db_select = mysql_select_db("festember11",$con);
if(isset($_POST['rid']))
{$rids=$_POST['rid'];  
 $rid=explode(',',$rids);
for($i=0;$i<count($rid);i++)
{
$fid=$user["name"];
$sql="INSERT INTO requests VALUES ({$fid},{$rid})";
$result=mysql_query($sql);
}
}
?>


