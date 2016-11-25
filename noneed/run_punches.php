<?PHP
require_once("./include/membersite_config.php");

if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("login.php");
    exit;
}

$employee = $_SESSION['employee'];
$punchcard = $_SESSION['punchcard'];
$oldpunches = $_SESSION['smoothies'];
$punches = $_POST['punchesamount'];
$total = $punches + $oldpunches;

$_SESSION['newtotal'] = $total;

if($total<0)
	{
	$total = 0;
	}else{
	echo "Adding <b>$punches</b> punche/s</br>";
	}
echo "by: '.$employee.' </br>";

$con = mysql_connect("localhost","betterj1_chance","wcsadmin");

if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("betterj1_smoothie", $con);

mysql_query("INSERT INTO `punches`(`punchcard`, `smoothies`, `when`, `employee`) 
VALUES ('$punchcard','$punches',NOW(),'$employee')");

mysql_query("UPDATE punchcards SET smoothies = '$total'
WHERE punchcard = '$punchcard'");



echo "...with success";

echo "</br>";

$result = mysql_query("SELECT $punchcard FROM punchcards");


while($row = mysql_fetch_array($result))
  { 
  echo "<td>" . $row['smoothies'] . "</td>";
  }
;

mysql_close($con);


echo "</br>New total= <b>$total</b> punches";
echo "</br>";
echo "</br>";

//Keeping the same session vars you can go back and make changes to last account
echo "<a href=\"pickemployee.php\">
<img src=\"http://dl.dropbox.com/u/1068209/WebApp/buttons/Go%20Back.jpg\"
height=\"5%\" width=\"5.5%\"> </a>";

if($total>8)
	{
	echo "<a href=\"reward.php\">
	<img src=\"http://dl.dropbox.com/u/1068209/WebApp/buttons/Reward%20button.jpg\"
	height=\"5%\" width=\"5.5%\"> </a>";
	echo "<a href=\"login-home.php\">
	<img src=\"http://dl.dropbox.com/u/1068209/WebApp/buttons/ButtonClear.gif\"
	height=\"5%\" width=\"5.5%\"> </a>";
	}else{
	echo "<a href=\"login-home.php\">
	<img src=\"http://dl.dropbox.com/u/1068209/WebApp/buttons/ButtonClear.gif\"
	height=\"5%\" width=\"5.5%\"> </a>";
	}


include ('login-home.php')



?>