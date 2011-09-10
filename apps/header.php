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
			iframe{
				margin-left:4px;	
			}
			
		</style>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.3/jquery.min.js" ></script>
		<script type="text/javascript">
			var s,c,string;
			window.onload=function(){
				$.ajax({url:"getdata.php",success:function(html){
					y(html);
					x();
				}});
				
			}
			var time=10000;
			function x(){$.ajax({url:"getdata.php",success:function(html){
					y(html);
				}});
				
				if(c==string[0]&&s==string[1]){
						time+=500;
					}
					else{
						time=10000;
				}
				setTimeout(x,time);
			}
			function y(html){
				string=html.split('-');	
					document.getElementById("star1").innerHTML=string[1];
					document.getElementById("cash1").innerHTML=string[0];
					c=string[0];
					s=string[1];
			}
		</script>
	</head>
	<body>
		<div id="wrapper">
		
			<div id="wrapper1">
			
		<iframe src="//www.facebook.com/plugins/like.php?app_id=250561451648935&amp;href=https%3A%2F%2Fwww.facebook.com%2Fapps%2Fapplication.php%3Fid%3D263593520331172%26sk%3Dpage_getting_started&amp;send=false&amp;layout=standard&amp;width=300&amp;show_faces=true&amp;action=like&amp;colorscheme=light&amp;font&amp;height=80" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:300px; height:80px;" allowTransparency="true"></iframe>
			<div id="fb-name">
				<?php echo $user["name"]; ?>
			</div>
			<div id="fbinfo">
				<div id="ph"><fb:profile-pic uid="<?php echo $user["id"]; ?>" facebook-logo="true" linked="false" width="75" height="100"></fb:profile-pic></div>
	
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
