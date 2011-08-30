<?php 
if($logged_in=="true"){
//if(1==1){
?>
<div class="content-head">REGISTER</div>
<form id="r_form" method="post" action="confirm.php">
<div id="registerfont">Accomodation Registration</div><div id="ie"></div>
<table id="r_table">

<tr><td>Representative of Registrant</td><td><input name="name" id="name" autocomplete=off type="textbox"></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>Address</td><td><input name="add1" id="add1" autocomplete=off type="textbox"></td></tr>
<tr><td>&nbsp;</td><td><input name="add2" id="add2" autocomplete=off type="textbox"></td></tr>
<tr><td>&nbsp;</td><td><input name="add3" id="add3" autocomplete=off type="textbox"></td></tr><br>
<tr><td>&nbsp;</td></tr>
<tr><td>Number of boys</td><td><select name="nob" id="nob" ><option>0</option><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option><option>9</option><option>10</option></select></td></tr>
<tr><td>Number of girls</td><td><select name="nog" id="nog" ><option>0</option><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option><option>9</option><option>10</option></select></td></tr>
<tr><td>Date of Arrival (September 2011) </td><td><select name="arri" id="arri"><option>22nd</option><option>23rd</option><option>24th</option><option>25th</option></select></td></tr>
<tr><td>Time of Arrival</td><td><select name="arrT" id="arrT"><option>00:00</option><option>01:00</option><option>02:00</option><option>03:00</option><option>04:00</option><option>05:00</option><option>06:00</option><option>07:00</option><option>08:00</option><option>09:00</option><option>10:00</option><option>11:00</option><option>12:00</option><option>13:00</option><option>14:00</option><option>15:00</option><option>16:00</option><option>17:00</option><option>18:00</option><option>19:00</option><option>20:00</option><option>21:00</option><option>22:00</option><option>23:00</option></select></td></tr>
<tr><td>Date of Departure (September 2011) </td><td><select name="dep" id="dep"><option>22nd</option><option>23rd</option><option>24th</option><option>25th</option></select></td></tr>
<tr><td>Time of Departure</td><td><select name="depT" id="depT"><option>00:00</option><option>01:00</option><option>02:00</option><option>03:00</option><option>04:00</option><option>05:00</option><option>06:00</option><option>07:00</option><option>08:00</option><option>09:00</option><option>10:00</option><option>11:00</option><option>12:00</option><option>13:00</option><option>14:00</option><option>15:00</option><option>16:00</option><option>17:00</option><option>18:00</option><option>19:00</option><option>20:00</option><option>21:00</option><option>22:00</option><option>23:00</option></select></td></tr><br>
<tr><td style="width:250px">&nbsp;(Include all the Member's name inclusive of representative)</td></tr>
<tr><td id="perror">Details of Members </td></tr>
<tr><td>&nbsp;</td></tr>
<div id="fren" name="fren">
<tr id="stu_no" name="stu_no"><td>Member#1</td></tr>
<tr><td>Student Name</td><td><input type="text" name="name1" id="name1" size="20" autocomplete='off' ></td></tr>
<tr><td>College</td><td><input type="text" name="coll1" id="coll1" size="20" autocomplete=off ></td></tr>
<tr><td>Mail Id</td><td><input type="text" name="mail1" id="mail1" size="20" autocomplete=off ></td></tr>
<tr id="ref_tr"><td onclick="addfren()" style="font-size:10px;font-weight:bold;" id="add"><label>Add another member</label></td><td onclick="removefren(this)" style="font-size:10px;font-weight:bold;" id="add"><label>Remove a member</label></td></tr><tr><td>&nbsp;</td></tr>
</div>
<tr><td></td><td><div id="r_submit" onClick="validateA();">Get me stay</div></td></tr>

</table>
</form>
<?php
}
else{
	echo "<div class='plregister'>Please Login to register</div>";}
?>

