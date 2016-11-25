<?PHP
$pagetitle = "Employees";

$con = mysql_connect("localhost","betterj1_chance","wcsadmin");

mysql_select_db("betterj1_smoothie", $con);


//Add Employee
if(isset($_POST['addemployee']))
{
   $person = $_POST['employee'];
   $phone = $_POST['phone'];
   mysql_query("INSERT INTO employee (employee, phone, active)
   		VALUES ('$employee','$phone','1')");
};

//Add Phone
if(isset($_POST['addemployeephone']))
{
   $person = $_POST['person'];
   $phone = $_POST['addemployeephone'];
   mysql_query("UPDATE employee SET phone='$phone' WHERE id='$person'");
};

//Money Evnelope
if(isset($_POST['submitedenvelope']))
{
   $person = $_POST['employeeenvelope'];
   $envelope = $_POST['submitedenvelope'];
  mysql_query("INSERT INTO money (envelope, who, when) VALUES ('$envelope', '$person', 'NOW()')");
};

//Money Evnelope
if(isset($_POST['submitedenvelope']))
{
   $person = $_POST['employeeenvelope'];
   $envelope = $_POST['submitedenvelope'];
  mysql_query("INSERT INTO money (envelope, who, when) VALUES ('$envelope', '$person', 'NOW()')");
};

//Money Evnelope
if(isset($_POST['submitedenvelope']))
{
   $person = $_POST['employeeenvelope'];
   $envelope = $_POST['submitedenvelope'];
  mysql_query("INSERT INTO money (envelope, who, when) VALUES ('$envelope', '$person', 'NOW()')");
};





$result = mysql_query("SELECT * FROM employee");
$result1 = mysql_query("SELECT * FROM employee");

echo "<table width=\"500\" border=\"1\" cellpadding=\"10\">";
while($row = mysql_fetch_array($result))
  { 
  echo "<tr>";
  echo "<td> PID#" . $row['id'] . "</td>&nbsp;&nbsp;";
  echo "<td> Name: &nbsp;" . $row['employee'] . "</td>&nbsp;&nbsp;";
  echo "<td> Phone: &nbsp;" . $row['phone'] . "</td>&nbsp;&nbsp;";
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

<!-- Create Employee Code Start -->
<form action='employee.php' method='post' accept-charset='UTF-8' id='addemployee' >
<fieldset >
<legend>Create Employee</legend>
<input type='hidden' name='submitted' id='submitted' value='1'/>
<div class='container'>
    <label for='employee' >Employee#*: (First Name Last Inital) Ex: Bill F</label><br/>
    <input type='text' name='employee' id='employee'  /><br/>
    <label for='phone' >Phone#*: (731)555-5555</label><br/>
    <input type='text' name='employeephone' id='employeephone'  /><br />
    <label for='management' >Management: 0= No 1= Yes</label><br/>
    <input type='text' name='management' id='management' value='0'/><br />
</div>
<div class='container'>
    <input type='submit' name='Submit' value='Submit' />
</div>
</fieldset>
</form>

<!-- Add or Edit Phone -->
<form action='employee.php' method='post' accept-charset='UTF-8' id='addphone' >
<fieldset >
<legend>Add or Edit Phone</legend>

<div class='container'>
    <label for='phone' >ID#:</label><br/>
    <input type="text" name="person" id="person" /> <br />
    <label for='phone' >Phone#*: (731)555-5555</label><br/>
    <input type='text' name='addemployeephone' id='addemployeephone'  /><br />
    
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

include ('include/footer.php');

mysql_close($con);
?>