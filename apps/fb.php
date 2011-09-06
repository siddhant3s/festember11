<?php
session_start();

require_once $rpath . "facebook/src/facebook.php";
include_once $rpath . "../facebook_details.php";//should contain app_id and app_secrete
$fbuser=$facebook->getUser();
$fbperm=array();
$fbperm['scope'] = "email,publish_stream";

$user = $facebook->api("/me");

?>