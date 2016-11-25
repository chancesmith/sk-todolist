<form method="post" data-ajax="false" action="login-home.php" id="submittedtodo" >
	<fieldset data-role="controlgroup">
		<?php 
			echo "<ul data-role=\"listview\" data-inset=\"true\">
			<li data-role=\"list-divider\"><h3>ToDo List for $todayshow</h3></li>
				
				";
			while($row6 = mysql_fetch_assoc($result10))
			{ 
				
				// item and when it is do by (array)
	 			echo "<input type='checkbox' data-theme='d' name='itemcheckedtodo[]' id='item{$row6['id']}' value=\"{$row6['id']}\">
	  			<label for=\"item{$row6['id']}\"><strong>Item:</strong> &nbsp;" . $row6['item'] . "&nbsp; (" . $row6['whenby'] . ") &nbsp;
	 			&nbsp;</label><input type='hidden' name='submittedtodo' id='submittedtodo' value=\"{$row6['item']}\"><input type='hidden' name='itemoption$i' id='itemoption$i' value=\"$i\">";
         	
	  		};
	  		
	  		echo "</fieldset>";
	  		
			while($row7 = mysql_fetch_assoc($result11))
  			{ 
				// Employee Clocked In to do the Todo list
				echo "
				<input type=\"submit\" data-theme=\"b\" data-inline=\"true\" name=\"employeedo\" id=\"employeedo\" value=\"{$row7['employee']}\">";
        
        	} 
        ?>
</form>	