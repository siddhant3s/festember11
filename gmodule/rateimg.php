<?php
require_once('../connect.php');
session_start();
if(($_GET['rateRef']!=NULL)&&($_SESSION['OPENID_EMAIL'])){
//if($_GET['rateRef']!=NULL){
	$user=$_SESSION['OPENID_EMAIL'];
//	$user="behum";
	$arr3 = $_GET['rateRef'];
	$query="SELECT `voted_ids` FROM `gallery_check` WHERE `mail_id`='".$user."' ";
	$result=mysql_query($query);
	if($result){
		$idstring = mysql_result($result,0,'voted_ids');
		if($idstring==""){
			$query="INSERT INTO `gallery_check` (`mail_id`, `voted_ids`) VALUES ('".$user."', '".$arr3."');";
			$result = @mysql_query($query)
			or die("insertion error encountered");
			if(!result)
				echo "1";
			}
		else if($idstring){			
			$ids = explode("|",$idstring);$clk=0;
			for($id=0;$ids[$id]!=NULL;$id++){
				if($ids[$id]==$arr3)
					$clk++;
				}
			if($clk!=0){
				echo "c";exit(0);	//already voted error
				}
			else{
				$idstring=$idstring."|".$arr3;
				$query="UPDATE `gallery_check` SET `voted_ids` = '".$idstring."' WHERE `mail_id` = '".$user."'  LIMIT 1 ;";
				$result = @mysql_query($query)
				or die("updation error encountered");
				if(!$result)
					echo "2";
				}
			}
		else{
			echo "a";exit(0);
			}
		}


		$query="SELECT `vote_avg`,`voters` FROM `gallery_pic` WHERE id='".$arr3."'  LIMIT 1";
		$result3=mysql_query($query);
		if($result3){
			$voteAvg = mysql_result($result3,0,'vote_avg');
			$voters = mysql_result($result3,0,'voters');
			$newAvg = (($voters*$voteAvg)+$_GET['rateIt'])/($voters+1);
			$voters=$voters+1;
			$query="UPDATE `gallery_pic` SET `vote_avg`='".$newAvg."',`voters`='".$voters."' WHERE id='".$arr3."' ";
			$result = mysql_query($query);
			if (!$result){echo "a";}
			else{
				echo "yes";
				}
			}
		else
			echo "b";
	}
else if($_GET['viewRef']){
	$arr1=$_GET['viewRef'];
	$query="SELECT `vote_avg` FROM `gallery_pic` WHERE id='".$arr1."'  LIMIT 1";
	$result1=mysql_query($query);
	if($result1){
		$view = mysql_result($result1,0,'vote_avg');
		if($view)
			echo $view;
		else
			echo "b";
		}
	else
		echo "a";

	}
else
	echo "a";
?>
