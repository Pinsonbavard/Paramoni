<?php

function getRiskMultiplier($lat, $lon) {

    // Simple Lagos zoning logic (you can later upgrade to GIS)

    if ($lat < 6.48 && $lon > 3.45) {
        return ["zone" => "A", "multiplier" => 1.4]; // Lekki axis
    }

    if ($lat < 6.55) {
        return ["zone" => "B", "multiplier" => 1.1];
    }

    return ["zone" => "C", "multiplier" => 0.9];
}

?>