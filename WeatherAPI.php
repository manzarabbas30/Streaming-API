<?php
date_default_timezone_set("Asia/karachi");
$apiKey = "1c2431a8d340e882105f12dd67eaf341";
$cityId = "1169825";
$googleAPiUrl = "http://api.openweathermap.org/data/2.5/weather?id=" . $cityId . "&lang=en&units=metric&APPID=" . $apiKey;
$ch = curl_init();
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $googleAPiUrl);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);
curl_close($ch);
$data = json_decode($response);
$currentTime = time();
// echo "<pre>";
print_r($data);
// echo "<pre>";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <hr>
    <div class="report-container">
        <h2><?php echo $data->name;?> Weather Status</h2>
        <div class="time">
            <div><?php echo date("l g:i a", $currentTime); ?></div>
            <div><?php echo date("iS F, Y", $currentTime); ?></div>

            <div><?php echo ucwords($data->weather[0]->description) ?></div>
        </div>
        <div>
            <img src="http://openweathermap.org/img/w/<?php echo $data->weather[0]->icon; ?>.png" alt="" />
            <?php echo $data->main->temp_max; ?>&deg;C - 
            <span><?php echo $data->main->temp_min; ?>&deg;C</span>
        </div>
        <div >
            <div >Humidty: <?php echo $data->main->humidity;?> %</div>
            <div >Wind : <?php echo $data->wind->speed;?> km/h</div>
        </div>

    </div>
</body>

</html>