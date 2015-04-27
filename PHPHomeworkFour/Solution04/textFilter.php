<?php
$inputField = "<form method='post'>Enter text here:<br/><textarea name='inField' placeholder='Enter the text here.'></textarea>".
    "<br/>Enter banned words: <br/><input type='text' name='changeWords' required='required'/><input type='submit' name='submit' value='Censor'/></form>";
echo $inputField;

if(isset($_POST['submit'])){
    $text = htmlentities($_POST['inField']);
    $bannedArray = htmlentities($_POST['changeWords']);
    $buffer = [];
    preg_match_all('/[a-z0-9]+/i', $bannedArray, $buffer);
    $bannedArray = $buffer[0];
    $buffer = $text;

    foreach($bannedArray as $word){
        $replacement = str_repeat("*", strlen($word));
        $text = str_ireplace($word, $replacement, $text);
    }
    echo "<span>The original text is: </span><br/>$buffer<br/>";
    echo "<span>Banned words : </span><br/>".join($bannedArray, ", ")."<br/>";
    echo "<span>The new text is:</span><br/>$text<br/>";
    echo "<style>span{color: #9a02fc; font-size: 14pt;} input:last-of-type{border: 2px solid #9a02fc; ".
        "border-radius: 5px; color: #9a02fc; margin-left: 10px;}</style>";
}