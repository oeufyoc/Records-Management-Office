<?php
/*
 *	FILL UP FORM
 */
session_start();

$servername = "localhost";
$username = $_SESSION["username"];
$password = $_SESSION["password"];
$dbname = "RMO";

$name = 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}





?> 
