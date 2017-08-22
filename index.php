<?php
session_start();
$set = false;
if((!empty($_SESSION['security_code']) && !empty($_POST['security_code'])) && ($_SESSION['security_code'] == $_POST['security_code'])) {
  unset($_SESSION['security_code']);
} else if(isset($_POST['submit'])){
	// Insert your code for showing an error message here
  $set = true;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Scriptings - Paste Tool</title>
<link rel="stylesheet" type="text/css" href="http://yourwebsite.com/style1.css" /></head>

<body>
<div align="center">
<pre>
  _________            .__        __  .__                      
 /   _____/ ___________|__|______/  |_|__| ____    ____  ______
 \_____  \_/ ___\_  __ \  \____ \   __\  |/    \  / ___\/  ___/
 /        \  \___|  | \/  |  |_> >  | |  |   |  \/ /_/  >___ \ 
/_______  /\___  >__|  |__|   __/|__| |__|___|  /\___  /____  >
        \/     \/         |__|                \//_____/     \/ </pre>
</div>
<div align="left">
<form action="search.php" method="post">
<p align="right">
<a style="text-decoration: none; font-weight: bold;color: white;" href="http://scriptings.tk/paste">Home</a>
<input type="text" class="Input" name="search" placeholder="Search item" />
<input type="submit" class="Button" name="submit" value="Search"/></p>
</form>
<hr />
<form action="" method="post">
<table>
<tr><td>
Select text type :</td><td>
<select name="language" class="Input">
<option value="applescript">AppleScript</option>
<option value="asp">ASP</option>
<option value="autoit">AutoIT</option>
<option value="bash">Bash</option>
<option value="c">C</option>
<option value="cfm">ColdFusion</option>
<option value="cpp">C++</option>
<option value="csharp">C#</option>
<option value="css">CSS</option>
<option value="delphi">Delphi</option>
<option value="fortran">Fortran</option>
<option value="freebasic">FreeBasic</option>
<option value="fsharp">F#</option>
<option value="haskell">Haskell</option>
<option value="html4strict">HTML</option>
<option value="html5">HTML5</option>
<option value="java">Java</option>
<option value="javascript">Javascript</option>
<option value="jquery">jQuery</option>
<option value="latex">LaTeX</option>
<option value="lisp">Lisp</option>
<option value="lua">Lua</option>
<option value="mysql">MySQL</option>
<option value="objc">Objective-C</option>
<option value="oracle11">Oracle 11 SQL</option>
<option value="pascal">Pascal</option>
<option value="perl">Perl</option>
<option value="perl6">Perl6</option>
<option value="php">PHP</option>
<option value="powershell">PowerShell</option>
<option value="python">Python</option>
<option value="qbasic">QuickBASIC</option>
<option value="rails">Ruby On Rails</option>
<option value="ruby">Ruby</option>
<option value="scala">Scala</option>
<option value="smarty">Smarty</option>
<option value="sql">SQL</option>
<option value="text" selected="selected">Text</option>
<option value="vb">Visual Basic</option>
<option value="vbnet">VB.NET</option>
<option value="xml">XML</option>
</select></td></tr>
<tr><td>Enter paste title :</td>
<td><input class="Input" type="text" name="title"/></td></tr></table>
<textarea name="paste" rows="40" cols="164"></textarea>
<p><img src="captcha/CaptchaSecurityImages.php" alt="" /></p>
<p>Enter Captcha : <input type="text" name="security_code" class="Input"/>
<p><input class="Button" type="submit" name="submit" value="Paste"/></p>
</form>
</div>
<?php
if($set)
{
  echo '<p align="center"><span style="color: red">Wrong captcha!!!</span></p>';
	exit();
}
if(isset($_POST['security_code']) && isset($_POST['language']) && isset($_POST['title']) && 
   isset($_POST['paste']) && isset($_POST['submit']))
{
	include_once("pdoconnect.php");
	$uid   = uniqid();
	$query = $conn->prepare("INSERT INTO `paste` (`uid`, `title`, `language`, `pastecode`) VALUES (?, ?, ?, ?)");
	if($query->execute(array($uid, $_POST['title'], $_POST['language'], $_POST['paste'])))
	{
		header("Location: http://yourwebsite.com/viewcode.php?id=".$uid);
		exit();
	}
	else
	{
		echo '<p align="center"><span style="color: red">An error occured, try again</span></p>';
		exit();
	}
}
else if(isset($_POST['submit']))
{
	echo '<p align="center"><span style="color: red">One or more fields may not be filled</span></p>';
}
?>
</body>
</html>