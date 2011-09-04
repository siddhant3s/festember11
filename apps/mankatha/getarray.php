<?php	

$numbers=range(1,52);
shuffle($numbers);
$number[0]=$numbers[0];
for($i=1;$i<52;$i++)
  if(($numbers[$i]%13)!=($numbers[0])){
    $number[$i]=$numbers[$i];
  }
else
  break;
echo json_encode($number);

?>
