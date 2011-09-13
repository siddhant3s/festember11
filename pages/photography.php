<div class="content-head">PHOTOGRAPHY</div>
<div class="content-body">
<script type="text/javascript" src="gmodule/scripts/main.js"></script>
<link rel="stylesheet" type="text/css" href="gmodule/styles/main.css" />

<iframe src="gmodule/canvas.php" id="iframe" width="800" height="800">
  <p>Your browser does not support iframes.</p>
</iframe>
<div class="gallery_outerbox">
<?php
require_once('gmodule/functions.php');

$no_files = dir_count("gmodule/thumb");
$perpage=20;
if(!$_GET['subpage'])
	$page=1;
else
	$page=$_GET['subpage'];


if($no_files)
{
$page--;
$i=($page*$perpage)+1;
$last = ($page+1)*$perpage;
while(($i<=$no_files)&&($i<=$last)){

?>
<div class="gallery_insidebox" onclick="showcanvas(this);" ><img src="gmodule/thumb/new_<?php echo $i; ?>.jpg" class="boximg"></div>
<?php
$i++;

}
echo "</div>";
$page++;
$no_pages = ceil($no_files/$perpage);
echo "<div id=\"pagecontainer\">";
if($page!=1)
	echo "<a ajaxify=\"2\" href=\"./photography+".($page-1)."\" class=\"pagenumber\">&nbsp;&lt;&lt;prev&nbsp;</a>";
else
	echo "<a class=\"pagenumber\">&nbsp;&lt;&lt;prev&nbsp;</a>";
for($i=1;$i<=$no_pages;$i++){
if($i==$page)
	echo "<a ajaxify=\"2\" href=\"./photography+".$i."\" class=\"pagenumber pagecurrent\">&nbsp;".$i."&nbsp;</a>";
else
	echo "<a ajaxify=\"2\" href=\"./photography+".$i."\" class=\"pagenumber\">&nbsp;".$i."&nbsp;</a>";

}
if($page!=$no_pages)
	echo "<a ajaxify=\"2\" href=\"./photography+".($page+1)."\" class=\"pagenumber\">&nbsp;next&gt;&gt;&nbsp;</a>";
else
	echo "<a class=\"pagenumber\">&nbsp;next&gt;&gt;&nbsp;</a>";
echo "</div>";
}


?>

</div>
