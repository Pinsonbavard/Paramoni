<?php
exit("Testing site");
// INPUT
$location = $_GET['location'] ?? "Agungi, Lagos";
$payout   = $_GET['payout'] ?? 100000;
$threshold = 90;

// DATE RANGE (backtest window)
$startDate = "2022-01-01";
$endDate   = "2025-01-01";

require_once "geo.php";
require_once "weather.php";
require_once "risk.php";
require_once "pricing.php";
require_once "computeTriggerProb.php";

// 1. GET COORDINATES
$geo = getCoordinates($location);

if (!$geo) {
    die(json_encode(["error" => "Location not found"]));
}

// 2. WEATHER DATA
$weather = getRainfallData($geo['lat'], $geo['lon'], $startDate, $endDate);

// 3. TRIGGER PROBABILITY
$triggerProb = computeTriggerProbability($weather, $threshold);

// 4. RISK ZONE
$risk = getRiskMultiplier($geo['lat'], $geo['lon']);

// 5. PREMIUM CALCULATION
$premium = calculatePremium($payout, $triggerProb, $risk['multiplier']);

// RESPONSE
echo json_encode([
    "location" => $geo['display_name'],
    "lat" => $geo['lat'],
    "lon" => $geo['lon'],
    "zone" => $risk['zone'],
    "trigger_probability" => $triggerProb,
    "risk_multiplier" => $risk['multiplier'],
    "payout" => $payout,
    "recommended_premium" => round($premium, 2)
]);



?>
