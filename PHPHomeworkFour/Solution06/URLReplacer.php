<?php
$inputSource = "<form method='post'>Enter the text here: ".
    "<br/><textarea name='textField'></textarea><br/><input".
    " type='submit' name='submit' value='Process Text'/></form>";
echo $inputSource;

if(isset($_POST['submit'])){
    $text = $_POST['textField'];
    if(stripos($text, "<a href=")){
        $text=preg_replace('/<a\s+href="(.*?)">(.*?)<\/a>/i', '[URL="$1"]$2[/URL]', $text);
        echo $text;
    }else{
        echo "No 'href' links found!";
    }
}