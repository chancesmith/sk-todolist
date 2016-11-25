<?PHP


$con = mysql_connect("localhost","betterj1_chance","wcsadmin");

if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("betterj1_smoothie", $con);

$result = mysql_query("SELECT * FROM punches");

echo "<table width=\"500\" border=\"1\" cellpadding=\"10\">";
while($row = mysql_fetch_array($result))
  { 
  echo "<tr>";
  echo "<td> ID#" . $row['id'] . "</td>&nbsp;&nbsp;";
  echo "<td> Punchcard: &nbsp;" . $row['punchcard'] . "</td>&nbsp;&nbsp;";
  echo "<td> Punches: &nbsp;" . $row['smoothies'] . "</td>&nbsp;&nbsp;";
  echo "<td> When: &nbsp;" . $row['when'] . "</td>&nbsp;&nbsp;";
  echo "<td> Who: &nbsp;" . $row['employee'] . "</td>&nbsp;&nbsp;";
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

<!-- Don't Know Yet -->
<form action='#' method='post' accept-charset='UTF-8'>
<fieldset >
<legend>Coming Soon</legend>

<input type='hidden' name='submitted' id='submitted' value='1'/>

<div class='container'>
    <label for='employee' >Thinkning:</label><br/>
    <input type='text' name='pid' id='pid'  /><br/>
    <input type="radio" name="clock" value="1" /> In<br />
    <input type="radio" name="clock" value="0" /> Out
</div>

<div class='container'>
    <input type='submit' name='Submit' value='nothing' />
</div>

</fieldset>
</form>


<!-- Don't Know Yet -->
<form action='#' method='post' accept-charset='UTF-8'>
<fieldset >
<legend>Coming Soon</legend>

<input type='hidden' name='submitted' id='submitted' value='1'/>


<div class='container'>
    <label for='punchcard' >Thinking...</label><br/>
    <input type='text' name='employee' id='employee'  /><br/>
</div>

<div class='container'>
    <input type='submit' name='Submit' value='nothing' />
</div>

</fieldset>
</form>



</div>
</div>
</div>
</body>
</html>