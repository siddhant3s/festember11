<html>
	<head>
		<title>header</title>
		<style type="text/css">
			#wrapper{
				width:100%;
				height:100px;
				
			}
			#xp{
				float:right;
			}
			#cash{
				float:left;
			}
			.logo{
				 width:75px;
				 height:75px;
			}
			#cash1{
				float:right;
				
			}
			#star1{
				float:left;
			}
			
		</style>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.3/jquery.min.js" ></script>
		<script type="text/javascript">
			setInterval(function(){
				$.ajax({url:"getdata.php",success:function(html){
					var string=html.split('-');	
					document.getElementById("star1").innerHTML=string[1];
					document.getElementById("cash1").innerHTML=string[0];					
				}});
			},3000);
		</script>
	</head>
	<body>
		<div id="wrapper">
			<iframe src="http://www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fapps%2Fapplication.php%3Fid%3D263593520331172%26sk%3Dwall&amp;width=292&amp;colorscheme=light&amp;show_faces=false&amp;border_color=%23444&amp;stream=false&amp;header=false&amp;height=62" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:292px; height:62px;" allowTransparency="true" style="position:absolute; "></iframe>
			<div id="xp">
				<img src="images/star.png" class="logo"/>
				<p id="star1"></p>
			</div>
			<div id="cash">
				<img src="images/cash.png" class="logo"/>
				<p id="cash1"></p>
			</div>
		</div>		
	</body>
</html>
