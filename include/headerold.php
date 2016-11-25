<!DOCTYPE>
<html manifest="smoothieapp.manifest">
<head>
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
      <title><? echo $pagetitle; ?></title>
      <link rel="STYLESHEET" type="text/css" href="iphone.css" />
      
<script type="text/javascript" src="scripts/trial.js"></script>


<ul id="logo">
 <!--Logo -->
 <a href="login-home.php" >
 <img src="http://dl.dropbox.com/u/1068209/Smoothie%20King/SmoothieKing.jpg" width="60" height="37" alt="Smoothie King Logo"/>
 </a>
 </ul>

<div id="popupbox"> 
<form name="login" action="" method="post">
<center>Manager:</center>
<center><input name="username" size="14" /></center>
<center>Password:</center>
<center><input name="password" type="password" size="14" /></center>
<center><input type="submit" name="submit" value="login" /></center>
</form>
<br />
<center><a href="javascript:login('hide');">X</a></center> 
</div> 
 

 
<!--<input type="button" onclick="TINY.box.show({html:'Updates:</br>So far there are no updates to report in the update box.',animate:false,close:false,mask:false,boxid:'success',autohide:2,bottom:-4})" value="Show Updates (0)"/>--!>
 


<a href="javascript:login('show');">Login</a>
</head>
<body>
</body>
</html>