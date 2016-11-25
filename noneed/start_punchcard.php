<?PHP
require_once("./include/membersite_config.php");

if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("login.php");
    exit;
}


$day = date("Y-M-d H:m:s");
$punchcard = $_POST[punchcard];

$con = mysql_connect("localhost","betterj1_chance","wcsadmin");

if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("betterj1_smoothie", $con);

$sql="INSERT INTO punchcards (time, punchcard, name, smoothies)
VALUES
(NOW(),'$punchcard','NoName','0')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
echo "punchcard added";


$result = mysql_query("SELECT * FROM punchcards WHERE punchcard=$punchcard");


while($row = mysql_fetch_array($result))
  { 
  echo "</br> Card# " . $row['punchcard'] . "</br>";
  echo " TimeDate- " . $row['time'] . "</br>";
  
  echo " Name- " . $row['name'] . "</br>";
  echo " Punches- " . $row['smoothies'] . "</br>";
  echo $day;
  }
;

mysql_close($con)






?>