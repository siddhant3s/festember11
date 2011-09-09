<?php include("../../connect.php");?>
<?php include("getuser.php");?>
<?php include("../game.php");?>
<?php include("../gamearray.php");?>
<?php	
	$sql="SELECT * FROM gamedata WHERE userid={$usid}";
	$result2=mysql_query($sql);
	$row=mysql_fetch_array($result2);
	$u1=$row['u1'];
	$u2=$row['u2'];
	$d1=$row['d1'];
	$d2=$row['d2'];
	$c1=$row['c1'];
	$c2=$row['c2'];
	$c3=$row['c3'];
	$c4=$row['c4'];
	$c5=$row['c5'];
	$money=$row['betamount'];
	/* user def*/    
    $t=array();
    $t[1][0]=($u1+1)%13;
    $t[1][1]=intval(($u1)/13);
    $t[2][0]=(($u2+1)%13);
    $t[2][1]=intval(($u2)/13);
    $t[3][0]=($c1+1)%13;
    $t[3][1]=intval(($c1)/13);
    $t[4][0]=($c2+1)%13;    
    $t[4][1]=intval(($c2)/13);
    $t[5][0]=($c3+1)%13;
    $t[5][1]=intval(($c3)/13);
    $t[6][0]=($c4+1)%13;
    $t[6][1]=intval(($c4)/13);
    $t[7][0]=($c5+1)%13;
    $t[7][1]=intval(($c5)/13);
  /* user def ends */

/* dealer def */
    $d=array();
    $d[1][0]=($d1+1)%13;
    $d[1][1]=intval(($d1)/13);
    $d[2][0]=(($d2+1)%13);
    $d[2][1]=intval(($d2)/13);
    $d[3][0]=($c1+1)%13;
    $d[3][1]=intval(($c1)/13);
    $d[4][0]=($c2+1)%13;    
    $d[4][1]=intval(($c2)/13);
    $d[5][0]=($c3+1)%13;
    $d[5][1]=intval(($c3)/13);
    $d[6][0]=($c4+1)%13;
    $d[6][1]=intval(($c4)/13);
    $d[7][0]=($c5+1)%13;
    $d[7][1]=intval(($c5)/13);

/* dealer ends */


  
/*this is for sorting user*/
  for($i=1;$i<=7;$i++)
   for($j=1;$j<=7-$i;$j++)
if($t[$j][0]>$t[$j+1][0])
{
$q=$t[$j][0];
$t[$j][0]=$t[$j+1][0];
$t[$j+1][0]=$q;
$q1=$t[$j][1];
$t[$j][1]=$t[$j+1][1];
$t[$j+1][1]=$q1;
}
/*ends sorting user*/
/*this is for sorting dealer*/
 for($i=1;$i<=7;$i++)
   for($j=1;$j<=7-$i;$j++)
if($d[$j][0]>$d[$j+1][0])
{
$q=$d[$j][0];
$d[$j][0]=$d[$j+1][0];
$d[$j+1][0]=$q;
$q1=$d[$j][1];
$d[$j][1]=$d[$j+1][1];
$d[$j+1][1]=$q1;
}



$win=0;$valid=1;
$sum=0;
$cnt=0;
$cnt1=0;	
/*royal flush*/ 
if($win==0){
for($i=1;$i<=7;$i++){
if($t[$i][0]>=9&&$t[$i][1]==0){
if((($t[$i][0])==$u1)||(($t[$i][0])==$u2))
$cnt=1;
$sum+=$t[$i][0];

}
}
if($sum==55&&$cnt==1){
$win=1;
$result="royal flush";
$multiply=15;}
}
$sum=0;
/* dealer starts */
if($win==0){
for($i=1;$i<=7;$i++){
if($d[$i][0]>=9&&$d[$i][1]==0){
if((($d[$i][0])==$d1)||(($d[$i][0])==$d2))
$cnt1=1;
$sum+=$d[$i][0];

}
}
if($sum==55&&$cnt1==1)
{
$win=2;
$result1="royal flush";
$multiply=-1;}
}


/*royal flush ends*/







