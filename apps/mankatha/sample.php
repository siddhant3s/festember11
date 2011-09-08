<html>
<?php

function P2JArray($PhpArray,$JA)
{
echo "<script>var ".$JA." = Array();</script>";
for($i=0;$i<count($PhpArray);$i++){
echo "<script>".$JA."[".$i."]='".$PhpArray[$i]."'</script>";
}
}

$numbers =range(1,52);
shuffle($numbers);

P2JArray($numbers, 'numbers');
?>
<head><style type="text/css">
img#select
{
position:fixed;
top:150px;
left:530px;
}
</style></head>
<body>
<img src="card.gif" onclick="return man()" />
<script type="text/javascript">
var i=0;
var d;
function man()
{
d="<img src=" +numbers[i]+ ".gif id='select'/>";
 document.getElementById("php_code").innerHTML=d;
 i++;
 
return false;
 }
</script>
<span id="php_code"> </span>
</body>
</html>

 
