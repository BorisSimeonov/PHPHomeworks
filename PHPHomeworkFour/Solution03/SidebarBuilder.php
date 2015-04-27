<?php
$inputSource = "<form method='post'><table><tr><td>Categories: </td><td><input type='text' required='required' name='category'/></td>".
    "<tr><td>Tags: </td><td><input type='text' required='required' name='tag'/></td></tr><tr><td>Months: </td><td><input type='text' name='month'".
    " required='required'/></td></tr></table><input type='submit' name='submit' value='Generate'/></form>";
echo $inputSource;
echo "<style>aside{float: right; position: relative; min-width: 200px; }".
    "div{margin: 10px 0px; padding: 0px 20px; background: -webkit-linear-gradient(#45abff, #5c79b7);" .
    "background: -o-linear-gradient(#45abff, #5c79b7);background: -moz-linear-gradient(#45abff, #5c79b7);".
    "background: linear-gradient(#45abff, #5c79b7); border: 1px solid black;".
    " border-radius: 20px;}h1{text-align: center;} a{color:black;}form{float:left; border:2px solid #45abff; padding: 25px;".
    "background-color: #d4ecff;}" .
    "li{list-style-type: circle;}</style>";

if(isset($_POST['submit'])){
    $catValues = htmlentities($_POST['category']);
    $tagValues = htmlentities($_POST['tag']);
    $monthValues = htmlentities($_POST['month']);
    $buffer;
    preg_match_all('/[a-z]+/i', $catValues, $buffer);
    $catValues = $buffer[0];
    preg_match_all('/[a-z]+/i', $tagValues, $buffer);
    $tagValues = $buffer[0];
    preg_match_all('/[a-z]+/i', $monthValues, $buffer);
    $monthValues = $buffer[0];

    $menus = [$catValues, $tagValues, $monthValues];
    $titles = ["Categories", "Tags", "Months"];
    $display = "<aside>";
    for($cnt = 0; $cnt<3; $cnt++){
        $result = "<div><h1>$titles[$cnt]</h1><hr/><ul>";
        foreach($menus[$cnt] as $item){
            $result.="<li><a href=''>$item</a></li>";
        }
        $result .= "</ul></div>";
        $display.= $result;
    }
    $display.="</aside>";
    echo $display;
}