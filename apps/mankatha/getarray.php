<?php	

$numbers=range(1,52);
shuffle($numbers); 
echo json_encode($numbers);

?>
