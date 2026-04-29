<?php

function calculatePremium($payout, $triggerProbability, $riskMultiplier) {

    $profitMargin = 0.30;

    $expectedLoss = $payout * $triggerProbability * $riskMultiplier;

    return $expectedLoss * (1 + $profitMargin);
}

?>