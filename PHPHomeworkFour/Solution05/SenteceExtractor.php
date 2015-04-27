<?php

$inputSource = "<form method='post'>Enter text here: <br/>".
    "<textarea name='textField'></textarea><br/>Enter key ".
    "word:<br/><input name='word' type='text' required='required'/>".
    "<input type='submit' name='submit'/></form>";
echo $inputSource;

if(isset($_POST['submit'])){
    $text = htmlentities($_POST['textField']);
    $word = htmlentities($_POST['word']);
    $buffer = [];
    preg_match_all('/[a-z]+/i', $word, $buffer);
    if(count($buffer[0]) !== 0){
        $word = $buffer[0][0];
        $sentencesArray = [];
        preg_match_all('/[^\.\?\!]+(\.|\?|\!){1}/i', $text, $sentencesArray);
        $checkMatch = false;
        foreach($sentencesArray[0] as $sentence){
            if(preg_match('/[^a-z]'.$word.'(\s|\.|\?|\!){1}/i', $sentence)){
                echo $sentence."<br/>";
                $checkMatch = true;
            }
        }
        if(!$checkMatch){
            echo "No result found!";
        }
    }else{
        echo "No key word found!";
    }

}