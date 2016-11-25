<?PHP
require_once("./include/membersite_config.php");

if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("login.php");
    exit;
}
//get all vars
$_SESSION['reward'] = $_POST['reward'];
$reward = $_SESSION['reward'];
$employee = $_SESSION['employee'];
$punchcard = $_SESSION['punchcard'];
$punches = $_SESSION['punches'];
$total = $_SESSION['newtotal'] + $reward;



if ($total<0)
	{
	$total = 0;
	}

$_SESSION['newtotal'] = $total;


//connect to server
$con = mysql_connect("localhost","betterj1_chance","wcsadmin");

if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("betterj1_smoothie", $con);
//connected to server

echo "Reward Success";
echo "by: '.$employee.' </br>";


mysql_query("INSERT INTO `rewards`(`punchcard`, `when`, `size`, `employee`) 
VALUES ('$punchcard',NOW(),'$reward','$employee')");

mysql_query("UPDATE punchcards SET smoothies = '$total'
WHERE punchcard = '$punchcard'");



echo "...with success";

echo "</br>";

mysql_close($con);


echo "</br>New total= <b>$total</b> punches";
echo "</br>";
echo "</br>";

//Keeping the same session vars you can go back and make changes to last account
echo "<a href=\"pickemployee.php\">
<img src=\"http://dl.dropbox.com/u/1068209/WebApp/buttons/Go%20Back.jpg\"
height=\"5%\" width=\"5.5%\"> </a>";

if($punches>8)
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

