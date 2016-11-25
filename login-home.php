<?php

require("include/connections.php");


$resetbutton = 2;
if($resetbutton == 1 && $day == 1 || $day == 2 || $day == 3 || $day == 4 || $day == 5 || $day == 6 || $day == 7){
   //Show Reset Button(button will change "N == 2"
   }else if($resetbutton == 2 && $day == 5 || $day == 6 || $day == 7){
   //Change "N ==3"
   }else if($resetbutton == 3 && $day == 1 || $day == 2 || $day == 3 || $day == 4){
   //Change "N==1"
   }else{
   //echo "Don't know what happened?!";
   }

/*//Quized
if(isset($_POST['submittedquiz']))
{
	$employeein = $_POST['employeein'];
	$quizCheck = mysql_query("SELECT * FROM employee WHERE active='1' AND employee='$employeein' LIMIT 1");
	if($quizCheck['quized'] = 0)
	{
		
		
		mysql_query("
			UPDATE employee SET quized = '1'
			WHERE employee = '$employeein'
		");
	};
	$employeein = $_POST['employeein'];
	mysql_select_db("betterj1_smoothie", $con);
	mysql_query("UPDATE employee SET clock = '0'
	WHERE employee = '$employeein'");
};*/

//Clockin
if(isset($_POST['submittedin']))
{
	$employeein = $_POST['employeein'];
	//$quizCheck = mysql_query("SELECT * FROM employee WHERE active='1' AND employee='$employeein' LIMIT 1");
	//if($quizCheck['quized'] = 0)
//	{
		//header('Location: http://www.betterjoblanding.com/source/login-home.php#quiz');
	//}else{
		mysql_select_db("betterj1_smoothie", $con);
		mysql_query("UPDATE employee SET clock = '0'
		WHERE employee = '$employeein'");
//	};
};

//Clock out
if(isset($_POST['submittedout']))
{
	$employeeout = $_POST['employeeout'];
	mysql_query("
		UPDATE employee SET clock = '1'
		WHERE employee = '$employeeout'
	");
	mysql_query("UPDATE employee SET specialcleaning = '$specialdid' WHERE employee = '$person'");
};

//Special List
if(isset($_POST['submittedspecial']))
{
   $person = $_POST['employeespecial'];
   $item = $_POST['itemchecked'];
	mysql_query("
		UPDATE slist 
		SET completed = '1', who = '$person' 
		WHERE item = '$item'
	"); 
};

//Special Confirmed
if(isset($_POST['submittedspecialconfirm']))
{
	$personconfirmed = $_POST['employeeconfirmed'];
	$persondid = $_POST['employeedid'];
	//$items = (array) $_POST['itemconfirmed'];
	
	
	
	$item = $_POST['itemconfirmed'];
	if($persondid == $personconfirmed)
    {
    	echo "</br>You can not confirm your own item!";
    }else{
      //Grab employee's specials confirmed 
        $result14 = mysql_query("SELECT * FROM employee WHERE employee='$persondid'");
 
		while($row9 = mysql_fetch_array($result14))
			{
                $_SESSION['specialsconfirmed'] = $row9['specialsconfirmed'];
                $_SESSION['specialstotal'] = $row9['specialCleaningTotal'];
                $_SESSION['specialdone'] = $row9['specialCleaningTotal'];
			};

	$specialsconfirmed = $_SESSION['specialsconfirmed']+1;
	$specialempdid = $_SESSION['specialdone']+1;
	
	mysql_query
		("
			UPDATE slist SET confirmed = '1', 
			whoconfirmed = '$personconfirmed' 
			WHERE item = '$item'"
		);
	/*foreach($items as $item)
		{
	 		 mysql_query
	 		 	("
		 		 	UPDATE slist 
		 		 	SET confirmed = '1', whoconfirmed = '$personconfirmed'
		 		 	WHERE id = '$item'
	 		 	");*/
		}
	mysql_query
		("
			UPDATE employee 
			SET specialsconfirmed = '$specialsconfirmed', specialCleaningTotal = '$specialempdid' 
			WHERE employee = '$persondid'
		");
};


//Todo list
if(isset($_POST['submittedtodo']))
{
	$person = $_POST['employeedo'];
   
	$items = (array) $_POST['itemcheckedtodo'];
	foreach($items as $item){
 		 mysql_query("UPDATE todo SET complete = '1', whodone = '$person', whendone = NOW() WHERE id = '$item'");
	}
};

//Clock in and out
$result4 = mysql_query("SELECT * FROM employee WHERE clock= '0'");
$result5 = mysql_query("SELECT * FROM employee WHERE clock= '1'");
//Special List
$result6 = mysql_query("SELECT * FROM slist WHERE active = '1' AND completed='0' LIMIT 5");
$result7 = mysql_query("SELECT * FROM employee WHERE clock= '1'");
$result8 = mysql_query("SELECT * FROM slist WHERE active= '1' AND completed='1' AND confirmed='0'");
$result9 = mysql_query("SELECT * FROM employee WHERE clock= '1' AND management='1'");
//Show Completed  & Confirmed Special cleaning list
$specialsCompleteList = mysql_query("SELECT * FROM slist WHERE active= '1' AND completed='1' AND confirmed='1'");
//Checklist OPEN AND CLOSE (ToDo)
$result10 = mysql_query("SELECT * FROM todo WHERE complete='0' AND day='$today' ORDER BY whenby ASC LIMIT 6");
$result11 = mysql_query("SELECT * FROM employee WHERE clock= '1'");
//Show employees and special cleaning
$result12 = mysql_query("SELECT * FROM employee where management = '0'");
//Show employees and special cleaning
$result12_5 = mysql_query("SELECT * FROM employee where management = '0'");
//Show employees and special cleaning on Team page
$result12_55 = mysql_query("SELECT * FROM employee where management = '0' ORDER BY specialsconfirmed DESC");
//Show what employee has completed
$result13 = mysql_query("SELECT * FROM slist WHERE completed='1' AND active='1' ORDER BY when ASC");
//Collecting top Cleaner for Special Cleaning Header
$topTeamMember = mysql_query("SELECT * FROM employee WHERE active='1' ORDER BY specialsconfirmed DESC LIMIT 1");
//Getting Phone numbers for Contact Page
$result_contact = mysql_query("SELECT * FROM employee WHERE active= '1'");
?>

<!DOCTYPE html> 
<html> 
	<head> 
		<meta charset="utf-8" />
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
		<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
    	<meta name="apple-mobile-web-app-capable" content="yes" />
    	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
    	<link rel="apple-touch-icon" href="http://dl.dropbox.com/u/1068209/WCS%20PICS/skicon.png"/>
    	<link rel="apple-touch-startup-image" href="images/startup.png" />
  		<!--<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0rc2/jquery.mobile-1.0rc2.min.css" />
		<script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.0rc2/jquery.mobile-1.0rc2.min.js"></script>-->
		
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
		<!--<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
		<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>-->
		
		<link rel="stylesheet"  href="http://code.jquery.com/mobile/latest/jquery.mobile.css" /> 
  		<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script> 
  		<script src="http://code.jquery.com/mobile/latest/jquery.mobile.min.js"></script>
	</head> 
	
	<body> 
		<!-- Start of ToDo Page -->
		<div data-role="page" id="todo">

			<div data-role="header">
				<?php /*include ('include/header3.php');*/ ?>
			</div><!-- /header -->

			<div data-role="content" data-fullscreen="true" data-theme="a">	
				<?php require("todo.php") ?>
			</div><!-- /content -->

			<div data-role="footer" data-position="fixed">
				<?php include ('include/footer.php'); ?>
			</div><!-- /footer -->
		</div><!-- /ToDo page -->


		<!-- Start of SPECIAL page -->
		<div data-role="page" id="special">

			<div data-role="header">
				<?php /*include ('include/header2.php');*/ ?>
			</div><!-- /header -->
		
			<div data-role="navbar">
				<ul>
					<li><a href="#special">Special</a></li>
					<li><a href="#confirm">Confirm</a></li>
					<li><a href="#complete">Complete</a></li>
				</ul>
			</div><!-- /navbar -->

			<div data-role="content" data-theme="a">	
				
				<?php
				while($row6 = mysql_fetch_assoc($topTeamMember))
				{ 
					// item and when it is do by (array)
	 				echo "<ul data-role=\"listview\" data-inset=\"true\">
							<li data-role=\"list-divider\"><h5>Top Team Member so far:</h5></li>
							<li><h3>{$row6['employee']}</h3><span class=\"ui-li-count ui-btn-up-c ui-btn-corner-all\">{$row6['specialsconfirmed']}</span></li>
						</ul>
					";
	  			};
				?>
				<form method="post" data-ajax="false" action="login-home.php" id="submittedspecial" >
				<?php
 				while($row3 = mysql_fetch_assoc($result6))
	 			{ 
					// where and item of Special CleanUp
	  				echo "
	  				<fieldset data-role=\"controlgroup\">
	  				<input type='checkbox' data-theme=\"e\" name='itemchecked' id='itemchecked' value=\"{$row3['item']}\">
	  				<label for=\"itemchecked\"><strong> Item:</strong> &nbsp;" . $row3['item'] . "&nbsp; (" . $row3['where'] . ")</label>
	  				<input type='hidden' name='submittedspecial' id='submittedspecial' value=\"{$row3['item']}\">
	  				</fieldset>";
	  				};
				while($row4 = mysql_fetch_assoc($result7))
  				{ 
					// Employee that is in, complete item
					echo "
					<input type=\"submit\" data-theme=\"b\" name=\"employeespecial\" id=\"employeespecial\" value=\"{$row4['employee']}\">";
        		} 
        		?>
				</form> 
			</div><!-- /content -->

			<div data-role="footer" data-position="fixed">
				<?php include ('include/footer.php'); ?>
			</div><!-- /second footer -->
		</div><!-- /second page -->

		<!-- Start of CONFIRM page -->
		<div data-role="page" id="confirm">

			<div data-role="header">
				<?php /*include ('include/header2.php');*/ ?>
			</div><!-- /header -->

			<div data-role="navbar">
				<ul>
					<li><a href="#special"  data-direction="reverse">Special</a></li>
					<li><a href="#confirm">Confirm</a></li>
					<li><a href="#complete">Complete</a></li>
				</ul>
			</div><!-- /navbar -->

			<div data-role="content">	
				<?php require("confirmspecial.php");?>
			</div><!-- /content -->

			<div data-role="footer" data-position="fixed">
				<?php include ('include/footer.php'); ?>
			</div><!-- /footer -->
	
	
		</div><!-- / Special Confirm page -->

		<!-- Start of Specials Complete page -->
		<div data-role="page" id="complete">

			<div data-role="header">
				<?php /*include ('include/header2.php');*/ ?>
			</div><!-- /header -->

			<div data-role="navbar">
				<ul>
					<li><a href="#special" data-direction="reverse">Special</a></li>
					<li><a href="#confirm" data-direction="reverse">Confirm</a></li>
					<li><a href="#complete">Complete</a></li>
				</ul>
			</div><!-- /navbar -->

			<div data-role="content">	
				<?php require("specialscomplete.php");?>
			</div><!-- /content -->

			<div data-role="footer" data-position="fixed">
				<?php include ('include/footer.php'); ?>
			</div><!-- /footer -->
		</div><!-- / Specials Complete page -->

		<!-- Start of EMPLOYEE SUMMARY page -->
			<div data-role="page" id="employee">

			<div data-role="header">
				<?php /*include ('include/header3.php');*/ ?>
			</div><!-- /header -->
	
			<div data-role="navbar">
				<ul>
					<li><a href="#employee" class="ui-btn-active">Summary</a></li>
					<li><a href="#clock">Clock</a></li>
				</ul>
			</div><!-- /navbar -->
	
			<div data-role="content" data-theme="a">
				<?php
					while($row8 = mysql_fetch_assoc($result12_55))
  					{ 
						// Clock In employee that is out
						echo "
						<ul data-role=\"listview\" data-inset=\"true\">
							<li data-role=\"list-divider\"><h3>{$row8['employee']}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$row8['phone']}</h3></li>
							<li>Team Culture Score:<span class=\"ui-li-count ui-btn-up-c ui-btn-corner-all\">100%</span></li>
							<li>Cleaned this Week<span class=\"ui-li-count ui-btn-up-c ui-btn-corner-all\">{$row8['specialsconfirmed']}</span></li>
							<li>Total Cleaned<span class=\"ui-li-count ui-btn-up-c ui-btn-corner-all\">{$row8['specialCleaningTotal']}</span></li>
							<li data-theme=\"d\">Last Month</li>
							<li>Enhancers:<span class=\"ui-li-count ui-btn-up-c ui-btn-corner-all\">{$row8['enhancer']}%</span></li>
							<li>Mendiums:<span class=\"ui-li-count ui-btn-up-c ui-btn-corner-all\">{$row8['medium']}%</span></li>
							<li>Retail:<span class=\"ui-li-count ui-btn-up-c ui-btn-corner-all\">{$row8['retail']}%</span></li>
						</ul>
						";
        			};
    			?>
			</div><!-- /content -->

			<div data-role="footer" data-position="fixed">
				<?php include ('include/footer.php'); ?>
			</div><!-- /thirdfooter -->
	
		</div><!-- /Employee Summary page -->

		<!-- Start of CLOCK page -->
		<div data-role="page" id="clock">

			<div data-role="header">
				<?php /*include ('include/header3.php');*/ ?>
			</div><!-- /header -->
	
			<div data-role="navbar">
				<ul>
					<li><a href="#employee" data-direction="reverse">Summary</a></li>
					<li><a href="#clock" class="ui-btn-active">Clock</a></li>
				</ul>
			</div><!-- /navbar -->
	
			<div data-role="content" data-theme="a">
				<p><b>Click your name to Sign In or Out.</b></p>
					<form method="post" data-ajax="false" action="login-home.php#clock">
					<input type='hidden' name='submittedin' id='submittedin' value='0'/>
  					<? 
  						while($row2 = mysql_fetch_assoc($result5))
  						{ 
							// Clock Out employee that is IN
							echo "<span style=\"padding-left:4px;\"\">
							<input type=\"submit\" data-role=\"button\" data-theme=\"b\" data-icon=\"delete\" name=\"employeein\" id=\"employeein\" value=\"{$row2['employee']}\">";
        				} 
        			?>
					</form> 

					<form method="post" data-ajax="false" action="login-home.php#clock" data-transition="slideup">  
					<input type='hidden' name='submittedout' id='submittedout' value='1'/>
  					<?php 
  						while($row1 = mysql_fetch_assoc($result4))
  						{ 
							// Clock IN employee that is OUT
							echo "<span ><span style=\"padding-left:4px;\"\">
							<input type=\"submit\" data-role=\"button\" data-theme=\"a\" data-icon=\"arrow-l\" name=\"employeeout\" id=\"employeeout\" value=\"{$row1['employee']}\" />";
       					}
       				?>
					</form>
					
			</div><!-- /content -->

			<div data-role="footer" data-position="fixed">
				<?php include ('include/footer.php'); ?>
			</div><!-- /thirdfooter -->
	
		</div><!-- /CLOCK page -->

		<!-- Start of CONTACT page -->
		<div data-role="page" id="contact">

			<div data-role="header">
				<?php /*include ('include/header3.php');*/ ?>
			</div><!-- /header -->
	
			<div data-role="navbar">
				<ul>
					<li><a href="#employee" data-direction="reverse">Summary</a></li>
					<li><a href="#clock" data-direction="reverse">Clock</a></li>
					<li><a href="#contact"class="ui-btn-active">Phone#</a></li>
				</ul>
			</div><!-- /navbar -->
	
			<div data-role="content" data-theme="a">
				<?php
						echo "<ul data-role=\"listview\" data-inset=\"true\">
								<li data-role=\"list-divider\"><h5>Team Contact:</h5></li>";
						while($row8 = mysql_fetch_assoc($result_contact))
  						{ 
							// Employee Name and Phone
							echo "
								<li>{$row8['employee']}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {$row8['phone']}</li>
							";
        
        				};
        				echo "</ul>";
    			?>
			</div><!-- /content -->

			<div data-role="footer" data-position="fixed">
				<?php include ('include/footer.php'); ?>
			</div><!-- /thirdfooter -->
	
		</div><!-- /CONTACT page -->
		
		<!-- Start of QUIZ page -->
		<div data-role="page" id="quiz">

			<div data-role="content" data-theme="a">
				<?php
						
    			?>
			</div><!-- /content -->
	
		</div><!-- /QUIZ page -->

	</body>
</html>