<?php
if($_POST){

/*include functions*/
require_once('functions.php');
require_once('../connect.php');
//echo $_FILES['ufile']['name']."<br>".$_FILES['ufile']['tmp_name'];
//header('Content-Type: image/jpeg');

/*parameter variables*/
$uploadfile = $_FILES['ufile']['tmp_name'];
$filename = $_FILES['ufile']['name'];

/*operations*/
$img_id = insert_in_database($filename);
create_image($uploadfile,$img_id,100,100,'thumb/');
create_image($uploadfile,$img_id,800,800,'fitsize/');
store_original_file($uploadfile,$img_id,'original/');

echo"<br /><a href=\"./dexter.php\">GO BACK</a>";



}
?>
