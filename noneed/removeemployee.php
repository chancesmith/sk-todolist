<?PHP


$pid = $_POST['pid'];
$active = 0;

$con = mysql_connect("localhost","betterj1_chance","wcsadmin");

if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("betterj1_smoothie", $con);

mysql_query("SELECT employee WHERE id = '$pid' AND active = '0'");
mysql_query("DELETE FROM employee WHERE id = '$pid' AND active = '0' LIMIT 1");

echo "Deletion Successful";


mysql_close($con);





?>