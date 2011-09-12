<?php
session_start();
?>
<?php
require_once("allglobals.php");
require_once("get_the_id.php");
require_once("get_the_odds.php");
require_once("match_the_user.php");
require_once("go.php");
?>

<?php
$conn_start_up=mysqli_connect($mysqli_host,$mysqli_username,$mysqli_password,$central_db);
?>

<?php
//call the go function on click at start
go();


mysqli_close($conn_start_up);
?>