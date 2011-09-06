<?php 
//if($logged_in=="true"){
if(1==1){
?>
<div class="content-head">REGISTER</div>
<form id="r_form" method="post" action="confirm.php">
<div id="registerfont">Workshop Registration</div><div id="ie"></div>
<table id="r_table">
<tr><td>Event Selected</td><td><label id = "event" name="event">No Event Selected</label></td></tr>
<input type="hidden" name="Hevent" id="Hevent" value="<?php if($_SESSION['eventreg']!=NULL){echo $_SESSION['eventreg'];}?>">
<tr><td >&nbsp;</td><td>&nbsp;</td></tr>
<?php if($_SESSION['eventreg']==NULL){?>
<tr id="eventdisplay""><td>Choose your Workshop Event</td>

<td id="workshopradio" >
<div id="WORKSHOP">

<input type="radio" name="r" onclick="eventSelect(this)" value="dance_couple" id="dance_couple"><label for="dance_couple">Dance Couple (2Members)</label><br>
<input name="r" type="radio" onclick="eventSelect(this)"value="dance_solo" id="dance_solo"><label for="dance_solo">Dance(Solo)</label><br>
<input name="r" type="radio" onclick="eventSelect(this)"value="fencing" id="fencing"><label for="fencing">Fencing</label><br>
<input name="r" type="radio" onclick="eventSelect(this)"value="mente_magica" id="mente_magica"><label for="mente_magica">Mente Magica</label><br>
</div>
<br>
 </td></tr>
<?php } ?>
<tr><td style="width:250px">&nbsp;(Include all the team member's name)</td></tr>
<tr><td id="perror">Details of Team Members </td></tr>
<tr><td>&nbsp;</td></tr>
<div id="fren" name="fren">
<tr id="stu_no" name="stu_no"><td>Participant#1</td></tr>
<tr><td>Student Name</td><td><input type="text" name="name1" id="name1" size="20" autocomplete='off' ></td></tr>
<tr><td>College</td><td><input type="text" name="coll1" id="coll1" size="20" autocomplete=off ></td></tr>
<tr><td>Mail Id</td><td><input type="text" name="mail1" id="mail1" size="20" autocomplete=off ></td></tr>
<tr id="ref_tr"><td onclick="addfren()" style="font-size:10px;font-weight:bold;" id="add"><label>Add another member</label></td><td onclick="removefren(this)" style="font-size:10px;font-weight:bold;" id="add"><label>Remove a member</label></td></tr><tr><td>&nbsp;</td></tr>
</div>
<tr><td></td><td><div id="r_submit" onClick="validate();">I'm attending the Game</div></td></tr>

</table>
</form>
<?php
}
else{
	echo "<div class='plregister'>Please Login to register</div>";}
?>

