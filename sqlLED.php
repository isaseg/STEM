<?php
$catch = $_REQUEST["turnOnOff"];
$servername = "localhost";
$username = "piControl";
$password = "f103";
$dbname = "piLight";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
	die("Connection failed: ".$conn->connect_error);
}

//$sql = "SELECT switchLight FROM lightState";
//if ($result = $conn->query($sql)) {
//	while ($row = $result -> fetch_row()) {
//		printf ($row[0]);
//	}
//		$result->free_result();
//}

//if ($row[0] == 1) {
if ($catch == 0) {
	$sql = "UPDATE lightState SET switchLight=0";
}
//elseif ($row[0] == 0) {
elseif ($catch == 1) {
	$sql = "UPDATE lightState SET switchLight=1";
}
else {
	$sql = "";
}

$result = $conn->query($sql);
$conn->close();
?>
