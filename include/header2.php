<?php //connect tot server
$con = mysql_connect("localhost","betterj1_chance","wcsadmin");
mysql_select_db("betterj1_smoothie", $con);

$result13 = mysql_query("SELECT * FROM employee WHERE active='1' ORDER BY specialsconfirmed DESC LIMIT 1");
?>

<p>Top Team Member: 
<?php 

while($row6 = mysql_fetch_assoc($result13))
			{ 
				
				// item and when it is do by (array)
	 			echo $row6['employee'];
         	
	  		};
?></p>