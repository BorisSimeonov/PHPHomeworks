<?php
$textSource = "<form method='post'><textarea name='inField' placeholder='enter text here' required='required'></textarea>".
    "<br /><input type='submit' name='submit' value='Count Words'/></form>";
echo $textSource;

if(isset($_POST['submit']) && (strlen($_POST['inField'])>0)){
    $input = htmlentities($_POST['inField']);
    $input = preg_replace('/[^a-z]+/i', " ", $input);
    $style = "<style>table, td{border: 1px solid black; background-color: #e9e9e9;}".
        " td{min-width: 60px; text-align: center; padding: 0px 5px;}</style>";
    if(!preg_match('/^\s*$/', $input)){
        $input = preg_split('/\s+/', trim($input));
        $array = array_count_values(array_map('strtolower', $input));
        arsort($array);
        $keysVal = array_keys($array);
        $result = "<table>";
        for($idx = 0; $idx<count($array);$idx++){
            $result = $result."<tr><td>".$keysVal[$idx]."</td><td>".$array[$keysVal[$idx]]."</td></tr>";
        }
        echo $result."</table>";
        echo $style;
    }else{
        echo "<table><tr><td>No words found!</td></tr></table>";
        echo $style;
    }
}