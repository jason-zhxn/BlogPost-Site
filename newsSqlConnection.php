<?php
//connecting to database file

$mysqli = new mysqli('localhost', 'user', 'password', 'newswebsite');

if($mysqli->connect_errno) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}
?>
    
