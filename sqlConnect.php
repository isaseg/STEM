<?php
//User credentials
$servername = "localhost";
$username = "User";
$password = "password";
$dbname = "school";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection died: " . $conn->connect_error);
}
echo "Connection success"."<br>";

//Run the sql and create a var for the data returned
$sql = "SELECT name, age, gradeLevel FROM students";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output each row
    while($row = $result->fetch_assoc()) {
        echo "Name: " . $row["name"]. " - Age: " . $row["age"]. " - Grade Level: " . $row["gradeLevel"]. "<br><br>";
    }
} else {
    echo "No data found";
}
$conn->close();
?>
