<?PHP
$pagetitle = "Manage ToDo";
include ('include/header.php');

//connect to server
$con = mysql_connect("localhost","betterj1_chance","wcsadmin");

if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("betterj1_smoothie", $con);

//found server

//Listing All Vars from each form submitted

//Day vars
$day = date("D");

echo $day;

if($day == Mon)
   {
	$today = 1;
   }else if($day == Tue){
   $today = 2;
   }else if($day == Wed){
   $today = 3;
   }else if($day == Thu){
   $today = 4;
   }else if($day == Fri){
   $today = 5;
   }else if($day == Sat){
   $today = 6;
   }else if($day == Sun){
   $today = 7;
   }else{
   echo "Don't know what happened?! We have no day.";
   }

//Add ToDo Item to list
$item = $_POST['newitem'];
$whenby = $_POST['newwhenby'];
$dayadd = $_POST['dayadd'];

//Remove ToDo Item to list
$removeitemid = $_POST['removeitemid'];

//Reset Day
$resetday = $_POST['resetday'];

//Reset Week
$resetweek = $_POST['resetweek'];

//Edit ToDo Item to list NOT DONE YET!!!!!!
$idedit = $_POST['idedit'];
$itemedit = $_POST['newitemedit'];
$whenbyedit = $_POST['newwhenbyedit'];
$dayaddedit = $_POST['dayaddedit'];

//Active Day
$activeday = $_POST['activeday'];

//Active NONE
$activenone = $_POST['activenone'];


//End Var List
	
