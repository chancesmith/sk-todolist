<?PHP
require_once("./include/membersite_config.php");

if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("login.php");
    exit;
}
//claim punchcard
$punchcard = $_SESSION['punchcard'];

//claim employee chosen
$_SESSION['employee'] = $_POST['employee'];


include ('include/header.php');
$con = mysql_connect("localhost","betterj1_chance","wcsadmin");

if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("betterj1_smoothie", $con);

$result = mysql_query("SELECT * FROM punchcards Where punchcard= '$punchcard'");

echo "<table width=\"500\" border=\"1\" cellpadding=\"10\">";
while($row = mysql_fetch_array($result))
  { 
  echo "<tr>";
  echo "<td> Punchcard#&nbsp;&nbsp;" . $row['punchcard'] . "</td>";
  echo "<td> Punches Total# &nbsp;" . $row['smoothies'] . "</td>&nbsp;&nbsp;";
        $_SESSION['smoothies'] = $row['smoothies'];
  echo "</tr>";
  };
echo "</table>";


mysql_close($con);








?>

<html>
<head>
<title>Punches</title>
</head>

<body>
<h4>Adding Punches to Card</h4>
<form action="run_punches.php" method="post"> 

<select name="punchesamount"> 
<option>0</option> 
<option>1</option>
<option>2</option>
<option>3</option>
<option>4</option>
<option>5</option>
<option>6</option>
<option>7</option>
<option>8</option>
<option>9</option>
</select>

</ br> 
<input name="submit" type="submit" Value="Submit Total"/>
</form>

<h4 style="color:#FF0000">Removing Punches to Card</h4>
<form action="run_punches.php" method="post"> 

<select name="punchesamount"> 
<option>0</option> 
<option>-1</option>
<option>-2</option>
<option>-3</option>
<option>-4</option>
<option>-5</option>
<option>-6</option>
<option>-7</option>
<option>-8</option>
<option>-9</option>
</select>

</ br> 
<input name="submit" type="submit" Value="Remove"/>
</form>



</body></html>



