<?php
$formInp = "<form method='post'><input type='text' name='inLine' placeholder='Enter text (min.3 sym.)'/><input type='radio' name='rb' value='palindrome' checked/>Check Palindrome ".
    "<input type='radio' name='rb' value='reverse'/>Reverse String <input type='radio' name='rb' value='split'/>Split ".
    "<input type='radio' name='rb' value='hash'/>Hash String <input type='radio' name='rb' value='shuffle'/>Shuffle String  ".
    "<input type='submit' name='submit' value = 'Submit'/></form>";
echo $formInp;

if(isset($_POST['submit'])){
    $input = htmlentities($_POST['inLine']);
    if(strlen($input)>=3){
        $checkValue = htmlentities($_POST['rb']);
        switch ($checkValue) {
            case "palindrome":
                checkPalindrome($input);
                break;
            case "reverse":
                reverseString($input);
                break;
            case "split":
                splitString($input);
                break;
            case "hash":
                echo crypt($input, 'password');
                break;
            case "shuffle":
                shuffleString($input);
                break;
            default:
                echo "Checkbox Error!";
                break;
        }
    }else{
        echo "<span>Invalid input string!</span>";
    }
}

function reverseString($text){
    $text = str_split($text);
    $text = array_reverse($text);
    echo join("", $text);
}

function splitString($text){
    $text = preg_replace('/\s*?/', '', $text);
    $text = preg_replace('//', ' ', $text);
    echo $text;
}

function checkPalindrome($text){
    $buffer = strtolower($text);
    $end = strlen($text)-1;
    $isPal = true;
    for($fst = 0, $lst = $end;$fst<$end/2; $fst++, $lst--){
        if($buffer[$fst] !== $buffer[$lst]){
            $isPal = false;
            break;
        }
    }

    if($isPal){
        echo "'$text' is a palindrome!";
    }else{
        echo "'$text' is not a palindrome!";
    }
}

function shuffleString($text){
    $count = strlen($text)-1;
    for($cnt = 0; $cnt<$count; $cnt++){
        $char = $text[$cnt];
        $text = substr($text, 0,$cnt).substr($text, $cnt+1, $count);
        $text = $text.$char;
    }
    echo $text;
}