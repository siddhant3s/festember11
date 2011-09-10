<?php

$suits = array (
    "S", "H", "C", "D"
);

$faces = array (
    "2", "3", "4", "5", "6", "7", "8",
    "9", "10", "J", "Q", "K", "A"
);


$deck = array();

foreach ($suits as $suit) {
    foreach ($faces as $face) {
        $deck[] = array ("face"=>$face, "suit"=>$suit);
    }
}


shuffle($deck);



$i=0;
function deal($deck)
{global $i;
$card =$deck[$i];
echo $card['face'] . '.' . $card['suit']. ',';
$i++;
return($card);

}

for($q=0;$q<52;$q++)
{
deal($deck);
//echo"<br />";
}
?>
