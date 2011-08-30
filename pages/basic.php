<?php 
if($logged_in=="true"){
//if(1==1){
?>
<form id="r_form" method="post" action="confirm.php">
<div id="registerfont">Basic Information</div><div id="ie"></div>
<table id="r_table">
<tr><td>Login Name / Mail id</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input disabled="true" id="sname" autocomplete=off name="sname" type="text" size="20" value="<?php echo $_SESSION['OPENID_EMAIL'];?>"></td></tr>
<tr><td>College</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input id="scoll" name="scoll" autocomplete=off type="text" size="20" ></td></tr>
<tr><td>Phone Number</td><td>+91<input type="text" size="12" autocomplete=off name="phno" id="phno" ></td></tr>
<tr><td>&nbsp;</td></tr>

<tr><td></td><td><div id="r_submit" onClick="validateBasic();">This is me !</div></td></tr>

</table>
</form>
<?php
}
else{
	echo "<div class='plregister'>Please Login with your Google/Facebook account to register for Festember 11</div>";}
?>

