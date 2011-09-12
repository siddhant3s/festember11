<?php
//##############################################################
	//priority 
//##############################################################	//takes in two arguments
		//last colony card
		//and current card under check
		//the field key
//##############################################################
	//returns one integer
			//for numbered cards
		//if p(cc)=p(lc)+1>>1
		//if p(cc)=p(lc)+2>>2
			//for special cards
		//if p(cc)=king>>30
		//if p(cc)=queen>>20
		//if p(cc)=ace>>50
		//if p(cc)=normaljack=11
		//if p(cc)=one-eyedjack>>40
		//if p(cc)=blackeyedjack >>70
//##############################################################
function priority($lastcolonycard,$currentcard,$fieldkey)
{
//##############################################################
global $table_allusers;
global $table_allgames;
global $conn_pag2;
//##############################################################
	//get the color of the last colony card 
$the_acting_color=$lastcolonycard[0];
	//the current card color
$the_given_color=$currentcard[0];
//##############################################################
	//first match the sets 
		//i check the cards based on their sets and ranks
		//and finally invert the coor
//##############################################################
	//check for any special card
if($currentcard[2]=='k'){$priorityint=30}
if($currentcard[2]=='q'){$priorityint=20}
if($currentcard[2]=='a'){$priorityint=50}
if(($currentcard[2]=='j')&&(($thecurrentcard[1]='s')||($thecurrentcard[1]='h'))){$priorityint=40;}
if(($currentcard[2]=='j')&&(!(($thecurrentcard[1]='s')||($thecurrentcard[1]='h')))){$priorityint=11;}
//##############################################################
	//else return the difference

//##############################################################
	//invert if needed
if($the_acting_card!=$the_given_color)
	{
	$priorityint=((-1)*$priorityint);
	}
//##############################################################
return $priorityint;
}
?>
