<HTML>
<HEAD>
<title>Long Line</title>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
$.getScript("game.js");
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
