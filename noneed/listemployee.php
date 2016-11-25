<?PHP
$pagetitle = "Employees";

$con = mysql_connect("localhost","betterj1_chance","wcsadmin");

if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("betterj1_smoothie", $con);


if(isset($_POST['addemployee']))
{
$employee = $_POST[employee];
$phone = $_POST[phone];
$sql="INSERT INTO employee (employee, active)
VALUES
('$employee','1')";


$result = mysql_query("SELECT * FROM employee WHERE employee='$employee'");


while($row = mysql_fetch_array($result))
  { 
  echo "</br> PID#" . $row['id'] . "</br>";
  echo "Name- " . $row['employee'] . "</br>";
  echo " Active?- " . $row['active'] . "(Yes=1 No=0)";
  };
}else{echo "nope";}





$result = mysql_query("SELECT * FROM employee");

echo "<table width=\"500\" border=\"1\" cellpadding=\"10\">";
while($row = mysql_fetch_array($result))
  { 
  echo "<tr>";
  echo "<td> PID#" . $row['id'] . "</td>&nbsp;&nbsp;";
  echo "<td> Name: &nbsp;" . $row['employee'] . "</td>&nbsp;&nbsp;";
  echo "<td> Active: &nbsp;" . $row['active'] . "</td>&nbsp;&nbsp;";
  echo "<td> Clocked In or Out: &nbsp;" . $row['clock'] . "</td>&nbsp;&nbsp;";
  echo "</tr>";
  };
echo "</table>";

?>

<!DOCTYPE>
<head>
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
      
      <link rel="STYLESHEET" type="text/css" href="iphone.css">
</head>
<body>

<div id="wrap">
<h3>What do you want to do?</h3>

<!-- Clock Employee Code Start -->
<form action='clockemployee.php' method='post' accept-charset='UTF-8'>
<fieldset >
<legend>Clock In/Out Employee</legend>

<input type='hidden' name='submitted' id='submitted' value='1'/>

<div class='container'>
    <label for='employee' >PID#*:</label><br/>
    <input type='text' name='pid' id='pid'  /><br/>
    <input type="radio" name="clock" value="1" /> In<br />
    <input type="radio" name="clock" value="0" /> Out
</div>

<div class='container'>
    <input type='submit' name='Submit' value='Submit' />
</div>

</fieldset>
</form>


<!-- Create Employee Code Start -->
<form action='listemployee.php' method='post' accept-charset='UTF-8'>
<fieldset >
<legend>Create Employee</legend>

<input type='hidden' name='addemployee' id='addemployee' value='1'/>


<div class='container'>
    <label for='punchcard' >Employee#*: (First Name Last Inital) Ex: Bill F</label><br/>
    <input type='text' name='employee' id='employee'  /><br/>
</div>
<div class='container'>
    <label for='punchcard' >Employee Phone*: (731)555-5555</label><br/>
    <input type='text' name='phone' id='phone'  /><br/>
</div>
<div class='container'>
    <input type='submit' name='Submit' value='Submit' />
</div>

</fieldset>
</form>

<!-- Remove Employee Code Start -->
<form action='removeemployee.php' method='post' accept-charset='UTF-8'>
<fieldset >
<legend>Remove Employee</legend>

<input type='hidden' name='submitted' id='submitted' value='1'/>


<div class='container'>
    <label for='punchcard' >PID#*:</label><br/>
    <input type='text' name='pid' id='pid' maxlength='2' /><br/>
</div>

<div class='container'>
    <input type='submit' name='Submit' value='Submit' />
</div>

</fieldset>
</form>

<!-- Activate/Inactivate Employee Code Start -->
<form action='aiemployee.php' method='post' accept-charset='UTF-8'>
<fieldset >
<legend>Activate/Inactivate Employee</legend>

<input type='hidden' name='submitted' id='submitted' value='1'/>


<div class='container'>
    <label for='punchcard' >PID#*:</label><br/>
    <input type='text' name='pid' id='pid'  /><br/>
    <input type="radio" name="active" value="0" /> Inactivate<br />
<input type="radio" name="active" value="1" /> Activate
</div>

<div class='container'>
    <input type='submit' name='Submit' value='Submit' />
</div>

</fieldset>
</form>

</div>
</div>

</div>



<div id="bottom_fade"></div>
	
</body>

</html>



<?PHP
mysql_close($con);
?>