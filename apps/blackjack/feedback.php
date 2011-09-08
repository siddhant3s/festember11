<?php
include("config.php");

?>

<html>
<head>
<style type="text/css">
#alertfeed{
display:none;
}
#thankyounow{
display:none;
}


</style>
<script src="jquery-1.6.2.js" type="text/javascript"></script>
<script type="text/javascript">
function feeds()
{
var radioSelected = false;
for (i = 0;  i < feedbackform.feedval.length;  i++)
{
if (feedbackform.feedval[i].checked)
radioSelected = true;
}
if (!radioSelected)
{
$("#alertfeed").fadeIn(200);
return (false);
}

if(radioSelected)
{
$("#alertfeed").fadeOut(10);
$("#thankyounow").fadeIn(100);
parent.$("#showfeed").delay(1500).hide(1000);
return (true);

}




}

</script>
</head>
<body bgcolor="grey">
<h2><font color="white">FeedbacK </font></h2>
rate this game : <br>
<form name="feedbackform" action="" method="post" onsubmit="return feeds()">
<input type="radio" name="feedval" id="e" value="excellent"><label for="e" style="cursor:pointer">excellent</label><br>
<input type="radio" name="feedval" id="n" value="nice" ><label for="n" style="cursor:pointer">nice</label><br>
<input type="radio" name="feedval" id="av" value="average"><label for="av" style="cursor:pointer">average</label><br>
<input type="radio" name="feedval" id="p" value="poor"><label for="p" style="cursor:pointer">poor</label><br>
<br>
report any bug here :<br><br>
<textarea cols="30" rows="5" name="bugfix"></textarea><br><br>
<input type="submit" value="submit" ><br>
<span id="alertfeed"><font color="red"><b>please select a rating</b></font></span>
<span id="thankyounow"><font color="darkgreen"><b>thank you for your feedback..!</b></font></span>
</form>
<?php
$th=0;
$rating=mysql_real_escape_string($_POST["feedval"]);
$bug=mysql_real_escape_string($_POST["bugfix"]);

mysql_query("INSERT  INTO feedback (no,rating,bug) VALUES (NULL,'$rating','$bug')") or die(mysql_error());

?>

</body>
</html>