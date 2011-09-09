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

P2JArray($numbers, 'js_num');
?>

<script type="text/javascript">
for(i =0; i<js_num.length;i++)
{
document.write(js_num[i]+" ");

}
</script>