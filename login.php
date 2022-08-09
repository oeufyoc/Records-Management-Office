<?php
/*
 * 	LOGIN FORM
 */
session_start();

$servername = "localhost";
$username = $_POST["username"];
$password = $_POST["password"];
$dbname = "RMO";

$_SESSION["username"] = $username;
$_SESSION["password"] = $password;

$name = $_POST["fullname"];
$code = $_POST["code"];
$gender = $_POST["gender"];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO SW (Name, Code, Gender)
	VALUES ('$name', '$code', '$gender')";

if ($conn->query($sql) === TRUE) {
	  echo "New record created successfully";
} else {
	  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

header('Location: table.php');

?> 
