<?PHP
require_once("./include/membersite_config.php");

if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("login.php");
    exit;
}

$con = mysql_connect("localhost","betterj1_chance","wcsadmin");

if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("betterj1_smoothie", $con);

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


mysql_close($con);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
      <title>Store Home</title>
      <link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css">
</head>
<body>
<div id='fg_membersite_content'>
Store# <?= $fgmembersite->UserFullName(); ?>!

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
<form action='addemployee.php' method='post' accept-charset='UTF-8'>
<fieldset >
<legend>Create Employee</legend>

<input type='hidden' name='submitted' id='submitted' value='1'/>


<div class='container'>
    <label for='punchcard' >Employee#*: (First Name Last Inital) Ex: Bill F</label><br/>
    <input type='text' name='employee' id='employee'  /><br/>
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
</body>
</html>