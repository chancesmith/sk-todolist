
<?php

$punchcard = $_Require['punchcard']

    
        function SaveCardToDatabase($punchcard)
        (
$con = mysql_connect("localhost","betterj1_chance","wcsadmin");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("betterj1_smoothie1", $con);

$sql="INSERT INTO punchcards (punchcard, name, punches)
VALUES
('$_POST[punchcard]','NULL','NULL')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
echo "punchcard added";
return ture;

mysql_close($con)
)

?>