<?php
/*
 *	TABLE DISPLAY
 */
session_start();

$servername = "localhost";
$username = $_SESSION["username"];
$password = $_SESSION["password"];
$dbname = "RMO";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

//$sql = "SHOW TABLES"; 
$sql = "select * from SW";  //edit your table name here
$result = $conn->query($sql);

$fields_num = mysqli_num_fields($result);
echo "<table border='2'><tr>";
// printing table headers
for($i=0; $i<$fields_num; $i++)
{
    $field = mysqli_fetch_field($result);
    echo "<td>{$field->name}</td></div>";
}
echo "</tr>\n";
// printing table rows

echo "<div><table>";
while($row = mysqli_fetch_row($result))

{
	echo "<tr>";
	echo "<td>$row[0]</td>";
	echo "<td>$row[1]</td>";
	echo "<td>$row[2]</td>";
	echo "<td>$row[3]</td>";
	echo "</tr>\n";
}
echo "</table></div>";

?>
