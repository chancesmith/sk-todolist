<?PHP
$pagetitle = "Manage Special Cleaning List";
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

//Avtivate List
$activate = $_POST['active'];

//Add Item to list
$which = $_POST['newwhich'];
$item = $_POST['newitem'];
$where = $_POST['newwhere'];

//Show This List
$listchoice = $_POST['active'];

//Show This List
$deleteitem = $_POST['deleteitem'];

//End Var List

if(isset($_POST['activated']))
  {
  	//Set all list inactive
  	mysql_query("UPDATE slist SET active = '0'
	WHERE active = '1'");
	//Set this list active
  	mysql_query("UPDATE slist SET active = '1'
	WHERE which = '$listchoice'");

	echo "Activation Complete </ br>";
	
	}else{
	echo "None chosen to Activate.</ br>";
	};
	
if(isset($_POST['resetWeek']))
  {
  	
  	$selectedWeek=$_POST['resetWeek'];
  	
  	//Reset Active list of who and completed to NULL
  	mysql_query("UPDATE slist SET completed = '0', who = ''
	WHERE active = '$selectedWeek'");
	
	mysql_query("UPDATE slist SET confirmed = '0', whoconfirmed = ''
	WHERE which = '$selectedWeek'");
	
	mysql_query("UPDATE employee SET specialWeekTotal = '0'
	WHERE active = '1'");
	
	echo "Reset Complete";
	
	}else{
	echo "None chosen to Reset.";
	};
	
//Reset Confirmed Values on selected week
if(isset($_POST['clearConfirmeditems']))
  {
  	$selectedWeek=$_POST['resetConfirmedItemsChoice'];
  	
  	//Reset Active list of who and completed to NULL
  	mysql_query("UPDATE slist SET confirmed = '0', whoconfirmed = ''
	WHERE which = '$selectedWeek'");

	echo "**Reset Confirmed - Complete</ br>";
	
	}else{
	echo "None chosen to Reset.</br>";
	};
	
if(isset($_POST['resetemployee']))
  {
  	//Reset Active list of who and completed to NULL
  	mysql_query("UPDATE employee SET specialcleaning = '0', specialsconfirmed = '0'");

	echo "**Reset Employee Count - Complete</ br>";
	
	}else{
	echo "None chosen to Reset.</br>";
	};

if(isset($_POST['clearextra']))
  {
  	//Reset Active list of who and completed to NULL
  	mysql_query("DELETE FROM slist WHERE which = '6'");

	echo "**Clear Extra Complete</br>";
	
	}else{
	echo "None chosen to Clear.</br>";
	};
	
if(isset($_POST['deleteitem']))
  {
  	$deleteitem = $_POST['deleteitem'];
  	
  	//Reset Active list of who and completed to NULL
  	mysql_query("DELETE FROM slist WHERE id = '$deleteitem'");

	echo "**Delete ID Complete</ br>";
	
	}else{
	echo "None chosen to Delete.</ br>";
	};

if(isset($_POST['newlistitem']))
	{
	
	mysql_query("INSERT INTO `slist`(`id`, `where`, `item`, `which`, `active`) 
		VALUES (NULL,'$where','$item','$which','1')");

		
		echo "**Item added</ br>";
	
	}else {
	echo "No Item not added this time.</ br>";
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
<form action='managespeciallist.php' method='post' accept-charset='UTF-8'>
<fieldset >
<legend>Add List Item Here</legend>

<input type='hidden' name='newlistitem' id='newlistitem' value='1'/>


<div class='container'>
    <label for='slist' >List*: What list is this for?)</label><br/>
    <select name='newwhich' id='newwhich'>
  <option value="1" >First</option>
  <option value="2" >Second</option>
  <option value="3" >Third</option>
  <option value="4" >Fourth</option>
  <option value="5" >Corperate</option>
  <option value="6" selected="selected">Extra</option>
    </select>
    
    <br/><label for='slist' >Create Item: -New Cleaning List Item Goes Here</label><br/>
    <input type='text' name='newitem' id='newitem'  /><br/>
    
    <label for='slist' >Where*: </label><br/>
      <select name='newwhere' id='newwhere'>
        <option value="FOH" >FOH</option>
        <option value="BOH" selected="selected">BOH</option>
      </select>  
</div>
<div class='container'>
    <input type='submit' name='Submit' value='Submit' />
</div>
</fieldset>
</form>

<!-- Active List -->
<form action='managespeciallist.php' method='post' accept-charset='UTF-8'>
<fieldset >
<legend>Activeate List</legend>

<input type='hidden' name='activated' id='activated' value='1'/>


<div class='container'>
    <label for='slist' >List*:</label><br/>
    <select name='active' id='active'>
  <option value="1" selected="selected">First</option>
  <option value="2" >Second</option>
  <option value="3" >Third</option>
  <option value="4" >Fourth</option>
  <option value="5" >Corperate</option>
  <option value="6" >Extra</option>
    </select>
</div>
<div class='container'>
    <input type='submit' name='Submit' value='Activate' />
</div>
</fieldset>
</form>

<!-- Reset List -->
<form action='managespeciallist.php' method='post' accept-charset='UTF-8'>
<fieldset >
<legend>Reset List</legend>

<input type='hidden' name='reset' id='reset' value='1'/>


<div class='container'>
    <label for='slist' >List*:</label><br/>
    <select name='resetWeek' id='resetWeek'>
  <option value="1" selected="selected">First</option>
  <option value="2" >Second</option>
  <option value="3" >Third</option>
  <option value="4" >Fourth</option>
  <option value="5" >Corperate</option>
    </select>
</div>
<div class='container'>
    <input type='submit' name='Submit' value='Reset' />
</div>
</fieldset>
</form>

<!-- Reset List Employee Count-->
<form action='managespeciallist.php' method='post' accept-charset='UTF-8'>
<fieldset >
<legend>Reset Employee Count</legend>

<div class='container'>
    <label for='slist' >List*:</label><br/>
    <select name='resetemployee' id='resetemployee'>
  <option value="0" selected="selected">All</option>
    </select>
</div>
<div class='container'>
    <input type='submit' name='Submit' value='Reset' />
</div>
</fieldset>
</form>


<!-- Clear Out Extra List-->
<form action='managespeciallist.php' method='post' accept-charset='UTF-8'>
<fieldset >
<legend>Clear Extra List</legend>

<div class='container'>
    <label for='slist' >List*:</label><br/>
    <select name='clearextra' id='clearextra'>
  <option value="0" selected="selected">All</option>
    </select>
</div>
<div class='container'>
    <input type='submit' name='Submit' value='ClearList' />
</div>
</fieldset>
</form>

<!-- Delete Item from List-->
<form action='managespeciallist.php' method='post' accept-charset='UTF-8'>
<fieldset >
<legend>Delete ID</legend>

<div class='container'>
    <label for='slist' >ID*:</label><br/>
    <input type='text' name='deleteitem' id='deleteitem' />
</div>
<div class='container'>
    <input type='submit' name='Submit' value='DeleteID' />
</div>
</fieldset>
</form>
</ br>
<!-- Clear Confirmed Names and Item values off Special list-->
<form action='managespeciallist.php' method='post' accept-charset='UTF-8'>
<fieldset >
<legend>Clear Confirmed Values</legend>

<input type='hidden' name='clearConfirmeditems' id='clearConfirmeditems' value='1'/>


<div class='container'>
    <label for='slist' >List*:</label><br/>
    <select name='reset' id='resetConfirmedItemsChoice'>
  <option value="1" selected="selected">First</option>
  <option value="2" >Second</option>
  <option value="3" >Third</option>
  <option value="4" >Fourth</option>
  <option value="5" >Corperate</option>
  <option value="6" >Every Week List</option>
    </select>
</div>
<div class='container'>
    <input type='submit' name='Submit' value='Clear Confirmed Items' />
</div>
</fieldset>
</form>

</div>
</div>
</div>
</body>
</html>

<?	
	$result = mysql_query("SELECT * FROM slist WHERE active='1'");

	echo "<table width=\"100%\" border=\"1\" cellpadding=\"10\">";
	while($row = mysql_fetch_array($result))
	  { 
	  echo "<tr>";
	  echo "<td> #" . $row['id'] . "</td>&nbsp;&nbsp;";
	  echo "<td> Week: &nbsp;" . $row['which'] . "</td>&nbsp;&nbsp;";
	  echo "<td> Where: &nbsp;" . $row['where'] . "</td>&nbsp;&nbsp;";
	  echo "<td> Item: &nbsp;" . $row['item'] . "</td>&nbsp;&nbsp;";
	  echo "<td> Active: &nbsp;" . $row['active'] . "</td>&nbsp;&nbsp;";
	  echo "<td> Completed: &nbsp;" . $row['completed'] . "</td>&nbsp;&nbsp;";
	  echo "<td> Who: &nbsp;" . $row['who'] . "</td>&nbsp;&nbsp;";
	  echo "<td> Confirmed: &nbsp;" . $row['confirmed'] . "</td>&nbsp;&nbsp;";
	  echo "</tr>";
	  };
	echo "</table>";


mysql_close($con);



?>