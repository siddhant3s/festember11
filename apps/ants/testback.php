<html>
<head>
<style type="text/css">
.okay{	border-radius:5px;
		position: absolute;
		left: 300px;
		top: 100px;
		background-color:green;
		height:98px;
		width:64px;
		background-image: url("cardz.png");
		background-position:-62px 0px;;
	}

</style>
<script type="text/javascript" src="/jquery/jquery-1.3.2.min.js">
$(document).ready(function(){$("#aise").click(function(){var current_id=$(".that").attr("id");document.write(current_id);});})

</script>
</head>
<body>
<div class="okay" id="aise"></div>
</body>
</html>