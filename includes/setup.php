<?php
session_start();

$dbhost = 'localhost';
$dbname = 'many_to_many';
$dbuser = 'root';
$dbpass = '';

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');

mysql_select_db($dbname, $conn);

if (!isset($_SESSION['loggedin']))
	$_SESSION['loggedin'] = false;
?>
