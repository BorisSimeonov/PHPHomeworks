<?php
echo "<form method='post'>Enter number of years: <input type='text' placeholder='Enter nums here (0-99)'".
    " name='numInput'/> <input type='submit' name='submit'></form>";

if(isset($_POST['submit']) && strlen(htmlentities($_POST['numInput'])) > 2 &&
    is_numeric(htmlentities($_POST['numInput'])) || (int)htmlentities($_POST['numInput'])<0 ){
    echo htmlentities($_POST['numInput'])."<style>span{color: red;font-weight: bold;}</style><span> - Too big or negative number!</span>";
}elseif(isset($_POST['submit']) && !is_numeric(htmlentities($_POST['numInput']))){
    echo htmlentities($_POST['numInput'])."<style>span{color: red;font-weight: bold;}</style><span> - Input only positive numbers!<br />".
        " Empty field, negative numbers and strings will not be accepted!</span>";
}elseif(isset($_POST['submit']) && is_numeric(htmlentities($_POST['numInput']))){
    $input = (int)htmlentities($_POST['numInput']);
    $result = "<table><tr><td>Year</td><td>January</td><td>February</td><td>March</td><td>April</td>
    <td>May</td><td>June</td><td>July</td><td>August</td><td>September</td><td>October</td><td>November</td>
    <td>December</td><td>Total</td></tr>";
    timezone_open('Europe/Sofia');
    $currentYear = (int)date('Y');

    for($counter = 0; $counter<$input; $counter++){
        $randomVals = getRandomArray();
        $result = $result."<tr><td>".($currentYear - $counter)."</td><td>$randomVals[0]</td><td>$randomVals[1]</td><td>$randomVals[2]</td><td>$randomVals[3]</td>
    <td>$randomVals[4]</td><td>$randomVals[5]</td><td>$randomVals[6]</td><td>$randomVals[7]</td><td>$randomVals[8]</td><td>$randomVals[9]</td><td>$randomVals[10]</td>
    <td>$randomVals[11]</td><td>$randomVals[12]</td></tr>";
    }
    $result = $result."</table>";
    echo $result;
    echo "<style>table,td{border: 1px solid black; border-spacing: 5px;}".
        "td{min-width: 100px; padding-left: 5px; text-align: center;}".
        "tr:first-of-type{font-weight: bold;} tr{border: 0px}";
}

function getRandomArray(){
    $costsArr = [];
    $sum = 0;
    for($cnt = 0; $cnt<12; $cnt++){
        $monthValue = rand(0,999);
        $sum+=$monthValue;
        array_push($costsArr, $monthValue);
    }
    array_push($costsArr, $sum);
    return $costsArr;
}
