<?php include("../../connect.php");?>
<?php include("getuser.php");?>
<?php
	
	include("../game.php");
	$id=parseInt($_GET['id']);
	if($id==1){
		$string=getCash()."-";
		$sql="SELECT * FROM gamedata WHERE userid={$usid}";
		$result=mysql_query($sql);
		$row=mysql_fetch_array($result);
		$string .= "{$row['u1']}-{$row['u2']}-{$row['c1']}-{$row['c2']}-{$row['c3']}";
		echo $string;
	}
	else if($id==2){
		
		$string=getCash()."-";
		$sql="SELECT * FROM gamedata WHERE userid={$usid}";
		$result=mysql_query($sql);
		$row=mysql_fetch_array($result);
		$string .= "{$row['c4']}-{$row['c5']}-{$row['d1']}-{$row['d2']}";
		echo $string;
	}
?>