if(isset($_POST['activeday']))
  {
  	//Set all list inactive
  	mysql_query("UPDATE todo SET active = '0'
	WHERE active = '1'");
	//Set this list active
  	mysql_query("UPDATE todo SET active = '1'
	WHERE day = '$activeday'");

	echo "Activation Day Complete";
	};

if(isset($_POST['activenone']))
  {
  	//Set all list Active, showing all week
  	mysql_query("UPDATE todo SET active = '0' WHERE active = '1'");

	echo "Activation Week Complete";
	}else{
	echo "No Week chosen to Activate.";
	};

if(isset($_POST['resetday']))
  {
  	//Reset Active list of who and completed to NULL
  	mysql_query("UPDATE todo SET complete = '0', whodone = 'None' WHERE day = '$resetday'");

	echo "Reset Day Complete";
	};
	
if(isset($_POST['resetweek']))
  {
  	//Reset Active list of who and completed to NULL
  	mysql_query("UPDATE todo SET complete = '0', whodone = 'NULL' WHERE complete = '1'");

	echo "Reset Week Complete";
	};
	
if(isset($_POST['newlistitem']))
	{
mysql_query
("INSERT INTO `todo`
(`item`, `whenby`, `day`) 
		VALUES ('$item','$whenby','$dayadd')");

		echo "<br/><br/>Item added";
	
	}else {
	echo "<br/><br/>No Item added this time.";
	};
	
if(isset($_POST['removeitemid']))
	{
	
	$removeitemid = $_POST['removeitemid'];
	echo $removeitemid . "</br>";
	mysql_query("DELETE FROM todo WHERE id='$removeitemid'");
	//DELETE FROM `betterj1_smoothie`.`todo` WHERE `todo`.`id` = 556

		
		echo "<br/><br/>Item Removed";
		};
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
      <title>Store Home</title>
      <link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css">
</head>
<body>

<h3>What do you want to do?</h3>

<!-- Add Item to List -->
<form action='managetodo.php' method='post' accept-charset='UTF-8'>
<fieldset >
<legend>Add List ToDo Item Here</legend>

<input type='hidden' name='newlistitem' id='newlistitem' value='1'/>


<div class='container'>
    
    <br/><label for='todo' >Create Item: -New ToDo List Item Goes Here</label><br/>
    <input type='text' name='newitem' id='newitem'  /><br/>
    
    <label for='todo' >When*: </label><br/>
      <select name='newwhenby' id='newwhenby'>
        <option value="7">07:00</option>
        <option value="8" >08:00</option>
        <option value="9" >09:00</option>
        <option value="10" >10:00</option>
        <option value="11" >11:00</option>
        <option value="12" >12:00</option>
        <option value="13" >13:00</option>
        <option value="14" >14:00</option>
        <option value="15" >15:00</option>
        <option value="16" >16:00</option>
        <option value="17" >17:00</option>
        <option value="18" >18:00</option>
        <option value="19" selected="selected">19:00</option>
        <option value="20" >20:00</option>
        <option value="21" >21:00</option>
        <option value="22" >22:00</option>
      </select>
      <label for='todo' >Day*: </label><br/>
      <select name='dayadd' id='dayadd'>
        <option value="7" selected="selected">Monday</option>
        <option value="2" >Tuesday</option>
        <option value="3" >Wednesday</option>
        <option value="4" >Thursday</option>
        <option value="5" >Friday</option>
        <option value="6" >Saturday</option>
        <option value="7" >Sunday</option>
      </select>  
</div>
<div class='container'>
    <input type='submit' name='Submit' value='Submit' />
</div>
</fieldset>
</form>

<!-- Active Day List -->
<form action='managetodo.php' method='post' accept-charset='UTF-8'>
<fieldset >
<legend>Activeate Day List</legend>

<input type='hidden' name='activatedday' id='activatedday' value='1'/>


<div class='container'>
    <label for='todo' >List*:</label><br/>
    <select name='activeday' id='activeday'>
  <option value="1" selected="selected">Monday</option>
  <option value="2" >Tuesday</option>
  <option value="3" >Wednesday</option>
  <option value="4" >Thursday</option>
  <option value="5" >Friday</option>
  <option value="6" >Saturday</option>
  <option value="7" >Sunday</option>
    </select>
</div>
<div class='container'>
    <input type='submit' name='Submit' value='Activate' />
</div>
</fieldset>
</form>

<!-- Active Week List -->
<form action='managetodo.php' method='post' accept-charset='UTF-8'>
<fieldset >
<legend>Deactiveate All Week</legend>


<div class='container'>
    <label for='todo' >List*:</label><br/>
    <select name='activenone' id='activenone'>
  <option value="0" selected="selected">Week</option>
    </select>
</div>
<div class='container'>
    <input type='submit' name='Submit' value='Kill ALL' />
</div>
</fieldset>
</form>


<!-- Reset List Day -->
<form action='managetodo.php' method='post' accept-charset='UTF-8'>
<fieldset >
<legend>Reset Day</legend>


<div class='container'>
    <label for='todo' >List*:</label><br/>
    <select name='resetday' id='resetday'>
  <option value="1" selected="selected">Monday</option>
  <option value="2" >Tuesday</option>
  <option value="3" >Wednesday</option>
  <option value="4" >Thursday</option>
  <option value="5" >Friday</option>
  <option value="5" >Saturday</option>
  <option value="5" >Sunday</option>
    </select>
</div>
<div class='container'>
    <input type='submit' name='Submit' value='Reset Day' />
</div>
</fieldset>
</form>

<!-- Reset List Week -->
<form action='managetodo.php' method='post' accept-charset='UTF-8'>
<fieldset >
<legend>Reset Week</legend>


<div class='container'>
    <label for='slist' >List*:</label><br/>
    <select name='resetweek' id='resetweek'>
  <option value="0" selected="selected">Week</option>
    </select>
</div>
<div class='container'>
    <input type='submit' name='Submit' value='Reset Week' />
</div>
</fieldset>
</form>

<!-- Remove Item -->
<form action='managetodo.php' method='post' accept-charset='UTF-8'>
<fieldset >
<legend>Remove Item: (Use ID)</legend>

<div class='container'>
    <label for='slist' >ID*:</label><br/>
    <input type='text' name='removeitemid' id='removeitemid'/>
</div>
<div class='container'>
    <input type='submit' name='Submit' value='Remove Item' />
</div>
</fieldset>
</form>

</div>
</div>
</div>
</body>
</html>

<?	
	$result = mysql_query("SELECT * FROM todo WHERE complete='0' AND day='$today' ORDER BY whenby ASC");
	$result1 = mysql_query("SELECT * FROM todo WHERE complete='1' AND day='$today' ORDER BY whenby ASC");

	echo "<table width=\"100%\" border=\"1\" cellpadding=\"10\">";
	while($row = mysql_fetch_array($result))
	  { 
	  echo "<tr>";
	  echo "<td> #" . $row['id'] . "</td>&nbsp;&nbsp;";
	  echo "<td> Item: &nbsp;" . $row['item'] . "</td>&nbsp;&nbsp;";
	  echo "<td> Hour: &nbsp;" . $row['whenby'] . "</td>&nbsp;&nbsp;";
	  echo "<td> Day: &nbsp;" . $row['day'] . "</td>&nbsp;&nbsp;";
	  echo "</tr>";
	  };
	echo "</table>";

	echo "<table width=\"100%\" border=\"1\" cellpadding=\"10\">";
	while($row1 = mysql_fetch_array($result1))
	  { 
	  echo "<tr>";
	  echo "<td> #" . $row1['id'] . "</td>&nbsp;&nbsp;";
	  echo "<td> Item: &nbsp;" . $row1['item'] . "</td>&nbsp;&nbsp;";
	  echo "<td> Hour: &nbsp;" . $row1['whenby'] . "</td>&nbsp;&nbsp;";
	  echo "<td> Day: &nbsp;" . $row1['day'] . "</td>&nbsp;&nbsp;";
	  echo "<td> Active: &nbsp;" . $row1['active'] . "</td>&nbsp;&nbsp;";
	  echo "<td> Completed: &nbsp;" . $row1['complete'] . "</td>&nbsp;&nbsp;";
	  echo "<td> Who: &nbsp;" . $row1['whodone'] . "</td>&nbsp;&nbsp;";
	  echo "<td> When: &nbsp;" . $row1['whendone'] . "</td>&nbsp;&nbsp;";
	  echo "<td> False: &nbsp;" . $row1['falseconfirm'] . "</td>&nbsp;&nbsp;";
	  echo "</tr>";
	  };
	echo "</table>";

mysql_close($con);



?>