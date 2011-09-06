<<<<<<< HEAD
<?php

for ($i1=0; $i1<8; $i1++)
    { for ($j1=0; $j1<4; $j1++)
        $deck[$i1][$j1]=100*$j1+$i1;
    }
	for ($nn=0; $nn<1000; $nn++)
    { 
	$i1=rand(0,7);
      $j1=rand(0,3);
     $i2=rand(0,7);
      $j2=rand(0,3);
      $pp=$deck[$i1][$j1];
      $deck[$i1][$j1]=$deck[$i2][$j2];
      $deck[$i2][$j2]=$pp;
	  
    }
	 for ($a=0;$a<8;$a++)
  { for ($b=0; $b<4; $b++)
    { $temp[$a][$b]=$deck[$a][$b];
      $val[$a][$b]=true;
	  
    }      
  }
   for ($ii=0; $ii<8; $ii++)
    { for ($jj=0; $jj<4; $jj++)
      { $nn=$temp[$ii][$jj]%100;
        $mm=($temp[$ii][$jj]-$nn)/100;
        $cc=4*$nn+$mm;
		echo $cc . ",";
      }
    }
	$k=0;
	for($ii=0;$ii<8;$ii++)
	{
    	$temp2[$k]=implode(",",$temp[$ii]);
		
		$k++;
    }
	$temp3=implode(";",$temp2);
	echo "/";
	echo $temp3;
	
	?>
=======
<?php

for ($i1=0; $i1<8; $i1++)
    { for ($j1=0; $j1<4; $j1++)
        $deck[$i1][$j1]=100*$j1+$i1;
    }
	for ($nn=0; $nn<1000; $nn++)
    { 
	$i1=rand(0,7);
      $j1=rand(0,3);
     $i2=rand(0,7);
      $j2=rand(0,3);
      $pp=$deck[$i1][$j1];
      $deck[$i1][$j1]=$deck[$i2][$j2];
      $deck[$i2][$j2]=$pp;
	  
    }
	 for ($a=0;$a<8;$a++)
  { for ($b=0; $b<4; $b++)
    { $temp[$a][$b]=$deck[$a][$b];
      $val[$a][$b]=true;
	  
    }      
  }
   for ($ii=0; $ii<8; $ii++)
    { for ($jj=0; $jj<4; $jj++)
      { $nn=$temp[$ii][$jj]%100;
        $mm=($temp[$ii][$jj]-$nn)/100;
        $cc=4*$nn+$mm;
		echo $cc . ",";
      }
    }
	$k=0;
	for($ii=0;$ii<8;$ii++)
	{
    	$temp2[$k]=implode(",",$temp[$ii]);
		
		$k++;
    }
	$temp3=implode(";",$temp2);
	echo "/";
	echo $temp3;
	
	?>
>>>>>>> 2e5205a051d77c9cf1b70e9d6fba2ed9d206e829
