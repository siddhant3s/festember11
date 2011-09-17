<?php
if(isset($_GET['alertnobalance']))
  {
    echo "<script> alert(\"no balance \");</script>";
  }
?>
<html>
<title>mangatha</title>
<head>
<style type="text/css">
html, body {
  height: 100%;
  width: 100%;
  overflow: hidden;
  padding: 0;
  margin: 0;
}

#bimage
{	position:absolute;

height:655px;
z-index:-1;
width:800px;
}
#pos
{
	position:absolute;
    left:300px;
   	top:350px;
}
#frame iframe{
	margin:0px;
	padding:0px;
}
#frame{
	margin:0px;
	padding:0px;
	height:100px;
}</style>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.3/jquery.min.js"></script>
<script type="text/javascript">
	
function onlyNumbers(evt)
  { 
 var charCode =(evt.which)? evt.which :event.keyCode
       if (charCode >31 &&(charCode <48 || charCode > 57))
                  { alert("only numbers");
                   return false;
                   }
              return true;
   }
function checkNumbers()
   {
      var x=document.forms["myform"]["txtchar"].value;
      if(x<25)
     {
         alert("number should be greater than 100");
         return false;
      }
      document.location='test1.php';
      return true;

}

</script>
<body style="margin:0px;">

<div id="wrapper">
<img alt="full screen background image" src="mangatgha.png" id="bimage">
<div id="pos">
<p>Enter bid</p>
<form action="test1.php" name="myform" onSubmit="return checkNumbers()" method="post">

<input id="txtchar"  type="text" name="txtchar" 
onkeypress="return onlyNumbers(event);">
<input type="submit" value="Bet" >
</form>
</div>
</body>

</head>
</html>
