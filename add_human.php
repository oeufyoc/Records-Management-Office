<?php
// Database connection
$servername = "localhost";
$username = "renzo";
$password = "ozner";
$dbname = "RMO";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

// Get form data
$last_name = $_POST['last_name'];
$first_name = $_POST['first_name'];
$middle_initial = $_POST['middle_initial'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$address = $_POST['address'];
$birthdate = $_POST['birthdate'];
$social_status = $_POST['social_status'];
$phone_number = $_POST['phone_number'];
$facebook_account = $_POST['facebook_account'];

// Check if record already exists
$sql = "SELECT * FROM humans WHERE CONCAT(first_name, last_name, middle_initial) = CONCAT('$first_name', '$last_name', '$middle_initial')";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
echo "Record already exists";
} else {
// Insert data into table
	$sql = "INSERT INTO humans (
		last_name, 
		first_name, 
		middle_initial, 
		age, 
		gender, 
		address, 
		birthdate, 
		social_status, 
		phone_number,
		facebook_account
	) 

	VALUES (
		'$last_name', 
		'$first_name', 
		'$middle_initial', 
		'$age', 
		'$gender', 
		'$address', 
		'$birthdate', 
		'$social_status', 
		'$phone_number', 
		'$facebook_account'
)";

if ($conn->query($sql) === TRUE) {
echo "Data inserted successfully";
} else {
echo "Error: " . $sql . "<br>" . $conn->error;
}
}

$conn->close();
?>
