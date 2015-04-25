<?php
$result = "<table><tr><td>Number</td><td>Square</td></tr>";
$sum = 0;
for($num = 0; $num<=100;){
    $sq = sqrt($num);
    if($sq !== round($sq)){
        $sq = number_format($sq, 2);
    }
    $sum+=$sq;
    $result = $result."<tr><td>$num</td><td>$sq</td></tr>";
    $num+=2;
}
$result = $result."<tr><td>Total:</td><td>$sum</td></table>";
echo $result;
echo "<style>table,td{border: 1px solid black;}td{min-width: 50px; padding-left: 5px;}".
    "tr:first-of-type, tr:last-of-type td:first-of-type{font-weight: bold;}".
    "td:nth-child(2){border-color: red;}</style>";