<?PHP

if(isset($_REQUEST['punchcard'])){
           $punchcard = $_REQUEST['punchcard'];
           
   }else{
      echo 'Do dice on the card';
}

include ('include/header.php');
echo "Current Card</br>#$punchcard";



$small = $_REQUEST['smallamount'];
$medium = $_REQUEST['mediumamount'];
$large = $_REQUEST['largeamount'];
$total = $small + $medium + $large

$con = mysql_connect("localhost","betterj1_chance","wcsadmin");
if ($con)
  {
  die('Could not connect: ' . mysql_error());
  }
  mysql_select_db("betterj1_smoothie", $con);;

$result = mysql_query("SELECT $punchcard FROM punchcards");
  

mysql_select_db("betterj1_smoothie", $con);;

mysql_query("UPDATE punchcards SET smoothies = '$total'
WHERE punchcard = 'punchcard'");

echo "punches added";


if($row = mysql_fetch_array($result))
  { 
  echo "<td>" . $row['smoothies'] . "</td>";

mysql_close($con);

echo "</br> Total on Card $currentpunches current punches";
}

?>

<html>
<head>
      <title>Total Punches</title>
</head>
<body>



<?php

?>


</body></html>
