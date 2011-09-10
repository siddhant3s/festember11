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
				background:#1ba1e2;
				border:1px #eee solid;
			}
			#wrapper:hover{
				border:1px #ccc solid;
			}
			#xp{
				float:right;
			}
			#fb-name{
				margin-top:40px;
				margin-left:4px;
				color:white;
				font-weight:bold;
				float:right;
			}
			#fbinfo{
				float:right;
					
			}
			#cash{
				float:left;
				background:#1BA1E2;
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
			p{
				color:white;
			}
			#ph{
				margin-top:5px;
				margin-left:0px;
				border:5px solid #fff;
				box-shadow:0px 0px 2px 2px #666;
			}
			.fb-like{
				margin-top:35px;
				margin-left:4px;	
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
				x;
			}
			var time=10000;
			function x(){
			
				
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
				
				setTimeout(x,time);
			}
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
<div class="fb-like" data-href="http://apps.facebook.com/festigame/" data-send="false" data-layout="button_count" data-width="50" data-show-faces="true"></div>
			
			<div id="fb-name">
				<?php echo $user["name"]; ?>
			</div>
			<div id="fbinfo">
				<div id="ph"><fb:profile-pic uid="<?php echo $user["id"]; ?>" linked="true"></div>
	
			</div>
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