/*flush starts*/
if($win==0){

$flush=array();
$flush1=array();
$pos=-1;
$cnt=-1;$cnt6=$cnt7=0;
$cnt1=$cnt3=$cnt2=$cnt4=0;

for($i=1;$i<=7;$i++){
if($t[$i][1]==0){
$cnt1++;
if($cnt1==5)
$cnt=0;
}
if($t[$i][1]==1){
$cnt2++;
if($cnt2==5)
$cnt=1;
}
if($t[$i][1]==2)
{
$cnt3++;
if($cnt4==5)
$cnt=2;
}if($t[$i][1]==3)
{
$cnt4++;
if($cnt4==5)
$cnt=3;}
}
if($cnt>=0){
for($i=1;$i<=7;$i++){
if($t[$i][1]==$cnt){
$flush[++$pos]=$t[$i][0];
$flush1[$pos]=$t[$i][1];
}
}

for($j=0;$j<=$pos-4;$j++)
{
if(($flush[$j]+1==$flush[$j+1])&&($flush[$j]+2==$flush[$j+2])&&($flush[$j]+3==$flush[$j+3])&&($flush[$j]+4==$flush[$j+4]))
{
if(($flush1[$j]==$u1)||($flush1[$j+1]==$u1)||($flush1[$j+2]==$u1)||($flush1[$j+3]==$u1)||($flush1[$j+4]==$u1)||($flush1[$j+5]==$u1)||($flush1[$j]==$u2)||($flush1[$j+1]==$u2)||($flush1[$j+2]==$u2)||($flush1[$j+3]==$u2)||($flush1[$j+4]==$u2)||($flush1[$j+5]==$u2))
$cnt7=1;
$win=1;
}
}
}
if($win==1&&$cnt7==1){
$result="flush";
$multiply=2;}
else
$win=0;
}

/* dealer starts */










if($win==0){

$flush=array();
$flush1=array();
$pos=-1;
$cnt=-1;$cnt6=$cnt7=0;
$cnt1=$cnt3=$cnt2=$cnt4=0;

for($i=1;$i<=7;$i++)
{if($d[$i][1]==0)
{
$cnt1++;
if($cnt1==5)
$cnt=0;
}
if($d[$i][1]==1)
{
$cnt2++;
if($cnt2==5)
$cnt=1;
}
if($d[$i][1]==2)
{
$cnt3++;
if($cnt4==5)
$cnt=2;
}if($d[$i][1]==3)
{
$cnt4++;
if($cnt4==5)
$cnt=3;}
}
if($cnt>=0){
for($i=1;$i<=7;$i++){
if($d[$i][1]==$cnt){
$flush[++$pos]=$d[$i][0];
$flush1[$pos]=$d[$i][1]*13+$d[$i][0];

}
}

for($j=0;$j<=$pos-4;$j++)
{
if(($flush[$j]+1==$flush[$j+1])&&($flush[$j]+2==$flush[$j+2])&&($flush[$j]+3==$flush[$j+3])&&($flush[$j]+4==$flush[$j+4]))
{
if(($flush1[$j]==$d1)||($flush1[$j+1]==$d1)||($flush1[$j+2]==$d1)||($flush1[$j+3]==$d1)||($flush1[$j+4]==$d1)||($flush1[$j]==$d2)||($flush1[$j+1]==$d2)||($flush1[$j+2]==$d2)||($flush1[$j+3]==$d2)||($flush1[$j+4]==$d2))
$cnt7=1;
$win=2;
}
}
}
if($win==2&&$cnt7==1){
$result1="flush";
$multiply=-1;}
else
$win=0;
}




/*flush ends*/
	
/*4 of a kind */
$cnt=0;	
if($win==0)
	{
	$suc=0;
	for($i=1;$i<=4;$i++)
	{
	for($j=$i;$j<$i+4;$j++)
	{
	if($t[$j][0]!=$t[$i][0])
	$suc=-1;
else 
if($t[$j][0]==$u1||$t[$j][0]==$u2)
$cnt=1;	
}if($suc==0)
	{$pos=$t[$i][0];
	break;
	}else if($i!=4)
	$suc=0;
	}
	if($suc==0)
	{$win=1;
	$result="four of a kind";
$multiply=5;
	}
	}

$cnt=0;	

if($win==0)
	{
	$suc=0;
	for($i=1;$i<=4;$i++)
	{
	for($j=$i;$j<$i+4;$j++)
	{
	if($d[$j][0]!=$d[$i][0])
	$suc=-1;
else 
if($d[$j][0]==$d1||$d[$j][0]==$d2)
$cnt=1;
	}if($suc==0)
	{$pos=$d[$i][0];
	break;
	}else if($i!=4)
	$suc=0;
	}
	if($suc==0&&$cnt==1)
	{$win=2;
	$result1="dealer four of kind";
$multiply=-1;
	}
	}
/*4 of a kind ends*/

