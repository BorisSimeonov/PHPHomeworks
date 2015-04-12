<?php
    $numbers = array(145, 15, 247);
    foreach($numbers as $index){
        $hasMatch = false;

        for($cnt = 102; $cnt<$index && $cnt<1000; $cnt++){
            $buffer = (string)$cnt;
            if(
                $buffer[0]<>$buffer[1] &&
                $buffer[1]<>$buffer[2] &&
                $buffer[0]<>$buffer[2]
            ){
                echo $cnt . "\n";
                $hasMatch = true;
            }
        }
        if(!$hasMatch){
            echo "no\n";
        }
        echo "----------------------------------------\n";
    }
?>