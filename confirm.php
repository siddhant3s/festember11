<head><title>Confirmation</title></head>
<link rel="shortcut icon" href="./images/favicon.png" >
<link rel="stylesheet" type="text/css" href="./styles/main.css">
<body style="font-color:white;">
<?php
session_start();
require('./connect.php');
//if(($_POST['scoll']!=NULL)&&($logged_in=="true")){
if(($_POST['scoll']!=NULL)){
	foreach($_POST as $key=>$val)
		{$$key=(get_magic_quotes_gpc()?$val:addslashes($val));}
	$sname = $_SESSION['OPENID_EMAIL'];	//Hardcoding field `sname` as disabled fields are not sent through post method
	$query = "SELECT `sname` FROM `login` WHERE `sname`='".$sname."' LIMIT 1";
	$result = @mysql_query($query)
	or die("Contact admin! Error occured in Data Fetchingtyu");
	while($arr = mysql_fetch_row($result)){
	if($sname == $arr[0]){
		?>
	<div id="msgcontainer">
	<div id="message">User already registered or something went wrong!<br><br>If problems contact webteam!</div>
	<div id="redirect" ><a href="login" ajaxify="1">Go Back to Main site</a></div></div>
	<?php
	exit(0);
	}
	}
	$query = "SELECT COUNT(`sname`) FROM `login` ";
	$result = @mysql_query($query)
	or die("Contact admin! Error occured in Data Fetchingasd");
	$num =  mysql_fetch_row($result);
	$query = "INSERT INTO `login` (`id` ,`sname` ,`scoll` ,`sphno`) VALUES ('$num[0]', '$sname', '$scoll', '$phno');";
	$result = @mysql_query($query)
	or die("Contact admin! Error occured in Data Updation");
?>
	<div id="msgcontainer">
	<div id="message">Basic Information of the user successfully updated! Your registration ID is FR11<?php echo $num[0]; ?><br><br>Please register for Events and Accomodation!</div>
	<div id="redirect" ><a href="login" ajaxify="1">Go Back to Main site</a></div></div>
<?php
}

//else if( ($_POST['Hevent']!=NULL)&&($logged_in=="true")){
else if(($_POST['Hevent']!=NULL)){	
	foreach($_POST as $key=>$val)
		{$$key=(get_magic_quotes_gpc()?$val:addslashes($val));}
	$sname = $_SESSION['OPENID_EMAIL'];	//Hardcoding field `sname` as disabled fields are not sent through post method
	$query = "SELECT `id` FROM `login` WHERE `sname`='".$sname."' LIMIT 1";
	$result = @mysql_query($query)
	or die("Contact admin! Error occured in Data Fetchingfgh");
	$arr = mysql_fetch_assoc($result);
	$id = $arr['id'];
	if($id==""){
?>
<div id="msgcontainer">
	<div id="message">Please fill the Basic Information before Event Registration</div>
	<div id="redirect" ><a href="login" ajaxify="1">Go Back to Main site</a></div></div>
<?php
	exit(0);
	}
	$i = 1;
	while(1==1){
		$tname = 'name'.$i;$tname = $$tname;
		$tcoll = 'coll'.$i;$tcoll = $$tcoll;
		$tmail = 'mail'.$i;$tmail = $$tmail;
		if($tname != NULL){
			$query = "INSERT INTO `registrant` VALUES('$tname','$tcoll','$tmail','$Hevent','$id')";
			$result = @mysql_query($query)
			or die("Error occured in data updation!");
			$i++;
			}
		else
			break;
		}?>
	<div id="msgcontainer">
	<div id="message">User has been successfully registered for the event <?php echo $Hevent;?> !<br><br>Festember team may soon contact you!<br><br>GoodLuck Folks!!!</div>
	<div id="redirect" ><a href="login" ajaxify="1">Go Back to Main site</a></div></div>
<?php

}

//else if(($_POST['nob']!=NULL)&&($logged_in=="true")){
else if(($_POST['nob']!=NULL)){





	foreach($_POST as $key=>$val)

		{$$key=(get_magic_quotes_gpc()?$val:addslashes($val));}
	$cname = $_SESSION['OPENID_EMAIL'];
	$query = "SELECT `id` FROM `login` WHERE `sname`='".$cname."' LIMIT 1";
	$result = @mysql_query($query)
	or die("Contact admin! Error occured in Data Fetching");
	$arr = mysql_fetch_assoc($result);
	$id = $arr['id'];
	if($id==""){
?>
<div id="msgcontainer">
	<div id="message">Please fill the Basic Information before Accomodation Registration</div>
	<div id="redirect" ><a href="login" ajaxify="1">Go Back to Main site</a></div></div>

<?php
	exit(0);
	}
	$query = "SELECT COUNT(`a_id`) FROM `accomodation` ";
	$result = @mysql_query($query)
	or die("Contact admin! Error occured in Data Fetchingrty");
	$a_id =  mysql_fetch_row($result);
	$address = $add1." ".$add2." ".$add3;
	$query = "INSERT INTO `accomodation` (`id` ,`a_id` ,`name` ,`address` ,`nob` ,`nog` ,`arr` ,`dep` ,`arr_t` ,`dep_t`) VALUES ('$id', '$a_id[0]', '$name', '$address', '$nob', '$nog', '$arri', '$dep', '$arrT', '$depT');";
	$result = @mysql_query($query)
	or die("Contact admin! Error occured in Data Updation");

	$i = 1;
	while(1==1){
		$tname = 'name'.$i;$tname = $$tname;
		$tcoll = 'coll'.$i;$tcoll = $$tcoll;
		$tmail = 'mail'.$i;$tmail = $$tmail;
		if($tname != NULL){
			$query = "INSERT INTO `acco_member` VALUES('$a_id[0]','$tname','$tcoll','$tmail')";
			$result = @mysql_query($query)
			or die("Error occured in data updation!");
			$i++;
			}
		else
			break;
		}

?>
	<div id="msgcontainer">
	<span style="font-size:25px;font-color:black;">Accomodation Confirmation</span><br><br><br>
	<div id="message">Accomodation has been booked and your register id is <span style="color:black;background-color:white;padding:3px;font-size:15px;border:1px solid black;">FA11<?php echo $a_id[0];?> </span> !<br><br>You are registered for accomodation in festember 11 ! Festember team may soon contact you!<br><span style="font-weight:bold;">Please Print this page and bring a copy of this page while reporting the campus during festember !</span><br>See you in festember ! GoodLuck Folks!!!</div>
	<div id="redirect" ><a href="login" ajaxify="1">Go Back to Main site</a></div></div>
<?php

/*}


*/


}


else{
echo "<div id='msgcontainer'>Something really went wrong.Contact Webteam for assistance.<div id=\"redirect\" ><a href=\"login\" ajaxify=\"1\">Go Back to Main site</a></div></div>";
}

?>
</body>
