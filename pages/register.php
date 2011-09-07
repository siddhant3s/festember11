<?php 
if($logged_in=="true"){
//if(1==1){
?>
<div class="content-head">REGISTER</div>
<form id="r_form" method="post" action="confirm.php">
<div id="registerfont">Event Registration</div><div id="ie"></div>
<table id="r_table">
<tr><td>Event Selected</td><td><label id = "event" name="event">No Event Selected</label></td></tr>
<input type="hidden" name="Hevent" id="Hevent" value="<?php if($_SESSION['eventreg']!=NULL){echo $_SESSION['eventreg'];}?>">
<tr><td ><input type="button" id="drop" style="cursor:pointer" onclick="dragEvent(this);" value="Click to show events"></td><td>&nbsp;</td></tr>
<?php if($_SESSION['eventreg']==NULL){?>
<tr id="eventdisplay" style="display:none;"><td>Choose your Event</td>

<td id="eventradio" >
<label id='sDANCE'>[+]</label><label class="eHead" onclick="openEvent(this)" >DANCE</label><br>
<div id="DANCE" style="display:none">
<input type="radio" name="r" onclick="eventSelect(this)" id="choreo_night" value="choreo_night"><label for="choreo_night">Choreo Night</label><br>
<input name="r" type="radio" onclick="eventSelect(this)" value="free_style" id="free_style"><label for="free_style">Free Style Dance(Solo)</label><br>
</div>
<label id='sMUSIC'>[+]</label><label class="eHead" onclick="openEvent(this)" >MUSIC</label><br>
<div id="MUSIC" style="display:none">
<input type="radio" name="r" onclick="eventSelect(this)" value="shrutilaya" id="shrutilaya"><label for="shrutilaya">Shrutilaya(Classical Music)</label><br>
<input type="radio" name="r" onclick="eventSelect(this)" value="tarangini" id="tarangini"><label for="tarangini">Tarangini(Eastern Music)</label><br>
<input type="radio" name="r" onclick="eventSelect(this)" value="gig_a_hertz" id="gig_a_hertz"><label for="gig_a_hertz">Gig-A-Hertz(SemiPro Western)</label><br>
</div>
<label id='sDRAMATICS'>[+]</label><label class="eHead" onclick="openEvent(this)" >DRAMATICS</label><br>
<div id="DRAMATICS" style="display:none">
<input type="radio" name="r" onclick="eventSelect(this)" value="theatrix" id="theatrix"><label for="theatrix">Theatrix</label><br>
</div>
<label id='sCINEMATICS'>[+]</label><label class="eHead" onclick="openEvent(this)" >CINEMATICS</label><br>
<div id="CINEMATICS" style="display:none">
<input type="radio" name="r" onclick="eventSelect(this)" value="take_one" id="take_one"><label for="take_one">TakeOne-Moviemaking</label><br>
<input type="radio" name="r" onclick="eventSelect(this)" value="movie_quiz" id="movie_quiz"><label for="movie_quiz">Movie Quiz</label><br>
</div>

<label id='sARTS'>[+]</label><label class="eHead" onclick="openEvent(this)" >ARTS</label><br>
<div id="ARTS" style="display:none">
<input type="radio" name="r" onclick="eventSelect(this)" value="dominoes" id="dominoes"><label for="dominoes">Dominoes</label><br>
<input type="radio" name="r" onclick="eventSelect(this)" value="soap_carving" id="soap_carving"><label for="soap_carving">Soap Carving</label><br>
<input type="radio" name="r" value="grafitti" id="grafitti" onclick="eventSelect(this)"><label for="grafitti">Grafitti</label><br>
<input type="radio" name="r" onclick="eventSelect(this)" value="face_painting" id="face_painting"><label for="face_painting">Face Painting</label><br>
</div>

<label id='sENGLISH_LITS'>[+]</label><label class="eHead" onclick="openEvent(this)" >ENGLISH_LITS</label><br>
<div id="ENGLISH_LITS" style="display:none">
<input type="radio" name="r" onclick="eventSelect(this)" value="lone_wolf" id="lone_wolf"><label for="lone_wolf">LoneWolf Quiz</label><br>
<input type="radio" name="r" onclick="eventSelect(this)" value="s_e_quiz" id="s_e_quiz"><label for="s_e_quiz">Sport n Entertainment Quiz</label><br>
<input type="radio" name="r" onclick="eventSelect(this)" value="india_quiz" id="india_quiz"><label for="india_quiz">India Quiz</label><br>
<input type="radio" name="r" onclick="eventSelect(this)" value="pot_pourri" id="pot_pourri"><label for="pot_pourri">Pot Pourri</label><br>
<input type="radio" name="r" onclick="eventSelect(this)" value="dumb_charades" id="dumb_charades"><label for="dumb_charades">Dumb Charades</label><br>
<input type="radio" name="r" onclick="eventSelect(this)" value="pixie" id="pixie"><label for="pixie">Pixie</label><br>
<input type="radio" name="r" onclick="eventSelect(this)" value="good_word" id="good_word"><label for="good_word">What's the Good Word?</label><br>
<input type="radio" name="r" onclick="eventSelect(this)" value="cross_word" id="cross_word"><label for="cross_word">Cross Word</label><br>
<input type="radio" name="r" onclick="eventSelect(this)" value="scrabble" id="scrabble"><label for="scrabble">Scrabble</label><br>
<input type="radio" name="r" onclick="eventSelect(this)" value="cluedo" id="cluedo"><label for="cluedo">Cluedo</label><br>
<input type="radio" name="r" onclick="eventSelect(this)" value="just_minute" id="just_minute"><label for="just_minute">Just a minute(JAM)</label><br>
<input type="radio" name="r" onclick="eventSelect(this)" value="debate" id="debate"><label for="debate">Debate</label><br>
<input type="radio" name="r" onclick="eventSelect(this)" value="surprise" id="surprise"><label for="surprise">Surprise Event</label><br>
</div>

<label id='sTAMIL_LITS'>[+]</label><label class="eHead" onclick="openEvent(this)" >TAMIL_LITS</label><br>
<div id="TAMIL_LITS" style="display:none">
<input type="radio" name="r" onclick="eventSelect(this)" value="kuralovium" id="kuralovium"><label for="kuralovium">Debate (Kuralovium)</label><br>
<input type="radio" name="r" onclick="eventSelect(this)" value="nag_komali" id="nag_komali"><label for="nag_komali">Comedy Event (Nagariga Komali)</label><br>
<input type="radio" name="r" onclick="eventSelect(this)" value="velli_thirai" id="velli_thirai"><label for="velli_thirai">Ad-Making (Velli Thirai)</label><br>
<input type="radio" name="r" onclick="eventSelect(this)" value="koothambalam" id="koothambalam"><label for="koothambalam">StreetPlay (Koothambalam)</label><br>
<input type="radio" name="r" onclick="eventSelect(this)" value="chemmozhi" id="chemmozhi"><label for="chemmozhi">Lit Event (Uyar Thani Chemmozhi)</label><br>
<input type="radio" name="r" onclick="eventSelect(this)" value="kavi_thidal" id="kavi_thidal"><label for="kavi_thidal">Poetry (Kavi Thidal)</label><br>
<input type="radio" name="r" onclick="eventSelect(this)" value="sirugathai" id="sirugathai"><label for="sirugathai">StoryWriting (Sirugathai Mannan)</label><br>
<input type="radio" name="r" onclick="eventSelect(this)" value="vallavan" id="vallavan"><label for="vallavan">PotPourri (Sagalakala Vallavan)</label><br>
<input type="radio" name="r" onclick="eventSelect(this)" value="kodambakkam" id="kodambakkam"><label for="kodambakkam">Cinema Quiz (Kodambakkam)</label><br>
<input type="radio" name="r" onclick="eventSelect(this)" value="kolam" id="kolam"><label for="kolam">Kolam</label><br>
<input type="radio" name="r" onclick="eventSelect(this)" value="kurukezhuthu" id="kurukezhuthu"><label for="kurukezhuthu">Crossword (Kurukezhuthu)</label><br>
<input type="radio" name="r" onclick="eventSelect(this)" value="thinam_thorum" id="thinam_thorum"><label for="thinam_thorum">Dailies (Thinam Thorum)</label><br>
<input type="radio" name="r" onclick="eventSelect(this)" value="k_k_p" id="k_k_p"><label for="k_k_p">Dumb Charades (Kattrodu Kathai Pesu)</label><br>
<input type="radio" name="r" onclick="eventSelect(this)" value="keli_chithiram" id="keli_chithiram"><label for="keli_chithiram">Comics (Keli Chithiram)</label><br>
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

