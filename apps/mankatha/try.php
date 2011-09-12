<script type="text/javascript" charset="utf-8" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.3/jquery.min.js">
$(document).ready(function(){
	$.getJSON("getarray.php?c=1",function (json){
		numbers=json;
		alert(numbers[0]);
	});
});
$.get("getarray.php?c=0",function (data){
		  a=data;
		  alert(a);
		});
</script>