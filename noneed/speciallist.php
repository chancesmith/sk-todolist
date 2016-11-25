<?PHP

$pagetitle = "Special Cleaning";
include ('include/header.php');

//connect to server
$con = mysql_connect("localhost","betterj1_chance","wcsadmin");

if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
	mysql_select_db("betterj1_smoothie", $con);
	
	$result = mysql_query("SELECT * FROM slist WHERE active='1'");

	echo "<table width=\"500\" border=\"1\" cellpadding=\"10\">";
	while($row = mysql_fetch_array($result))
	  { 
	  echo "<tr>";
	  echo "<col width=25><td> Where: &nbsp;" . $row['where'] . "</td>&nbsp;&nbsp;";
	  echo "<col width=75%><td> Item: &nbsp;" . $row['item'] . "</td>&nbsp;&nbsp;";
	  echo "</tr>";
	  };
	echo "</table>";
?>

<!DOCTYPE>
<html>
<head>
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
</head>

<body>
<div id="wrap">
<form method="post" action="login-home.php" id="out"> 
 <p><label for="text2"></label> 
<input type='hidden' name='submittedin' id='submittedin' value='0'/>
  <? while($row3 = mysql_fetch_array($result5))
  { 
	// Clock In employee that is out
	echo "<span ><span style=\"padding-left:4px;\"\"><input type=\"submit\" class=\"employee-in\" name=\"employeein\" id=\"employeein\" value=\"{$row2['employee']}\" />";
   } ?>
</form>
<!-- end the warp -->
</div>
<div id="bottom_fade"></div>
	
</body>

</html>



<?PHP

include ('include/footer.php');

mysql_close($con);
?>