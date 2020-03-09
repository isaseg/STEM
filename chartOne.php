<?php
//creating arrays for the data to be pushed to
$hum = array();
$temp = array();
$timeS = array();

//connection info
$server = "192.168.0.210";
$user = "humChecker";
$passwd = "raspberry";
$db = "projects";

//create conn
$conn = new mysqli($server, $user, $passwd, $db);
if ($conn->connect_error) {
	die("Connection failed: ".$conn->connect_error);
}

//select humidity, temperature, and timeStamp from db
$sql = 'SELECT humidity, temperature, timeStamp FROM humTemp ORDER BY id DESC LIMIT 10';
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		//push the data from db into corresponding arrays
		array_push($hum, $row["humidity"]);
        array_push($temp, $row["temperature"]);
        //get the latest timeStamp
        $lastTime = strtotime($row["timeStamp"]);
        //make the timeStamps human readable before pushing to array
        $a = strftime("%b %d, %Y at %r", strtotime($row["timeStamp"]));
        array_push($timeS, $a);
	}
}

$conn->close();

//datapoints for humidity data and their times
$humData = array(
	array("y" => $hum[9], "label" => $timeS[9]),
	array("y" => $hum[8], "label" => $timeS[8]),
	array("y" => $hum[7], "label" => $timeS[7]),
	array("y" => $hum[6], "label" => $timeS[6]),
	array("y" => $hum[5], "label" => $timeS[5]),
	array("y" => $hum[4], "label" => $timeS[4]),
	array("y" => $hum[3], "label" => $timeS[3]),
	array("y" => $hum[2], "label" => $timeS[2]),
	array("y" => $hum[1], "label" => $timeS[1]),
	array("y" => $hum[0], "label" => $timeS[0])
);

//datapoints for temperature date and their times
$tempData = array(
	array("y" => $temp[9], "label" => $timeS[9]),
	array("y" => $temp[8], "label" => $timeS[8]),
	array("y" => $temp[7], "label" => $timeS[7]),
	array("y" => $temp[6], "label" => $timeS[6]),
	array("y" => $temp[5], "label" => $timeS[5]),
	array("y" => $temp[4], "label" => $timeS[4]),
	array("y" => $temp[3], "label" => $timeS[3]),
	array("y" => $temp[2], "label" => $timeS[2]),
	array("y" => $temp[1], "label" => $timeS[1]),
	array("y" => $temp[0], "label" => $timeS[0])
);

//setting up for the min() max() statements
$humOne = $hum[9]. "% on ". $timeS[9];
$humTwo = $hum[8]. "% on ". $timeS[8];
$humThree = $hum[7]. "% on ". $timeS[7];
$humFour = $hum[6]. "% on ". $timeS[6];
$humFive = $hum[5]. "% on ". $timeS[5];
$humSix = $hum[4]. "% on ". $timeS[4];
$humSev = $hum[3]. "% on ". $timeS[3];
$humEig = $hum[2]. "% on ". $timeS[2];
$humNine = $hum[1]. "% on ". $timeS[1];
$humTen = $hum[0]. "% on ". $timeS[0];
//array to get the max and min values from
$humVal = array($humOne, $humTwo, $humThree, $humFour, $humFive, $humSix, $humSev, $humEig, $humNine, $humTen);


$tempOne = $temp[9]. "°C on ". $timeS[9];
$tempTwo = $temp[8]. "°C on ". $timeS[8];
$tempThree = $temp[7]. "°C on ". $timeS[7];
$tempFour = $temp[6]. "°C on ". $timeS[6];
$tempFive = $temp[5]. "°C on ". $timeS[5];
$tempSix = $temp[4]. "°C on ". $timeS[4];
$tempSev = $temp[3]. "°C on ". $timeS[3];
$tempEig = $temp[2]. "°C on ". $timeS[2];
$tempNine = $temp[1]. "°C on ". $timeS[1];
$tempTen = $temp[0]. "°C on ". $timeS[0];
$tempVal = array($tempOne, $tempTwo, $tempThree, $tempFour, $tempFive, $tempSix, $tempSev, $tempEig, $tempNine, $tempTen);

echo $lastTime;
//alert if the data hasn't been updated in 5 min (300 sec)
if ((mktime() - $lastTime) > 300) {
	echo "Warning: Database has not been updated in over five minutes<br>";
}

//echo the largest and lowest datapoints for $humVal and $tempVal
echo "The highest humidity was: ". max($humVal). " and the lowest humidity was: ". min($humVal). "<br>";
echo "The highest temperature was: ". max($tempVal). " and the lowest temperature was: ". min($tempVal). "<br>";
?>
<html>
<head>
<script>
//set up the charts on the window loading
window.onload = function () {
 
//creating the humidity chart and setting it up
var humidity = new CanvasJS.Chart("hum", {
	title: {
		text: "Humidity"
	},
	axisY: {
		title: "Humidity %"
	},
	data: [{
		type: "line",
		//specifying which datapoints to use
		dataPoints: <?php echo json_encode($humData, JSON_NUMERIC_CHECK); ?>
	}]
});
//actually create the chart on the window
humidity.render();

//creating the temperature chart and setting it up
var temperature = new CanvasJS.Chart("temp", {
	title: {
		text: "Temperature"
	},
	axisY: {
		title: "Temperature °C"
	},
	data: [{
		type: "line",
		//specifying what datapoints to use
		dataPoints: <?php echo json_encode($tempData, JSON_NUMERIC_CHECK); ?>
	}]
});
//make the chart appear on the window
temperature.render();
 
}
</script>
</head>
<body>
<!--Create the divs that will be used for the charts and set their id's, then run the canvasjs code-->
<div id="hum" style="height: 45%; width: 100%;"></div>
<div id="temp" style="height: 45%; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>
