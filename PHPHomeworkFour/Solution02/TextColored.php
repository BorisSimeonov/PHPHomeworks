<?php
$textSource = "<form method='post'><textarea name='inField' placeholder='enter text here' required='required'></textarea>".
    "<br /><input type='submit' name='submit' value='Color Text'/></form>";
echo $textSource;

if(isset($_POST['submit'])){
    if((strlen($_POST['inField'])>0)){
        $input = htmlentities($_POST['inField']);
        $input = preg_replace('/\s+/i',"", $input);
        if(preg_match('/^\s*$/',$input)){
            $input = "No_Input_Found!";
        }
        $input = str_split($input);
        $result= "";
        foreach($input as $char){
            $numVal = ord($char);
            if($numVal % 2 !== 0){
                $result.="<span class='blue'>$char </span>";
            }else{
                $result.="<span class='red'>$char </span>";
            }
        }
        echo $result;
    }
    echo "<style>.blue{color: mediumblue;}.red{color: red;}span{font-weight: bold; font-style: italic; font-size: 20px;}</style>";
}