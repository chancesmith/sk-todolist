<?PHP
require_once("./include/membersite_config.php");

if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("login.php");
    exit;
}

require_once("./include/punchcards_config.php");



if(isset($_POST['submitted']))
{
   if($fgmembersite->Login())
   {
        $fgmembersite->RedirectToURL("punches.php");
   }
        

}

include ('include/header.php')

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
      <title>Find Punchcard</title>
      <link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css" />
      
</head>
<body>

<!-- Puncard Account Code Start -->
<div id='punchcardaccount'>
<form id='findpunchcard' action='run_punchcard.php' method='post' accept-charset='UTF-8'>
<fieldset >
<legend>Find Card</legend>

<input type='hidden' name='submitted' id='submitted' value='1'/>

<div class='short_explanation'>* required fields</div>


<div class='container'>
    <label for='punchcard' >Punchcard*:</label><br/>
    <input type='text' name='punchcard' id='punchcard' maxlength="6" /><br/>
</div>

<div class='container'>
    <input type='submit' name='Submit' value='Submit' />
</div>

</fieldset>
</form>
<!-- client-side Form Validations:
Uses the excellent form validation script from JavaScript-coder.com-->



</div>

</div>

<!-- Puncard Account Create Form -->

<div id='punchcardaccount'>
<form id='findpunchcard' action='run_punchcard.php' method='post' accept-charset='UTF-8'>
<fieldset >
<legend>Add Card to Database</legend>

<input type='hidden' name='submitted' id='submitted' value='1'/>

<div class='short_explanation'>* required fields</div>


<div class='container'>
    <label for='punchcard' >Punchcard*:</label><br/>
    <input type='text' name='punchcard' id='punchcard' maxlength="6" /><br/>
</div>

<div class='container'>
    <input type='submit' name='Submit' value='Submit' />
</div>

</fieldset>
</form>
<!-- client-side Form Validations:
Uses the excellent form validation script from JavaScript-coder.com-->



</div>

</div>


</body>
</html>