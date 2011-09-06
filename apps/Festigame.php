<?php

class Festigame
{
protected $vari;
public function __construct() {
$this->vari = "100a";
}

public function __toString() {
  return "The value of $vari is : " . $this->vari;
}
}

//echo (new Festigame());

$rpath = "";
include("fb.php");

print_r($facebook->api("/me/friends"));

$arr["from"] = $user["id"];
$arr["to"] = "100000566828426";
$arr["message"] = "hello!";
$facebook->post($arr);
?>