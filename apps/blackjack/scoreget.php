<?php

$rpath="../";
include("../game.php");
include("../../connect.php");
$score=getCash();
$sql="SELECT playerid,gameid FROM game_info WHERE playerid = '".$user['id']."'";

$result = mysql_query($sql);
echo "user id is : ". $user_profile['id'];
echo "<table border='1'>
<tr>
<th>playerid</th>
<th>gameid</th>
<th>money</th>
</tr>";

while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['playerid'] . "</td>";
  echo "<td>" . $row['gameid'] . "</td>";
  echo "<td>" . $score . "</td>";
  echo "</tr>";
  }
echo "</table>";

//mysql_close($con);
?>