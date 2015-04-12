<?php
//while(true){
    date_default_timezone_set('Europe/Sofia');
    //$NYDate = strtotime("2015-12-31 23:59:59");
    //$setDate = strtotime("2015-08-12 13:07:09");
    $getYear = date('Y');
    $NYDate = strtotime("$getYear-12-31 23:59:59");
    $setDate = strtotime("Now");
    $datediff = $NYDate - $setDate;
    echo "Days until New Year : ".floor($datediff/(60*60*24)), "\n";
    echo "Hours until New Year : ". floor($datediff/(60*60)), "\n";
    echo "Minutes until New Year : ".floor($datediff/(60)), "\n";
    echo "Seconds until New Year : ".$datediff, "\n";
    echo "Days:Hours:Minutes:Seconds : ".floor($datediff/(60*60*24)).":".(($datediff/(60*60))%24).":".(($datediff/60)%60).":".$datediff%60 , "\n";
//    sleep(1);
//}
?>