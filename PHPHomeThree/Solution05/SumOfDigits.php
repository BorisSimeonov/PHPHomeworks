<?php
$formStr = "<form method='post'>Input String: <input class='inField' type='text' name='inLine' required='true'/> <input type='submit' name='submit' value='Submit'/></form>";
echo $formStr;
echo "<style>.inField{width: 250px;} table, td{border: 1px solid black;}td{padding: 2px 5px; text-align: left;}</style>";

if(isset($_POST['submit'])){
    $input = htmlentities($_POST['inLine']);
    $input = preg_replace('/\s*/', '', $input);
    $input = preg_split('/\,{1}\s*?/',$input);
    $result = "<table>";
    foreach ($input as $line) {
        if(is_numeric($line)){
            $sum = array_sum(str_split($line));
            $result = $result."<tr><td>$line</td><td>$sum</td></tr>";
        }else{
            $result = $result."<tr><td>$line</td><td>I cannot sum that!</td><tr>";
        }
    }
    $result = $result."</table>";
    echo $result;
}