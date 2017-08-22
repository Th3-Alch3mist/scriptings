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
<?php
if((!empty($_POST['search']) || is_numeric($_POST['search'])) && isset($_POST['submit']))
{
	include_once("pdoconnect.php");
	$searchstring = trim($_POST['search']);
	$flag         = 0;
	$query        = $conn->prepare("SELECT `uid`, `title` FROM `paste` WHERE `title` LIKE ?");
	$query->execute(array('%'.$searchstring.'%'));
	while($row = $query->fetch(PDO::FETCH_ASSOC))
	{
		echo '<a style="text-decoration: none; font-weight: bold;color: white;" href="http://scriptings.tk/paste/viewcode.php?id='.htmlentities($row['uid']);
                echo '">'.htmlentities($row['title'])."</a><br /><hr />";
		$flag  = 1;
	}
	if($flag == 0)
	{
		echo '<span style="color: red;">No results found for "'.htmlentities($_POST['search']).'"</span>';
	}
}
else if(isset($_POST['submit']))
{
        echo '<span style="color: red;">No results found</span>';
}
?>
</div>
</body>
</html>