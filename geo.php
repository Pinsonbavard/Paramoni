<?php

echo "Testing geo.php";
function getCoordinates($location) {

    $url = "https://nominatim.openstreetmap.org/search?q=" 
        . urlencode($location) 
        . "&format=json";

    $response = file_get_contents($url);
    $data = json_decode($response, true);

    if (!isset($data[0])) {
        return null;
    }

    return [
        "lat" => $data[0]["lat"],
        "lon" => $data[0]["lon"],
        "display_name" => $data[0]["display_name"]
    ];
}

?>