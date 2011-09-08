<?php

$rpath="../";
include("../fb.php");
include("../../connect.php");

$sql="SELECT * FROM game_info WHERE playerid = '".$user[id]."'";

$result = mysql_query($sql);


?>