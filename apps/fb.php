<?php

require_once $rpath . "facebook/src/facebook.php";
include_once $rpath . "../facebook_details.php";//should contain app_id and app_secrete
$fbuser=$facebook->getUser();
$fbperm=array();
$fbperm['scope'] = "email,publish_stream";

global $user;
$user = $facebook->api("/me");

if(!$user) {
    $fbloginurl=$facebook->getLoginUrl($fbperm);
    header("Location: " . $fbloginurl);
}

?>