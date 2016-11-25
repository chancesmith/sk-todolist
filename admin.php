<?php
require("include/connections.php");


//Add Employee
if(isset($_POST['addThisEmployee']))
{
   $employee = $_POST['addThisEmployee'];
   
   mysql_query
   	("
		INSERT INTO employee (employee)
		VALUES('$employee');
	");
};

//Edit Employee
if(isset($_POST['editemployee']))
{
   $id = $_POST['id'];
   $employee = $_POST['employee'];
   $phone = $_POST['phone'];
   $management = $_POST['management'];
   $active = $_POST['active'];
   $enhancer = $_POST['enhancer'];
   $medium = $_POST['medium'];
   $retail = $_POST['retail'];
   
   mysql_query
   	("
		UPDATE employee 
		SET employee
		AND phone = '$phone'
		AND management = '$management'
		AND active = '$active'
		AND enhacer = '$enhancer'
		AND medium = '$medium'
		AND retail = '$retail'
		WHERE id = '$id'
	");
};

//Remove Employee
if(isset($_POST['deleteThisEmployee']))
{
	$employeeremove = $_POST['id'];
	
	mysql_query
	("
		DELETE FROM employee 
		WHERE id = '$employeeremove' 
		LIMIT 1"
	);
};

//Show Employee Info
$showEmployees = mysql_query("SELECT * FROM employee");
//Remove Employee
$removeEmployee = mysql_query("SELECT * FROM employee");
//Items left on Special
$resultspecialcount = mysql_query("SELECT * FROM slist WHERE active='1' AND complete= '0'");
$num_rows_special = mysql_num_rows($resultspecialcount);
//Items left on ToDo
$resulttodocount = mysql_query("SELECT * FROM todo WHERE day='$today' AND complete= '0'");
$num_rows_todo = mysql_num_rows($resulttodocount);
?>


<!DOCTYPE html> 
<html> 
	<head> 
		<title>Admin Panel</title> 
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
     	<title><?$pagetitle?></title>
		<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
    	<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="apple-mobile-web-app-status-bar-style" content="black" />
    	<link rel="apple-touch-icon" href="http://dl.dropbox.com/u/1068209/WCS%20PICS/wcsicon.png"/>
		<link rel="apple-touch-startup-image" href="images/startup.png" />
   		<!-- <link rel="stylesheet" href="iphone.css" type="text/css" media="screen, mobile" title="main" charset="utf-8">  -->
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- <link rel="stylesheet" href="css/themes/jqtemp.css" />
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0rc2/jquery.mobile.structure-1.0rc2.min.css" /> 
		<script src="http://code.jquery.com/jquery-1.6.4.min.js"></script> 
		<script src="http://code.jquery.com/mobile/1.0rc2/jquery.mobile-1.0rc2.min.js"></script>-->
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0rc2/jquery.mobile-1.0rc2.min.css" />
		<script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.0rc2/jquery.mobile-1.0rc2.min.js"></script>
	</head>
	
	<body>
		<!-- Start of first page -->
		<div data-role="page" id="admin_main">

			<div data-role="header">
				<?php /*include ('include/headeradmin.php');*/ ?>
			</div><!-- /header -->
	
			<div data-role="navbar">
				<?php require('include/adminnav.php'); ?>
			</div><!-- /navbar -->

			<div data-role="content">	
				<ul data-role="listview" data-inset="true">
					<li data-role="list-divider">App Updates Coming</li>
					<li>Create Employee Page (CRUD)</li>
					<li>Create Todo Page (CRUD)</li>
					<li>Create Special Page (CRUD)</li>
					<li>Create Weekly Reset Button</li>
				</ul>	
			</div><!-- /content -->

			<div data-role="footer">
				
			</div><!-- /footer -->
		</div><!-- /page -->

		<!-- Start of Admin Employee page -->
		<div data-role="page" id="admin_employee">

			<div data-role="header">
				<?php /*include ('include/headeradmin.php');*/ ?>
			</div><!-- /header -->
			
			<div data-role="navbar">
				<?php require('include/adminnav.php'); ?>
			</div><!-- /navbar -->
		
			<div data-role="navbar">
				<ul>
					<li><a href="#admin_employee" class="ui-btn-active">All</a></li>
					<li><a href="#create">Create</a></li>
					<li><a href="#remove">Remove</a></li>
				</ul>
			</div><!-- /navbar -->

			<div data-role="content">
				<?php
				echo "<table width=\"500\" border=\"1\" cellpadding=\"4\">";
				while($row = mysql_fetch_array($showEmployees))
  				{ 
  					echo "
	  					<div data-role=\"collapsible\" data-mini=\"true\" data-content-theme=\"c\">
   							<h3>{$row['employee']}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$row['phone']}</h3>
   							<p>
	   							<form action='admin.php' method='post' accept-charset='UTF-8' id='editemployee' >
								    <div data-role=\"fieldcontain\">
									    <input type='hidden' name='employeeid' id='employeeid' value='{$row['id']}'/>
									    <label for='employee' >Name:</label>
									    	<input type='text' name='employee' id='employee' value='{$row['employee']}'/><br/>
									    <label for='phone' >Phone#:</label>
									    	<input type='text' name='phone' id='phone' value='{$row['phone']}'/><br />
									    <label for='management' >Management: {$row['management']}</label>
									    	<select name=\"management\" id=\"management\" data-role=\"none\">
												<option value=\"0\">No</option>
												<option value=\"1\">Yes</option>
											</select><br />
										<label for='active' >Active: {$row['active']}</label>
									    	<select name=\"active\" id=\"active\" data-role=\"none\">
												<option value=\"1\">Yes</option>
												<option value=\"0\">No</option>
											</select><br />
										<label for='ehancer' >Enhancer%:</label>
									    	<input type='text' name='enhancer' id='enhancer' value='{$row['enhancer']}'/><br />
									    <label for='medium' >Medium%:</label>
									    	<input type='text' name='medium' id='medium' value='{$row['medium']}'/><br />
									    <label for='retail' >Retail%:</label>
									    	<input type='text' name='retail' id='retail' value='{$row['retail']}'/><br />
										<input type='submit' name=\"Submit\" value='Submit {$row['employee']}' />
								    </div>
								</form>
								<form action='admin.php' method='post' accept-charset='UTF-8'>
									<div data-role=\"fieldcontain\">
										<label for='deleteThisEmployee' ><h1>Delete:</h1></label>
										<input type='hidden' name='deleteThisEmployee' id='deleteThisEmployee' value='{$row['id']}'/>
										
									</div>
									<input type=\"submit\" data-theme=\"a\" name=\"deleteEmployee\" id=\"deleteEmployee\" value=\"{$row['employee']}\">
								</form>
   							</p>
						</div>
					";
				};
				echo "</table>";
				?>
			</div><!-- /content -->

			<div data-role="footer">
				<h4>Page Footer</h4>
			</div><!-- /footer -->
		</div><!-- / Employee Main page -->

		<!-- / Employee Create/Edit page -->
		<div data-role="page" id="create">

			<div data-role="header">
				<?php /*include ('include/headeradmin.php');*/ ?>
			</div><!-- /header -->
		
			<div data-role="navbar">
				<?php require('include/adminnav.php'); ?>
			</div><!-- /navbar -->
		
			<div data-role="navbar">
				<ul>
					<li><a href="#admin_employee">All</a></li>
					<li><a href="#create" class="ui-btn-active">Create/Edit</a></li>
					<li><a href="#remove">Remove</a></li>
				</ul>
			</div><!-- /navbar -->
		
			<div data-role="content">
		
				<h3>What do you want to do?</h3>
	
	
				<!-- Create Employee Code Start -->
				<form action='admin.php#create' method='post' accept-charset='UTF-8' id='addemployee' >
					<p>Create Employee</p>
				    <label for='addThisEmployee' >Employee#*: (First Name Last Inital) Ex: Bill F</label><br/>
				    <input type='text' name='addThisEmployee' id='addThisEmployee'  /><br/>
				    <input type='submit' name='Submit' value='Submit' />
				</form>
			
			</div><!-- /content -->
			
				<div data-role="footer">
					<h4>Page Footer</h4>
				</div><!-- /footer -->
		</div><!-- / Employee Create/Edit page -->
		
		<!--  Remove Employee page -->
		<div data-role="page" id="remove">

			<div data-role="header">
				<?php /*include ('include/headeradmin.php');*/ ?>
			</div><!-- /header -->
		
			<div data-role="navbar">
				<?php require('include/adminnav.php'); ?>
			</div><!-- /navbar -->
		
			<div data-role="navbar">
				<ul>
					<li><a href="#admin_employee">All</a></li>
					<li><a href="#create">Create/Edit</a></li>
					<li><a href="#remove" class="ui-btn-active">Remove</a></li>
				</ul>
			</div><!-- /navbar -->
		
			<div data-role="content">
		
				<h3>Who to delete? (There is no looking back)</h3>
				<?php
				echo "<table width=\"500\" border=\"1\" cellpadding=\"4\">";
  				while($row = mysql_fetch_array($removeEmployee))
  				{ 
  					echo "
	  					<div data-role=\"collapsible\" data-mini=\"true\" data-content-theme=\"c\">
   							<h3>{$row['employee']}</h3>
   							<p>
								<form action='admin.php#remove' method='post' accept-charset='UTF-8'>
									<div data-role=\"fieldcontain\">
										<label for='deleteThisEmployee' ><h1>Delete:</h1></label>
										<input type='hidden' name='deleteThisEmployee' id='deleteThisEmployee' value='{$row['id']}'/>
										<input type=\"submit\" data-theme=\"a\" name=\"submit\" id=\"deleteEmployee\" value=\"{$row['employee']}\">
									</div>
								</form>
   							</p>
						</div>
					";
				};
				echo "</table>";
				?>
	
				<!-- Remove Employee Code Start -->
				
			
			</div><!-- /content -->
			
				<div data-role="footer">
					<h4>Page Footer</h4>
				</div><!-- /footer -->
		</div><!-- / Remove Employee page -->
	</body>
</html>