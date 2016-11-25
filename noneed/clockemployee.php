<?PHP
require_once("./include/membersite_config.php");

if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("login.php");
    exit;
}

$pid = $_POST['pid'];
$clock = $_POST['clock'];


$con = mysql_connect("localhost","betterj1_chance","wcsadmin");

if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("betterj1_smoothie", $con);

mysql_query("UPDATE employee SET clock = '$clock'
WHERE id = '$pid'");

echo "Activity Change Successful";

$result = mysql_query("SELECT * FROM employee WHERE id='$pid'");


while($row = mysql_fetch_array($result))
  { 
  echo "</br></br> PID#&nbsp;&nbsp;&nbsp;<b>" . $row['id'] . "</b></br>";
  echo "Name- &nbsp;<b>" . $row['employee'] . "</b></br>";
  echo " Active?-&nbsp;<b>" . $row['active'] . "</b>&nbsp;&nbsp;&nbsp;(Yes=1 No=0)</br>";
  echo " Clocked?-&nbsp;<b>" . $row['clock'] . "</b>&nbsp;&nbsp;&nbsp;(In=1 Out=0)";
  }
;

mysql_close($con);





?>