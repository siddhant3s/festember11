<?php
	include("fb.php");
?>
<html>
	<head>
		<title>header</title>
		<style type="text/css">
			#wrapper{
				width:100%;
				height:100px;
				background:#ccc;
				box-shadow:#000 1px 1px 1px;
			}
			#wrapper:hover{
				box-shadow:#000 0px 0px 0px;
				border:1px blue solid;
			}
			#xp{
				float:right;
			}
			#fbinfo{
				float:right;
			}
			#cash{
				float:left;
			}
			#wrapper1{
				float:left;
			}
			.logo{
				 width:150px;
				 height:100px;
			}
			#cash1{
				position:absolute;
				left:105px;
				top:45px;
				font-size:10px;
			}
			#star1{
				position:absolute;
				right:40px;
				top:40px;
			}
			
		</style>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.3/jquery.min.js" ></script>
		<script type="text/javascript">
			var s,c;
			window.onload=function(){
				$.ajax({url:"getdata.php",success:function(html){
					var string=html.split('-');	
					document.getElementById("star1").innerHTML=string[1];
					document.getElementById("cash1").innerHTML=string[0];	
					c=string[0];
					s=string[1];				
				}});
			}
			var time=10000;
			setInterval(function(){
				$.ajax({url:"getdata.php",success:function(html){
					var string=html.split('-');	
					document.getElementById("star1").innerHTML=string[1];
					document.getElementById("cash1").innerHTML=string[0];
					if(c==string[0]&&s==string[1]){
						time+=500;
					}
					else{
						time=10000;
					}					
				}});
			},time);
		</script>
	</head>
	<body>
		<div id="wrapper">
			
			<div id="wrapper1">
			
				<div id="fb-root"></div>
<script>(function(d){
  var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
  js = d.createElement('script'); js.id = id; js.async = true;
  js.src = "//connect.facebook.net/en_US/all.js#appId=159692317449601&xfbml=1";
  d.getElementsByTagName('head')[0].appendChild(js);
}(document));</script>
<div class="fb-like" data-href="http://apps.facebook.com/festigame/" data-send="false" data-layout="button_count" data-width="200" data-show-faces="true"></div>
			<div id="cash">
				<img src="images/cash.png" class="logo"/>
				<b><p id="cash1"></p></b>
			</div>
			</div>
			<div id="xp">
				<img src="images/star.png" class="logo"/>
				<b><p id="star1"></p></b>
			</div>
		</div>		
	</body>
</html>
