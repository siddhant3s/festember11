<?php

require_once $rpath . "facebook/src/facebook.php";
include_once $rpath . "../facebook_details.php";//should contain app_id and app_secrete
$fbuser=$facebook->getUser();
$fbperm=array();
$fbperm['scope'] = "email,publish_stream";

global $user;

try {
$user = $facebook->api("/me");

}
catch (FacebookApiException $e) {


//this code has been taken from pages/logout.php... including the file directly doesn't work... need to find a way around it
session_destroy();
if (isset($_SERVER['HTTP_COOKIE'])) {
  $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
  foreach($cookies as $cookie) {
    $parts = explode('=', $cookie);
    $name = trim($parts[0]);
    setcookie($name, '', time()-1000);
    setcookie($name, '', time()-1000, '/');
  }
}

header("Location: ../");
die();
}

//if(!$user) {
    $fbloginurl=$facebook->getLoginUrl($fbperm);
    header("Location: " . $fbloginurl);
//}

?>