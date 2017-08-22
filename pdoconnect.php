<?php
$db_hostname = '';
$db_username = '';
$db_password = '';
$db_name  = '';
try
{
	$conn = new PDO("mysql:host=$db_hostname;dbname=$db_name", $db_username, $db_password);
} catch (PDOException $e){
    echo $e->getMessage();
}
?>