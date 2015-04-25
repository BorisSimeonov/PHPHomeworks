<?php
$inputHTML = "<form method='post'>Starting Index: <input type='text' name='startInp'/>".
    " End: <input type='text' name='endInp'/> <input type='submit' name='submit'/></form>";
echo $inputHTML;

if(isset($_POST['submit'])){
    $start = htmlentities($_POST['startInp']);
    $end = htmlentities($_POST['endInp']);
    $result = "";
    if(is_numeric($start) && is_numeric($end) &&
        ($start<$end)){
        for($num = $start; $num<=$end; $num++){
            $result = $result.checkPrime($num);
        }
        $result = substr($result, 0, -2);
        echo $result;
    }else{
        echo "<span>Invalid Input!</span>";
    }
    echo "<style>span, b{color: red; text-shadow: 3px 2px #ffcac7;}</style>";
}

function checkPrime($number){
    $del = 2;
    if($number == 2){
        return "<b>$number</b>, ";
    }
    while ($del < $number) {
        if ($number % $del == 0) {
            return "$number, ";
        }
        $del++;
    }
    return "<b>$number</b>, ";
}