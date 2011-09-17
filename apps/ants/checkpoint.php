
<?php 
global $rpath;
$rpath="../";
require_once("allglobals.php");
require_once("../game.php");
require_once("whisk.php");
global $user;
$the_fb_id=$user['id'];
//#######################################################################################
	//get the bet and the opponent id
	$result_fetch=mysql_query("select opponent from $table_allusers where user_id='$the_fb_id'");
	$answer_fetch=mysql_fetch_array($result_fetch);
	if(!$answer_fetch)
		{
			whisk(72);
			exit();
		}
	$opponent_id=$answer_fetch['opponent'];
	$select_bets=mysql_query("select id1,id2,bet1,bet2 from $table_allgames where ((id1='$the_fb_id' and id2='$opponent_id') or (id2='$the_fb_id' and id1='$opponent_id')) and active=1");
	$answer_bets=mysql_fetch_array($select_bets);
	if($answer_bets)
		{

			whisk(77);
			exit();

		}
	$fetched_id1=$answer_bets['id1'];
	$fetched_id2=$answer_bets['id2'];
	$fetched_bet1=$answer_bets['bet1'];
	$fetched_bet2=$answer_bets['bet2'];
	if($fetched_id1==$the_fb_id)
		{
		$bet_me=$fetched_bet1;
		$bet_other=$fetched_bet2;
		$oth_id=$fetched_id2;
		}
	else if($fetched_id2==$the_fb_id)
		{
		$bet_me=$fetched_bet2;
		$bet_other=$fetched_bet1;
		$oth_id=$fetched_id1;
		}
//#######################################################################################
?>
<html>
<head>
<style type="text/css">
body{background-image:url(back.jpg);opacity:1.0;}
#complete{width:80%;height:99%;margin:auto;border-color:white;border-style:solid;}
#picture{width:99%;height:80%;margin:auto;border-color:white;border-style:solid;}
#details{width:99%%;height:19%;background-color:black;opacity:0.8;z-index:9;border-radius:35px;border-style:ridge;}
</style>
<script type="text/javascript" src="jquery-1.3.2.min.js">
</script>
</head>
<body>
<div id="complete">
<div id="picture">
</div>
<div id="details">
<?php
echo "<h1>$the_fb_id{$bet_me}  --------VERSUS---------  $oth_id{$bet_other}</h1>";

?>
</div>
</div>
</body>
</html>

<?php
sleep(10);
header("Location:$themaingamepage");
exit(1);

?>