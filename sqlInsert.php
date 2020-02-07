<?php
$servername = "localhost";
$username = "User";
$password = "password";
$dbname = "school";
$name = 'Aaron';
$age = 17;
$gradeLevel = 11;
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

$sql = "INSERT INTO students (name, age, gradeLevel)
VALUES ('$name', '$age', '$gradeLevel')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
