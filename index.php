<?php
$apiKey = "4a756b56637f475bb0284027202510";
$googleApiUrl = "http://api.weatherapi.com/v1/current.json?key=".$apiKey."q=Philippines";

$ch = curl_init();
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);

curl_close($ch);
$data = json_decode($response);
date_default_timezone_set("Asia/Manila");
$currentTime = time();
?>

<!doctype html>
<html>
<head>
<title>Weather Status Application</title>

<style>
body {
    font-family: Arial;
    font-size: 0.95em;
    color: #929292;
}

.report-container {
    background-image: url("weather-gradient.jpg");
    border: #E0E0E0 1px solid;
    padding: 20px 40px 40px 40px;
    border-radius: 15px;
    width: 550px;
    margin: 0 auto;
}

.weather-icon {
    vertical-align: middle;
    margin-right: 20px;
}

.weather-forecast {
    color: #212121;
    font-size: 1.2em;
    font-weight: bold;
    margin: 20px 0px;
}

span.min-temperature {
    margin-left: 15px;
    color: #929292;
}

.time {
    line-height: 25px;
}
</style>

</head>
<body>

    <div class="report-container">
        <h2>Weather Status</h2>
        <h2><?php echo $data->location->name.", ".$data->location->region.", ".$data->location->country; ?></h2>
        <div class="time">
            <div><?php echo date("l g:i a", $currentTime); ?></div>
            <div><?php echo date("jS F, Y",$currentTime); ?></div>
            <div><?php echo ucwords($data->current->condition->text); ?></div>
        </div>
        <div class="weather-forecast">
            <img
                src=<?php echo $data->current->condition->icon; ?>.png"
                class="weather-icon" /> <?php echo $data->current->temp_c; ?>&deg;C<span
                class="min-temperature"><?php echo $data->current->temp_f; ?>&deg;F</span>
        </div>
        <div class="time">
            <div>Humidity: <?php echo $data->current->humidity; ?> %</div>
            <div>Wind: <?php echo $data->current->wind_kph; ?> km/h</div>
        </div>
    </div>


</body>
</html>
