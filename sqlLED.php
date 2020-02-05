<html>
	<head>
		<script>
			<?php
				//server and database info
				$catch = $_REQUEST["turnOnOff"];
				$servername = "localhost";
				$username = "piControl";
				$password = "f103";
				$dbname = "piLight";
				
				//creating the connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				if ($conn->connect_error) {
					die("Connection failed: ".$conn->connect_error);
				}
				//if statea is 0, set switchLight to 0
				if ($catch == 0) {
					$sql = "UPDATE lightState SET switchLight=0";
				}
				//if statea is 1, set switchLight to 1
				elseif ($catch == 1) {
					$sql = "UPDATE lightState SET switchLight=1";
				}
				else {
					$sql = "";
				}

				$result = $conn->query($sql);
				$conn->close();
				?>
			<?php
				$servername = "localhost";
				$username = "piControl";
				$password = "f103";
				$dbname = "piLight";

				$conn = new mysqli($servername, $username, $password, $dbname);
				if ($conn->connect_error) {
					die("Connection failed: ".$conn->connect_error);
				}	
				//get the switchLight value, set it to a var, statea
				$sql = "SELECT switchLight FROM lightState";
				if ($result = $conn->query($sql)) {
					while ($row = $result -> fetch_row()) {
						echo "var statea = ".$row[0];
					}
					$result->free_result();
				}
				$conn->close();
			?>	
			//refreshes the var
			function switchLED() {
				var xmlhttp = new XMLHttpRequest();
				if (statea == 0) {
					statea = 1;
					document.getElementById('status').innerHTML = "The LED is on";
				}
				else if (statea == 1) {
					statea = 0;
					document.getElementById('status').innerHTML = "The LED is off";
				}
				xmlhttp.open("GET", "buttonLED.php?turnOnOff=" + statea, true);
				xmlhttp.send();
			}
		</script>
	</head>
	<body>
		<button onclick="switchLED()">Turn LED On/Off</button>
		<h1 id="status"></h1>
	</body>
</html>
