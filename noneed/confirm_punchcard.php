<?PHP
require_once("./include/membersite_config.php");

if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("login.php");
    exit;
}

//Check Username
$SQL = mysql_query("SELECT punchcard from betterj1_smoothie WHERE punchcard = '$punchcard'");
 
if(mysql_num_rows($SQL) >= 1)
{
  //Create sql Statement Variable
$SQL = "INSERT INTO punchcard VALUES ('$punchcard','null','null')";
 echo ("Created new cutomer: ($punchcard, now recorded");


//Insert Entry
if (!mysql_query($SQL))
  {
  die('Error: ' . mysql_error());
  }else{







?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
      <title>Run PunchCard Account#</title>
      <link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css">
</head>
<body>
<div id='fg_membersite_content'>
<h2>Home Page</h2>
Store# <?= $fgmembersite->UserFullName(); ?>

<?php # - run_punchcard.php
$punchcard = $_REQUEST['account']

   echo '<p>This is how many punches this card has--></p>'

include ('punches.php')


?>


</div>
</body