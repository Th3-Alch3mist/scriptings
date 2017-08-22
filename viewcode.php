<?php
if(isset($_GET['id']))
{
        $uid = $_GET['id'];
	$searchres = false;
	$title     = "Not found";
	include("pdoconnect.php");
	$query     = $conn->prepare("SELECT `title`, `language`, `pastecode` FROM `paste` WHERE `uid` = ?");
	$query->execute(array($uid));
	if($query->rowCount() == 0)
	{
		$searchres = true;
	}
	else
	{
		include("geshi/geshi.php");
		$row      = $query->fetch(PDO::FETCH_ASSOC);
                $title    = $row['title'];
		$source   = $row['pastecode'];
		$language = $row['language'];
		$path     = '';
		$geshi    = new GeSHi($source, $language, $path);
	}
}
else
{
	header("Location: http://yourwebsite.com");
	exit();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo htmlentities($title); ?></title>
<link rel="stylesheet" type="text/css" href="http://scriptings.tk/css/style2.css" /></head>
</head>

<body>
<div align="center">
<pre style="text-shadow: 2px 2px #000000;">
  _________            .__        __  .__                      
 /   _____/ ___________|__|______/  |_|__| ____    ____  ______
 \_____  \_/ ___\_  __ \  \____ \   __\  |/    \  / ___\/  ___/
 /        \  \___|  | \/  |  |_> >  | |  |   |  \/ /_/  >___ \ 
/_______  /\___  >__|  |__|   __/|__| |__|___|  /\___  /____  >
        \/     \/         |__|                \//_____/     \/ </pre>
</div>
<div style="text-shadow: 2px 2px #000000;" align="left">
<form action="search.php" method="post">
<p align="right">
<a style="text-decoration: none; font-weight: bold;color: white;" href="http://scriptings.tk/paste">Home</a>
<input type="text" class="Input" name="search" placeholder="Search item" />
<input type="submit" class="Button" name="submit" value="Search"/></p>
</form>
<hr />
</div>
<div style="text-shadow: 2px 2px #000000;" cols="40" align="left">
<?php
if($searchres)
{
	echo '<span style="color: red">Invalid id</span>';
	exit();
}
?>
<span style="color: green">Language : <?php echo htmlentities($language); ?></span><br />
</div>
<?php
$geshi->set_overall_style('background-color: #ffffee;', true);
$out = $geshi->parse_code();
$out = str_replace('style="font-family:monospace;background-color: #ffffee;"',
                   'style="font-family:monospace;background-color: #ffffee;color: #000000;"', $out);
echo $out;
?>
</body>
</html>