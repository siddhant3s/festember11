<?php


include("../fb.php");
include("../reqconnect.php");

$sql="SELECT * FROM game_info WHERE playerid = '".$user[id]."'";

$result = mysql_query($sql);

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
  echo "<td>" . $row['money'] . "</td>";
  echo "</tr>";
  }
echo "</table>";

//mysql_close($con);
?>