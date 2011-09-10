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
		</style>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.3/jquery.min.js" ></script>
		<script type="text/javascript">
			setInterval(function(){
				$.ajax({url:"getdata.php",success:function(html){
					var string=html.split('-');	
					$("star1").html(string[0]);
					$("cash1").html(string[1]);
				}});
			},3000);
		</script>
	</head>
	<body>
		<div id="wrapper">
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
