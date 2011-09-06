<HTML>
<HEAD>
<title>Long Line</title>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript"> 

var i, j, q, r;
var xc, yc, StartTime, EndTime,score=0;
var MoveCount, MaxMoveCount, MaxMove=32;
var secs
var timerID = null
var timerRunning = false
var delay = 1000
function InitializeTimer()
{  
    secs = 300
    StopTheClock()
    StartTheTimer()
}

function StopTheClock()
{
    if(timerRunning)
        clearTimeout(timerID)
    timerRunning = false
}
prevmov=new Array(2);
for (i=0; i<2; i++)
  prevmov[i]=new Array(MaxMove);
 
function StartTheTimer()
{
    if (secs==0)
    {
        StopTheClock()
         window.location='score.php?a='+name+'&b='+score;
    }
    else
    {
       document.getElementById("disp").innerHTML= secs
        secs = secs - 1
        timerRunning = true
        timerID = self.setTimeout("StartTheTimer()", delay)
    }
}

deck = new Array(8);
for (i=0; i<8; i++) 
  deck[i] = new Array(4);
temp = new Array(8);
for (i=0; i<8; i++) 
  temp[i] = new Array(4);
val = new Array(8);
for (i=0; i<8; i++) 
  val[i] = new Array(4);

function arran()
{ 
  var iid,ii1;
var jj=0,ii=0;
$.post("refscr.php",function(data) {

uui=data.split('/');
iid=uui[0].split(',');

temp=uui[1].split(';');
for (var i = 0; i < temp.length; i++) {
    var cells = temp[i].split(',');
    for (var j = 0; j < cells.length; j++) {
        cells[j] = parseInt(cells[j]);
    }
    temp[i] = cells;
}

for(ii1=0;ii1<32;ii1++)
 {
   with (document.getElementById('c'+iid[ii1]+'0'))
        { style.top=yc+jj*108;  
          style.left=xc+ii*58;
          style.zIndex=ii+1; 
          style.visibility="visible";
        }
		
		jj++;
		if(jj%4==0)
		{
		jj=0;
		ii++;
		}
 }
  
 });

  for (a=0; a<8; a++)
  { for (b=0; b<4; b++)
    { 
      val[a][b]=true;
    }      
  }
  q=-1;
  r=-1;
  MoveCount=0;
  MaxMoveCount=0;
   xc=eval(Math.floor((window.innerWidth-580)/2));
  yc=20;
 
  InitializeTimer();
  
}
 

 
function Replay()
{ if (MoveCount>=MaxMoveCount) return;
  q=prevmov[0][MoveCount];
  r=prevmov[1][MoveCount];
  Move(q, r, MoveCount);
  MoveCount++;
}
 
function IsValid(ii,jj)
{ if (! val[ii][jj]) return(false);
  if (ii==0) return(true);
  if (ii==7) return(true);
  if ((! val[ii-1][jj])||(! val[ii+1][jj])) return(true);
  return(false);
}
 
function MouseDown(xx, yy)
{ 
if (MoveCount==MaxMove) return;
  var ii, jj, tt, ll, iisel=-1, jjsel=-1;
  for (ii=0; ii<8; ii++)
  { for (jj=0; jj<4; jj++)
    { tt=yc+jj*108;
      ll=xc+ii*58;
      if ((ll<=xx)&&(xx<=ll+71)&&(tt<=yy)&&(yy<=tt+96))
      { iisel=ii;
        jjsel=jj;
      }
    }
  }
  if (iisel<0) return;
  if (! IsValid(iisel, jjsel)) return;
  if (MoveCount>0)
  { if ((temp[q][r]%100!=temp[iisel][jjsel]%100)&&
        (Math.floor(temp[q][r]/100)!=Math.floor(temp[iisel][jjsel]/100)))
      return;
  }
  q=iisel;
  r=jjsel;
  
  Move(q, r, MoveCount);  
  if (prevmov[0][MoveCount]!=q)
  { prevmov[0][MoveCount]=q; MaxMoveCount=MoveCount+1; }
  if (prevmov[1][MoveCount]!=r)
  { prevmov[1][MoveCount]=r; MaxMoveCount=MoveCount+1; }
  MoveCount++;
  if (MaxMoveCount<MoveCount)
    MaxMoveCount=MoveCount;
  if (MoveCount==MaxMove) 
  { alert("hi"); $.ajax({ 
   type: "POST", 
   url: "score.php", 
   data: "name="+name+"&time="+secs, 
   
   success: function(msg){ 
      
   } 
 });
	
       
	  
  }
}
 function backbutton()
{ 
     
if (MoveCount==0) return;
  MoveCount--;
  Move(q, r, -1);
  if (MoveCount==0)
  { q=-1;
    r=-1;
  }
  else
  { q=prevmov[0][MoveCount-1];
    r=prevmov[1][MoveCount-1];
  }
}

function Move(ii, jj, hh)
{ var nn, mm, cc;
  nn=temp[ii][jj]%100;
  mm=(temp[ii][jj]-nn)/100;
     if (hh<0)
    { cc=4*nn+mm;
      with (document.getElementById('c'+cc+'0'))
      { style.top=yc+jj*108;  
        style.left=xc+ii*58;
        style.zIndex=ii+1; 
      }
    }
    else
    { cc=4*nn+mm;
      with (document.getElementById('c'+cc+'0'))
      { style.top=yc+hh*6;  
        style.left=xc+496;
        style.zIndex=hh+1; 
      }
    }
  
  if (hh<0) val[ii][jj]=true;
  else val[ii][jj]=false;
}
 
 
document.onmousedown = md;
 
function md(Event)
{ 
   MouseDown(Event.pageX, Event.pageY);
}
</script>
 
<style type="text/css">
<!--
.style1 {font-family: "AR CHRISTY"}
body {
	background-image: url(table.jpg);
}
.style2 {color: #FFFFFF}
-->
</style>
</head>
<body>
<div align=center>
  <table width="1084" border="0">
    <tr>
      <td width="113"><span class="style1"><span class="style2">Time left(sec)</span>:</span> </td>
      <td width="961" id="disp" class="style2">&nbsp;</td>
    </tr>
  </table>
  <table noborder width=639>
<tr><td height=399><p>&nbsp;</p>
   </td>
</tr>
<tr><td>
<form name="ButtonsForm">
  <table width="651" align=right cellpadding=0 cellspacing=0 noborder>
    <tr>
      <td align=left><img src="undo1.jpg" name="button" onClick="backbutton()"></td>
      <td align=right><img src="redo1.jpg" name="button2" onClick="Replay()"></td>
    </tr>
   
    <tr align=center>
      <td colspan=2><img src="reshuffle1.jpg" name="New" onClick="arran()"></td>
    </tr>
  </table>
</form>
</td></tr></table>
</div>
<script language="JavaScript"> 
 xc=eval(Math.floor((window.innerWidth-580)/2));
yc=20;

 for (i=0; i<8; i++)
  { for (j=0; j<4; j++)
    { document.writeln("<div id=\"c"+eval(4*i+j)+"0\" style=\"position:absolute; top:"+eval(yc+j*108)+"; left:"+eval(xc+i*58)+"; width:71; height:96; visibility:hidden;\">");
      document.writeln("<img src=\"card_"+eval(j+1)+eval(i+7)+".gif\">");
      document.writeln("</div>");
    }
  }

arran(true);
</script>
</body>
</html>
