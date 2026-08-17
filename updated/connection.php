<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "gaari_shaari";

if(!$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{
	die("failed to connect!");
}
?>
