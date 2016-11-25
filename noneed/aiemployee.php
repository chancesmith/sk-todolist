<?PHP


$pid = $_POST['pid'];
$active = $_POST['active'];


$con = mysql_connect("localhost","betterj1_chance","wcsadmin");

if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("betterj1_smoothie", $con);

mysql_query("UPDATE employee SET active = '$active'
WHERE id = '$pid'");

echo "Activity Change Successful";

$result = mysql_query("SELECT * FROM employee WHERE id='$pid'");


while($row = mysql_fetch_array($result))
  { 
  echo "</br></br> PID#&nbsp;&nbsp;&nbsp;<b>" . $row['id'] . "</b></br>";
  echo "Name- &nbsp;<b>" . $row['employee'] . "</b></br>";
  echo " Active?-&nbsp;<b>" . $row['active'] . "</b>&nbsp;&nbsp;&nbsp;&nbsp;(Yes=1 No=0)";
  
  }
;

mysql_close($con);





?>