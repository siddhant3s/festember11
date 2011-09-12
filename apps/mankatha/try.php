<script type="text/javascript" charset="utf-8" src="jquery1.js">
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