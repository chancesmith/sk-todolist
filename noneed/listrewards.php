<?PHP

$con = mysql_connect("localhost","betterj1_chance","wcsadmin");

if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("betterj1_smoothie", $con);

$result = mysql_query("SELECT * FROM rewards");

echo "<table width=\"500\" border=\"1\" cellpadding=\"10\">";
while($row = mysql_fetch_array($result))
  { 
  echo "<tr>";
  echo "<td> PID#" . $row['id'] . "</td>&nbsp;&nbsp;";
  echo "<td> Account: &nbsp;" . $row['punchcard'] . "</td>&nbsp;&nbsp;";
  echo "<td> Reward: &nbsp;" . $row['size'] . "</td>&nbsp;&nbsp;";
  echo "<td> When: &nbsp;" . $row['when'] . "</td>&nbsp;&nbsp;";
  echo "<td> Who: &nbsp;" . $row['employee'] . "</td>&nbsp;&nbsp;";
  echo "</tr>";
  };
echo "</table>";


mysql_close($con);

?>
