<?PHP

$pagetitle = "PunchCard Home";
include ('include/header.php');


//Ending Login Crap
$con = mysql_connect("localhost","betterj1_chance","wcsadmin");
mysql_select_db("betterj1_smoothie", $con);

//Getting Day first
$day = date("D");
if($day == Mon){
   $today = 1;
   $todayshow = Monday;
   }else if($day == Tue){
   $today = 2;
   $todayshow = Tuesday;
   }else if($day == Wed){
   $today = 3;
   $todayshow = Wednesday;
   }else if($day == Thu){
   $today = 4;
   $todayshow = Thursday;
   }else if($day == Fri){
   $today = 5;
   $todayshow = Friday;
   }else if($day == Sat){
   $today = 6;
   $todayshow = Saturday;
   }else if($day == Sun){
   $today = 7;
   $todayshow = Sunday;
   }else{
   echo "Don't know what happened?!";
   }
//Ending Got day

//Get Special Cleaning Done per person

//ending Get Special Cleaing Done per person







if(isset($_POST['submitted']))
{
if(empty($_POST['punchcard'])){
           echo 'Did not state punchcard account.  Go back!';
   }else{
     	$currentcard = 'Here is the last card:';
        $_SESSION['punchcard'] = $_POST['punchcard'];
	$punchcard = $_SESSION['punchcard'];
     	$_SESSION['employee'] = $_POST['employeechoice'];

    $sql1="INSERT INTO punchcards (time, punchcard, name, smoothies)
      VALUES
     (NOW(),'$punchcard','NoName','0')";

	if (!mysql_query($sql1,$con))
  	{
  	$_SESSION['punchcardstatus'] = "Card Found.";
  	}else{
  	$_SESSION['punchcardstatus'] = "New Card";
	echo $_SESSION['punchcardstatus'];
	};
        
        //Grab punches that are already on account#
        $result = mysql_query("SELECT * FROM punchcards Where punchcard= '$punchcard'");

         
          while($row = mysql_fetch_array($result))
              {
                $_SESSION['smoothies'] = $row['smoothies'];
              };
              
         //End: Grabbed current card punches on account#
     	
     	$punchcard = $_SESSION['punchcard'];
        $employee = $_SESSION['employee'];
	$oldpunches = $_SESSION['smoothies'];
	$punches = $_POST['punchestoadd'];
	$total = $punches + $oldpunches;

			if($total<0)
				{
				$total = 0;
				}else{
				echo "Added <b>$punches</b>::";
				}
	$_SESSION['newtotal'] = $total;
	$_SESSION['punchestoadd'] = $punches;
	$_SESSION['oldpunches'] = $oldpunches;
			

if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("betterj1_smoothie", $con);

mysql_query("INSERT INTO `punches`(`punchcard`, `smoothies`, `when`, `employee`) 
VALUES ('$punchcard','$punches',NOW(),'$employee')");

mysql_query("UPDATE punchcards SET smoothies = '$total'
WHERE punchcard = '$punchcard'");

$result3 = mysql_query("SELECT $punchcard FROM punchcards");


while($row = mysql_fetch_array($result3))
  { 
  echo "<td>" . $row['smoothies'] . "</td>";
  }
;

mysql_close($con);


echo "New total= <b>$total</b>";
echo "</br>";

//Keeping the same session vars you can go back and make changes to last account

  }
}else{
$currentcard = 'No card has been submitted yet.';
}
//Connect to server
$con = mysql_connect("localhost","betterj1_chance","wcsadmin");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("betterj1_smoothie", $con);
//Done with server details

//Reward
if(isset($_POST['reward']))
{

echo "Reward Success";
$_SESSION['oldpunches'] = $_POST['old'];
$reward = $_POST['reward'];
$employeerewarding = $_POST['employeerewarding'];
$total = $_POST['total'];
$total += $reward;
$punchcard = $_POST['punchcardrewarded'];
$_SESSION['employee'] = $employeerewarding;
$_SESSION['punchcard'] = $punchcard;
$_SESSION['newtotal'] = $total;
$_SESSION['punchestoadd'] = $reward;

echo "</br>";
echo $punchcard;
echo "</br>";
echo $reward;
echo "</br>";
echo $employeerewarding;
echo "</br>";
echo $total;

$con = mysql_connect("localhost","betterj1_chance","wcsadmin");
mysql_select_db("betterj1_smoothie", $con);
mysql_query("INSERT INTO `rewards`(`punchcard`, `when`, `size`, `employee`) 
VALUES ('$punchcard',NOW(),'$reward','$employeerewarding')");

mysql_query("UPDATE punchcards SET smoothies = '$total'
WHERE punchcard = '$punchcard'");
}

//Clockin
if(isset($_POST['submittedin']))
{
$employeein = $_POST['employeein'];
mysql_select_db("betterj1_smoothie", $con);
mysql_query("UPDATE employee SET clock = '0'
WHERE employee = '$employeein'");
};

//Clock out
if(isset($_POST['submittedout']))
{
$employeeout = $_POST['employeeout'];
mysql_query("UPDATE employee SET clock = '1'
WHERE employee = '$employeeout'");


mysql_query("UPDATE employee SET specialcleaning = '$specialdid' WHERE employee = '$person'");

};

//Special List
if(isset($_POST['submittedspecial']))
{
   $person = $_POST['employeespecial'];
   $item = $_POST['itemchecked'];
   
      //Grab employee's specials done 
        $result13 = mysql_query("SELECT * FROM employee WHERE employee = '$person'");
         
          while($row9 = mysql_fetch_array($result13))
              {
                $_SESSION['specialdone'] = $row9['specialcleaning'];
              };
   //End: Grabbed from employee's specials

$specialempdid = $_SESSION['specialdone']+1;


mysql_query("UPDATE slist SET completed = '1', who = '$person' WHERE item = '$item'"); 
mysql_query("UPDATE employee SET specialcleaning = '$specialempdid' WHERE employee = '$person'");
};


//Todo list
if(isset($_POST['submittedtodo']))
{
   $person = $_POST['employeedo'];
   $item = $_POST['itemcheckedtodo'];
   
   
mysql_query("UPDATE todo SET complete = '1', whodone = '$person', whendone = NOW() WHERE item = '$item'"); 
};


//Punchcard Trans
$result2 = mysql_query("SELECT * FROM employee WHERE clock= '1'");
//Clock in and out
$result4 = mysql_query("SELECT * FROM employee WHERE clock= '0'");
$result5 = mysql_query("SELECT * FROM employee WHERE clock= '1'");
//Special List
$result6 = mysql_query("SELECT * FROM slist WHERE active = '1' AND completed='0' LIMIT 5");
$result7 = mysql_query("SELECT * FROM employee WHERE clock= '1'");
//Reward
$result8 = mysql_query("SELECT * FROM punchcards WHERE punchcard= '$punchcard'");
$result9 = mysql_query("SELECT * FROM employee WHERE clock= '1'");
//Checklist OPEN AND CLOSE (ToDo)
$result10 = mysql_query("SELECT * FROM todo WHERE complete='0' AND day='$today' ORDER BY whenby ASC LIMIT 3");
$result11 = mysql_query("SELECT * FROM employee WHERE clock= '1'");
//Show employees and special cleaning
$result12 = mysql_query("SELECT * FROM employee where management = '0'");
//Show what employee has completed
$result13 = mysql_query("SELECT * FROM slist WHERE completed='1' AND active='1' ORDER BY when ASC");



?>







<!DOCTYPE >
<html>
<head>
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
      <title><?$pagetitle?></title>
      <link rel="STYLESHEET" type="text/css" href="iphone.css">

<!-- Start iPhone -->
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<link rel="apple-touch-icon" href="/iphone.png" />
<link media="only screen and (max-device-width: 480px)" href="/iphone.css" type= "text/css" rel="stylesheet" />
<!-- End iPhone -->

<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
    <meta name="apple-mobile-web-app-capable" content="yes" />

    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <link rel="apple-touch-icon" href="http://dl.dropbox.com/u/1068209/WCS%20PICS/wcsicon.png"/>

    <link rel="apple-touch-startup-image" href="images/startup.png" />
    <link rel="stylesheet" href="iphone.css" type="text/css" media="screen, mobile" title="main" charset="utf-8">
 

<style type="text/css"> 
#in,#out { display:none; }
</style> 
<script type="text/javascript"> 
function showform(theform) { 
  var showHides = new Array('in','out'); 
  for (i=0;i<showHides.length;i++) { 
 document.getElementById(showHides[i]).style.display= 
 (document.getElementById(showHides[i]).id==theform)?'block':'none'; 
  } 
} 

function jumpScroll() {
   	window.scroll(0,500); // horizontal and vertical scroll targets
}

function loadBehaviors () { 
  if (document.getElementById) { 
    document.getElementById('switch0').onclick = function() { showform(''); } 
  document.getElementById('switch1').onclick = function() { showform('in'); } 
  document.getElementById('switch2').onclick = function() { showform('out'); } 
  } 
} 
window.onload=function() { loadBehaviors(); } 
</script> 





<script type="text/javascript" src="scripts/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function() {

	//When page loads...
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content

	//On Click Event
	$("ul.tabs li").click(function() {

		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});

});
</script>





</head>








<body>

<div id="wrap">

   <div id="main" class="clearfix">

<!-- Puncard Account Code Start 
<form action='login-home.php' method='post' accept-charset='UTF-8'>
<fieldset class="form">

<input type='hidden' name='submitted' id='submitted' value='1'/>

    <label for='punchcard' >Punchcard*:</label><br/>
    <input type='tel' class="textarea" name='punchcard' id='punchcard' maxlength="6"/><br/>
    
    Punches:<span style="padding-left:4px"><span id="rounded-border-value"></span>
    <span style="padding-left:4px">
    <input type="range" class="range" name="punchestoadd" onchange="changeRounded(event)" value="1" max="9" min="-9" id="punchestoadd">

    <script>
     function changeRounded() {
              var el = document.getElementById('rounded-example');

              var borderVal = document.getElementById('punchestoadd').value;
              document.getElementById('rounded-border-value').innerHTML = borderVal;
            }

    </script>


Employee</br> <? while($row = mysql_fetch_array($result2))
  { 
	// Print Employees that are Clocked In
	 
	echo "<span ><span style=\"padding-left:4px;\"\"><input type=\"submit\" class=\"submit\" name=\"employeechoice\" id=\"employeechoice\" value=\"{$row['employee']}\" />";
        
        
	
   } ?>
   
</fieldset>
</form>
-->
<!--ending wrap-->
</div>


<ul class="tabs">
    
    <li><a href="#tab1">ToDo</a></li>
    <li><a href="#tab3">Special</a></li>
    <li><a href="#tab2">Clock</a></li>
    <li><a href="#tab5">M/I</a></li>
    
</ul>

<div class="tab_container">
    
    <!--New Tab1-->
<div id="tab1" class="tab_content">
       <!--Content1 Todo-->
<div id="wrap">

<div class="clockin">
<form method="post" action="login-home.php" id="submittedtodo" >
<? 
echo "This is the list for $todayshow </br>";
 while($row6 = mysql_fetch_assoc($result10))
	 { 
	// item and when it is do by (array)
	  echo "<input type='radio' name='itemcheckedtodo' id='itemcheckedtodo' value=\"{$row6['item']}\">
	   <strong> Item:</strong> &nbsp;" . $row6['item'] . "&nbsp; (" . $row6['whenby'] . ") &nbsp;
	 &nbsp;<input type='hidden' name='submittedtodo' id='submittedtodo' value=\"{$row6['item']}\">";
         echo "</br>";
         echo "____________________________________________________";
	  };
while($row7 = mysql_fetch_assoc($result11))
  { 
	// Employee Clocked In to do the Todo list
	echo "
	<input type=\"submit\" class=\"employee-in\" name=\"employeedo\" id=\"employeedo\" value=\"{$row7['employee']}\">";
        
        } ?>
</form>

</div>
</div>
</div>
<!--End Content1--><!--end wrap-->
    
    
    
    
    
    
<div id="tab2" class="tab_content">
       <!--Content2 Clock INOUT-->

<div id="wrap">
<div class="clockin">

<form method="post" action="" id="determinator"> 
<p><input type="radio" name="switch" id="switch0" checked>  
  <label for="switch1">Hide Clock IN/OUT</label></p> 
<p><input type="radio" name="switch" id="switch1">  
  <label for="switch1">Clock IN</label></p> 
<p><input type="radio" name="switch" id="switch2"> 
  <label for="switch2">Clock OUT</label></p> 
</form>
</br>
<span style="padding-left:4px">
</br> 
<form method="post" action="login-home.php" id="in"> 
 <p><label for="text1"></label> 
<input type='hidden' name='submittedout' id='submittedout' value='1'/>

  <? while($row1 = mysql_fetch_assoc($result4))
  { 
	// Clock out employee that is In
	echo "<span ><span style=\"padding-left:4px;\"\">
	<input type=\"submit\" class=\"employee-out\" name=\"employeeout\" id=\"employeeout\" value=\"{$row1['employee']}\" />";
        } ?>
</form> 


<form method="post" action="login-home.php" id="out"> 
 <p><label for="text2"></label> 
<input type='hidden' name='submittedin' id='submittedin' value='0'/>
  <? 
  while($row2 = mysql_fetch_assoc($result5))
  { 
	// Clock In employee that is out
	echo "<span style=\"padding-left:4px;\"\">
	<input type=\"submit\" class=\"employee-in\" name=\"employeein\" id=\"employeein\" value=\"{$row2['employee']}\">";
        } ?>
</form> 
</div>
</div>
</div>


<div id="tab3" class="tab_content">
       <!--Content3 SPECIAL CLEANING-->

<div id="wrap">
<div class="clockin">
<form method="post" action="login-home.php" id="submittedspecial" >
<? 
echo "Everyone needs to do 5: Due Sunday</br>";
 while($row3 = mysql_fetch_assoc($result6))
	 { 
	// where and item
	  echo "<input type='radio' name='itemchecked' id='itemchecked' value=\"{$row3['item']}\">
	   <strong> Item:</strong> &nbsp;" . $row3['item'] . "&nbsp; (" . $row3['where'] . ") &nbsp;
	 &nbsp;<input type='hidden' name='submittedspecial' id='submittedspecial' value=\"{$row3['item']}\">";
         echo "</br>";
         echo "____________________________________________________";
	  };
while($row4 = mysql_fetch_assoc($result7))
  { 
	// Clock In employee that is out
	echo "
	<input type=\"submit\" class=\"employee-in\" name=\"employeespecial\" id=\"employeespecial\" value=\"{$row4['employee']}\">";
        
        } ?>
</form> 

<?php

echo "__ ____ ____ ____ _____";

while($row8 = mysql_fetch_assoc($result12))
  { 
	// Clock In employee that is out
	echo "</br>{$row8['employee']}, has done: {$row8['specialcleaning']} ";
        
        }
        
echo "<table width=\"20%\" border=\"1\" cellpadding=\"1\">";
	while($row1= mysql_fetch_array($result13))
	  { 
	  echo "<tr>";
	  echo "<td> Item: &nbsp;" . $row1['item'] . "</td>&nbsp;&nbsp;";
	  echo "<td> Done by: &nbsp;" . $row1['who'] . "</td>&nbsp;&nbsp;";
	  echo "</tr>";
	  };
	echo "</table>";
        
?>

</div>
</div>
<!--End Content3--><!--end wrap-->


</div>

<!--New Tab5-->
<div id="tab5" class="tab_content">
       <!--Content5-->
<div id="wrap">

<p>Coming Soon!</p>



</div>
</div>
<!--End Content4--><!--end wrap-->

<!--New Tab4-->
<div id="tab4" class="tab_content">
       <!--Content4-->
<div id="wrap">

<?php

echo $currentcard;
echo "</br> Card: #";
echo $_SESSION['punchcard'];
echo "</br>";
echo "</br>Punches on card: ";
echo $_SESSION['oldpunches'];
echo "</br>";
echo "</br>Punches added: ";
echo $_SESSION['punchestoadd'];
echo "</br>";
echo "</br> Employee: ";
echo $_SESSION['employee'];
echo "</br>";
echo "</br> New Total on Card: ";
echo $_SESSION['newtotal'];

if($total > 8)
{
$employee = $_SESSION['employee'];
echo "</br>";
echo "Choose Reward";
echo "</br>";
echo $employee;
echo "<form action=\"login-home.php\" method=\"post\">";
if($total > 17)
  { 
  
	echo "</br><input type=\"radio\" name=\"reward\" id=\"reward\" value=\"-9\" />Free Small";
        echo "</br>";
	echo "</br><input type=\"radio\" name=\"reward\" id=\"reward\" value=\"-14\" />Free Medium";
        echo "</br>";
        echo "</br><input type=\"radio\" name=\"reward\" id=\"reward\" value=\"-18\" />Free Large";
        echo "</br>";

   }else if($total > 13) 
   {
   		echo "</br><input type=\"radio\" name=\"reward\" id=\"reward\" value=\"-9\" />Free Small";
        	echo "</br>";
		echo "</br><input type=\"radio\" name=\"reward\" id=\"reward\" value=\"-14\" />Free Medium";
        	echo "</br>";
        	
   }else if($total > 8) 
   {
   		echo "</br><input type=\"radio\" name=\"reward\" id=\"reward\" value=\"-9\" />Free Small";
        	echo "</br>";
 }
 while($row5 = mysql_fetch_assoc($result9))
  { 
	// Clock In employee that is out
	echo "
	<input type=\"submit\" class=\"employee-in\" name=\"employeerewarding\" id=\"employeerewarding\" value=\"{$row5['employee']}\">";
	
	}
 
}

?>
<input type='hidden' name='old' id='old' value="<?php echo $_SESSION['newtotal']; ?>">
<input type='hidden' name='total' id='total' value="<?php echo $_SESSION['newtotal']; ?>">
<input type='hidden' name='punchcardrewarded' id='punchcardrewarded' value="<?php echo $_SESSION['punchcard'];?>">
</form>



</div>
</div>
<!--End Content4--><!--end wrap-->




</div>
</div>
</div>
</div>

</body>



</html>



<?PHP

include ('include/footer.php');

mysql_close($con);
?>
