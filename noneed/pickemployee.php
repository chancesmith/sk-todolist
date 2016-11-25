<?PHP
require_once("./include/membersite_config.php");

if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("login.php");
    exit;
}
//collect card
if(empty($_POST['punchcard'])){
           echo 'Did not state punchcard account.  Go back!';
   }else{
     $_SESSION['punchcard'] = $_POST['punchcard'];
     $punchcard = $_SESSION['punchcard'];
};

//server connect
$con = mysql_connect("localhost","betterj1_chance","wcsadmin");

if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("betterj1_smoothie", $con);
//server is now connected


$sql="INSERT INTO punchcards (time, punchcard, name, smoothies)
VALUES
(NOW(),'$punchcard','NoName','0')";

	if (!mysql_query($sql,$con))
  	{
  	echo mysql_error();
  	}else{
	echo "Punchcard Added";
	};


//header
include ('include/header.php');

$result2 = mysql_query("SELECT * FROM employee WHERE clock= '1'");


//pick employee that is active and clocked-in
echo "Employee";
echo "<form action=\"run_punchcard.php\" method=\"post\">";
while($row = mysql_fetch_array($result2))
  { 
	// Print Employees that are Clocked In
	 
	echo "</br><input type=\"radio\" name=\"employee\" id=\"employee\" value=\"{$row['employee']}\" />" . $row['employee'];
        echo "</br>"; 
        
	
   }
echo "</br>";
echo "<input name=\"submit\" type=\"submit\" Value=\"Choose\"/>";
mysql_close($con);

?>



