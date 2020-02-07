<?php
$servername = "localhost";
$username = "user";
$password = "password";
$dbname = "school";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection died: " . $conn->connect_error);
}
echo "Connection success"."<br>";

$sql = "UPDATE students SET age = 17 WHERE name = 'Kaiki' ";
$result = $conn->query($sql);

if ($conn->query($sql) === TRUE) {
    echo "Record updated";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>
