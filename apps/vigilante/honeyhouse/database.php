<?php
require('../db_conn.php');
if(!(mysql_query('CREATE DATABASE `'.$DB_NAME.'`;';
	echo 'Error: '.mysql_error();
else echo 'Database created.';
?>
