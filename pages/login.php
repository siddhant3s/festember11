<?php 
if($logged_in=="true"){
//if(1==1){
?>
<div class="content-head">Welcome <?php echo $_SESSION['OPENID_WELCOME_NAME']; ?></div>
<form id="r_form">
<div id="registerfont">Festember 11</div><div id="ie"></div>
<div id="logincontainer">
<a ajaxify=1 href="basic"><input type="button"  value="Basic Information" /></a><br>
<a ajaxify=1 href="register"><input type="button" value="Event Registration" /></a><br>
<a ajaxify=1 href="workshop"><input type="button" value="Workshop Registration" /></a><br>
<a ajaxify=1 href="accomodation"><input type="button" value="Accomodation Registration" /></a>

</div>
<label>NOTE : <br>Fill the basic information before availing event or accomodation registration.<br>For multiple events participation, Register them one after another.</label>
</form>

<?php
}
else{
	echo "<div class='plregister'>Please Login with your Google/Yahoo/Facebook account to register for Festember 11</div>";}
?>
