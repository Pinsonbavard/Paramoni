<?php

function getRainfallData($lat, $lon, $startDate, $endDate) {

    $url = "https://archive-api.open-meteo.com/v1/archive"
        . "?latitude={$lat}"
        . "&longitude={$lon}"
        . "&start_date={$startDate}"
        . "&end_date={$endDate}"
        . "&hourly=precipitation";

    $response = file_get_contents($url);
    return json_decode($response, true);
}

?>