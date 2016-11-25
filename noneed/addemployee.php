<?PHP


$employee = $_POST[employee];

$con = mysql_connect("localhost","betterj1_chance","wcsadmin");

if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("betterj1_smoothie", $con);

$sql="INSERT INTO employee (employee, active)
VALUES
('$employee','1')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
echo "Employee added";


$result = mysql_query("SELECT * FROM employee WHERE employee='$employee'");


while($row = mysql_fetch_array($result))
  { 
  echo "</br> PID#" . $row['id'] . "</br>";
  echo "Name- " . $row['employee'] . "</br>";
  echo " Active?- " . $row['active'] . "(Yes=1 No=0)";
  
  }
;

mysql_close($con)






?>