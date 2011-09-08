<?php
$info=parse_ini_file("config.ini");
$c=mysql_connect($info['server'].':'.$info['port'],$info['username'],$info['password']);
$DB_NAME=$info['databasename'];
unset($info);
//require('../../connect.php');
?>
