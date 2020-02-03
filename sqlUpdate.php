<?php
$servername = "localhost";
$username = "api";
$password = "f103";
$dbname = "people";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully"."<br>";

$sql = "UPDATE students SET age = 18 WHERE name = 'Isaac' ";
$result = $conn->query($sql);

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>
