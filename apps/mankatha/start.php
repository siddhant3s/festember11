
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

.centered {
  position: fixed;
  top: 50%;
  left: 50%;
  margin-top: -50px;
  margin-left: -100px;
}

#bimage
{	position:absolute;
 left:250px;
height:655px;
z-index:-1;
}
#pos
{
	position:absolute;
    left:45%;
    top:50%;
}</style>
<script type="text/javascript" src="jquery.js"></script>
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
      if(x<100)
     {
         alert("number should be greater than 100");
         return false;
      }
      document.location='test1.php';
      return true;

}

</script>
<body>
<img alt="full screen background image" src="mangatgha.png" id="bimage">
<div id="pos">
<p>Enter bid</p>
<form action="test1.php" name="myform" onSubmit="return checkNumbers()" method="post">

<input id="txtchar"  type="text" name="txtchar" 
onkeypress="return onlyNumbers(event);">
<input type="submit" value="Bet" >
</form>
</body>

</head>
</html>
