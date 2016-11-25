<?PHP
require_once("./include/membersite_config.php");

if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("login.php");
    exit;
}
//collect card
     $punches = $_SESSION['newtotal'];

//server connect
$con = mysql_connect("localhost","betterj1_chance","wcsadmin");

if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("betterj1_smoothie", $con);
//server is now connected


//header
include ('include/header.php');

$result2 = mysql_query("SELECT * FROM punchcards WHERE punchcard= '$punchcard'");


//pick reward that applies the how many on account
echo "Choose Reward";
echo "<form action=\"reward-ed.php\" method=\"post\">";
if($punches > 17)
  { 
  
	echo "</br><input type=\"radio\" name=\"reward\" id=\"reward\" value=\"-9\" />Small";
        echo "</br>";
	echo "</br><input type=\"radio\" name=\"reward\" id=\"reward\" value=\"-14\" />Medium";
        echo "</br>";
        echo "</br><input type=\"radio\" name=\"reward\" id=\"reward\" value=\"-18\" />Large";
        echo "</br>";

   }else if($punches > 13) 
   {
   		echo "</br><input type=\"radio\" name=\"reward\" id=\"reward\" value=\"-9\" />Small";
        	echo "</br>";
		echo "</br><input type=\"radio\" name=\"reward\" id=\"reward\" value=\"-14\" />Medium";
        	echo "</br>";
        	
   }else if($punches > 8) 
   {
   		echo "</br><input type=\"radio\" name=\"reward\" id=\"reward\" value=\"-9\" />Small";
        	echo "</br>";
}
   
   
   
   
   
   
echo "</br>";
echo "<input name=\"submit\" type=\"submit\" Value=\"Choose\"/>";


//need to put into punches the changes made
//my redirect to run_punches.php?
//jscript reminder in to reward-ed.php then include (login-home.php)



mysql_close($con);

?>


