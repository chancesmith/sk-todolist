<?php
	$smoothies = array('small','med','large');
	$medium = 'medium';
	$large = 'large';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style>
button{
	width: 30px;
}
.name{
	width: 150px;
	float:left;	
}
.total{
	width: 50px;
	color: red;	
	float: left;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js#"></script>
<script>
	$(document).ready(function() {
		function doChange(id,action){
			var no = parseInt($('#' + id).html());
			if(action == 'add'){
			  no += 1;
			}else if(no > 0){
			  no -= 1;		
			}
			$('#' + id).html(no);
		}
        $("button").click(function(){
			var id = $(this).siblings(".total").attr('name');
			var action = $(this).attr('class');
			doChange(id,action);
		});
    });
</script>
</head>

<body>
<?php



foreach($smoothies as $id => $name){
  echo "<div><div class=\"name\">$name</div><div class=\"total\" id=\"$id\" name=\"$id\">0</div><button class=\"add\">+</button><button class=\"take\">-</button></div>";	
}
echo $name;


?>
</body>
</html>