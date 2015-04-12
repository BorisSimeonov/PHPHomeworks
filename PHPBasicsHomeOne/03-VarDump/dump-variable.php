<?php
    $string = array("hello", 15, 1.123, array(1,2,3), (object)[2,34]);
    foreach($string as $index){
        if(is_numeric($index)){
            var_dump($index);
        }else{
            echo gettype($index) . "\n";
        }
    }
?>