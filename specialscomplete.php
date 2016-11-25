<?php
					while($row8 = mysql_fetch_assoc($specialsCompleteList))
  					{ 
						// Clock In employee that is out
						echo "
						<ul data-role=\"listview\" data-inset=\"true\">
							<li>{$row8['item']}({$row8['where']})</h3>
							<span class=\"ui-li-count ui-btn-up-c ui-btn-corner-all\">{$row8['who']}</span>
							</li>
						</ul>
						";
        			};
    			?>