<?php

function computeTriggerProbability($data, $threshold) {

    $times = $data['hourly']['time'];
    $rain  = $data['hourly']['precipitation'];

    $daily = [];

    for ($i = 0; $i < count($times); $i++) {
        $date = substr($times[$i], 0, 10);

        if (!isset($daily[$date])) {
            $daily[$date] = 0;
        }

        $daily[$date] += $rain[$i];
    }

    $triggerDays = 0;
    $totalDays = count($daily);

    foreach ($daily as $value) {
        if ($value >= $threshold) {
            $triggerDays++;
        }
    }

    return $triggerDays / max($totalDays, 1);
}


?>