/*full house*/
if($win==0){ 	
$cnt7=array();
//$fll=array();
$k=0;
for($i=0;$i<=13;$i++)
$fll[$i]=0;
for($i=1;$i<=7;$i++)
{
$fll[$t[$i][0]]++;
if($fll[$t[$i][0]]==3)
{$cnt7[$k]=$t[$i][0];
$k++;
}}
if($k>1)
{$win=1;
}
else if($k==1)
for($i=1;$i<=7;$i++)
{
if($t[$i][0]!=$cnt7[0])
if($fll[$t[$i][0]]>=2)
{

$win=1;
$result="full house";
$multiply=3;
}  
}

}



/* full house ends*/

/*flush*/
if($win==0){
$cnt7=array();
for($i=0;$i<=4;$i++)
{
$cnt7[$i]=0;
}
for($i=1;$i<=7;$i++)
{$cnt7[$t[$i][1]]++;
if($cnt7[$t[$i][1]]>=5)
{$win=1;
$result="flush";
$multiply=2;
}}

}
/*flush ends*/

/* debugging to be done */








/* straight starts */

if($win==0){
$flush=array();$k=0;
$flush[$k++]=$t[1][0];	
for($i=2;$i<=7;$i++)
{
if($t[$i][0]!=$t[$i-1][0])
$flush[$k++]=$t[$i][0];
}
if($k>=5)
for($j=0;$j<$k-4;$j++)
if(($flush[$j]+1==$flush[$j+1])&&($flush[$j]+2==$flush[$j+2])&&($flush[$j]+3==$flush[$j+3])&&($flush[$j]+4==$flush[$j+4]))
{$win=1;
$result="straight flush";
$multiply=7;
}
}
/* straight ends*/









/*3 pairs start*/
if($win==0){
$cnt7=array();
//$fll=array();
$k=0;
for($i=0;$i<=13;$i++)
$fll[$i]=0;
for($i=1;$i<=7;$i++)
{
$fll[$t[$i][0]]++;
if($fll[$t[$i][0]]==3)
{$cnt7[$k]=$t[$i][0];
$k++;
}}
if 	($k>=1){$win=1;
$result="three of kind";
$multiply=1;
}}
/*3 pair ends*/





/* two 2pairs start*/


if($win==0){
$cnt7=array();
//$fll=array();
$k=0;
for($i=0;$i<=13;$i++)
$fll[$i]=0;
for($i=1;$i<=7;$i++)
{
$fll[$t[$i][0]]++;
if($fll[$t[$i][0]]==2)
{$cnt7[$k]=$t[$i][0];
$k++;
}}
if($k>1)
{$win=1;
$result="double pair";
$multiply=1;
}
else if($k==1)
for($i=1;$i<=7;$i++)
{
if($t[$i][0]!=$cnt7[0])
if($fll[$t[$i][0]]>=2)
{

$win=1;
$result="double pair";
$multiply=1;
}  
}

}





/* two 2 pair ends */









/*2 pair start*/
if($win==0){
$cnt7=array();
//$fll=array();
$k=0;
for($i=0;$i<=13;$i++)
$fll[$i]=0;
for($i=1;$i<=7;$i++)
{
$fll[$t[$i][0]]++;
if($fll[$t[$i][0]]==2)
{$cnt7[$k]=$t[$i][0];
$k++;
}}
if($k>=1){$win=1;
$result="2 pairs";
$multiply=1;
}}
/*2 pair ends*/

/*
if(isset($result1)){
	echo $result1;
}
else if(isset($result)){
	
	echo $result;
}
echo "{$win}";
*/
//echo $win;
if($win!=0&&$multiply!=1){
	$won=$money*$multiply;
}
else if($win==0){
	$multiply=-1;
	$won=$money*-1;
}
else if($win!=0&&$multiply==1){
	$won=0;
}
$sql="SELECT * FROM windata WHERE userid={$usid}";
$result3=mysql_query($sql);
if(!mysql_num_rows($result3)){
	$sql="INSERT INTO windata VALUES({$usid},{$won})";
	$result3=mysql_query($sql);
}
else{	
		$row=mysql_fetch_array($result3);
		$won+=$row['win'];
		$sql="UPDATE windata SET win='{$won}' WHERE userid={$usid}";
		$result3=mysql_query($sql,$con);
}
$time=time();
$percent=$multiply*100;
if($percent==-100){
	$percent=0;
}
$res=mysql_query("UPDATE game_info SET bidamount={$money} endtime={$time} returnpercent={$percent} WHERE gameid={$game_array['poker']} AND endtime='0000-00-00 00:00:00' ,$con);
echo $money*$multiply;
?>
