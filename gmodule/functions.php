<?php

function create_image($uploadfile,$bigname,$max_w,$max_h,$imgpath)	//parameters - originalfilepath/originalfilename/new_width/new_height/newimage_path
{
$big = imagecreatefromjpeg($uploadfile);
$width = imagesx($big);
$height = imagesy($big);
$scale = min($max_w/$width,$max_h/$height);
$n_width = floor($scale*$width);
$n_height = floor($scale*$height);
$small = imagecreatetruecolor($max_w,$max_h);
//imagecolorallocate($small,255,255,255);
$small_y = 0;
$small_x = 0;
if($n_width==$max_w){
$small_y = ($max_h-$n_height)/2;
}
else if($n_height==$max_h){
$small_x = ($max_w-$n_width)/2;
}
$smallcopyprocess = imagecopyresized($small,$big,$small_x,$small_y,0,0,$n_width,$n_height,$width,$height);
if(!$smallcopyprocess)
	echo "Oops!problem occured in copying the picture to thumb file. Please contact admin.<br />";
else
	echo "New image cloned from the actual picture ".$bigname.".jpg..<br />";

$smallcreateprocess = imagejpeg($small,'./'.$imgpath.'new_'.$bigname.'.jpg',100);

if(!$smallcreateprocess)
	echo "Oops!problem occured in storing the thumb file. Please contact admin.<br />";
else
	echo "New image stored in ".$imgpath."new_".$bigname.".jpg..<br />";
//echo "sdf";
imageDestroy($small);	// destory the temperory thumb file that was created
}

function store_original_file($uploadfile,$filename,$target_path){

$target_path = $target_path.$filename.'.jpg';
if(move_uploaded_file($uploadfile,$target_path))
	echo "File had been uploaded in ".$target_path."..<br />";
else
	echo "Oops! Error occured in image file upload..<br />";

}

function insert_in_database($filename){
$query = "SELECT COUNT(`id`) FROM `gallery_pic`";
$result=@mysql_query($query)
or die("Contact admin! Error occured in Data Fetching");

$num =  mysql_fetch_row($result);
$num = $num[0] + 1;
$query = "INSERT INTO `gallery_pic` (`id` ,`imgname` ,`vote_avg` ,`voters`) VALUES ('$num' , '$filename', 0.00 , 0);";
$result = @mysql_query($query)
or die("Contact admin! Error occured in Data Updation");
if($result)
	echo "Image details inserted in the database..<br />";
return $num;
}
function dir_count($dir) {
$x = 0;
$dir = opendir($dir);
while( ($file = readdir($dir)) !== false) {
$x = $x + 1;
}
closedir($dir);
return $x-2;
}

?>
