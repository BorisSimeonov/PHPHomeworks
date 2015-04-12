<?php
date_default_timezone_set('UTC');
$month = (integer)date('m');
$year = (integer)date('y');
$lastDay = cal_days_in_month(CAL_GREGORIAN, $month, $year);
for($day = 1; $day<=$lastDay; $day++){
    $d = "$year-$month-$day";
    $timestamp = strtotime($d);
    if(date('l', $timestamp) === "Sunday"){
        echo date('jS l, o', $timestamp)."\n";
    }
}
?>