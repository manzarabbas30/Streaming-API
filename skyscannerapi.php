<?php
$ch = curl_init();
$key='b726472f4ac79d09104ac7212bb11d5a';
curl_setopt($ch, CURLOPT_URL, 'http://skyscanner.net/apiservices/v3/flights/live/itineraryrefresh/create/{sessionToken}='.$key);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);
$data = json_decode($response);
echo "<pre>";
echo $response;
print_r($data);

echo "</pre>";

?>