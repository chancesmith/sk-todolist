
<form method="post" data-ajax="false" action="login-home.php#confirm" id="submittedspecialconfirm" >
<?php
	while($row4 = mysql_fetch_assoc($result8))
	{ 
		// where and item to confirm
		echo "
			<fieldset data-role=\"controlgroup\">
			<input type='checkbox' data-theme=\"d\" name='itemconfirmed' id='itemconfirmed' value=\"{$row4['item']}\">
				<label for=\"itemconfirmed\"><strong>Item:</strong> &nbsp;" . $row4['item'] . "&nbsp; (" . $row4['who'] . ") &nbsp; &nbsp;
					<input type='hidden' name='submittedspecialconfirm' id='submittedspecialconfirm' value=\"{$row4['item']}\">
				</label>
			</fieldset>
			<input type='hidden' name='employeedid' id='employeedid' value=\"{$row4['who']}\">";
	};
	while($row4 = mysql_fetch_assoc($result9))
	{ 
		// Employee that is in, confirm the Special CleanUp
		echo "
			<input type=\"submit\" data-theme=\"b\" name=\"employeeconfirmed\" id=\"employeeconfirmed\" value=\"{$row4['employee']}\">";
        }; 
?>
</form>	