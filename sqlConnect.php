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

$sql = "SELECT name, age, gradeLevel FROM students";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "Name: " . $row["name"]. " - Age: " . $row["age"]. " - Grade Level: " . $row["gradeLevel"]. "<br><br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>
