<?php
echo "<form method='get'>Enter cars: <input type='text' placeholder='Enter Here'".
    " name='carInput' class='inField'/> <input type='submit' name='submit'></form>".
    "<style>.inField{background-color: rgba(255, 214, 124, 0.51);}</style>";

if(isset($_GET['submit']) && strlen($_GET['carInput']) > 3){
    $input = htmlentities($_GET['carInput']);
    $inArray = preg_split('/\,{1}\s*/', $input);
    $colors = ['black', 'blue', 'green', 'pink', 'crazy color', 'white', 'red', 'cyan'];
    $result = "<table><tr><td>Car</td><td>Color</td><td>Count</td></tr>";
    foreach($inArray as $car){
        $randCount = rand(1,5);
        $randCol = rand(0,count($colors)-1);
        $result = $result."<tr><td>$car</td><td>$colors[$randCol]</td><td>$randCount</td></tr>";
    }
    $result = $result."</table>";
    echo $result;
}
echo "<style>table,td{border: 1px solid black; border-spacing: 5px;}".
    "td{min-width: 100px; padding-left: 5px; text-align: center;}".
    "tr:first-of-type{font-weight: bold;} tr{border: 0px}";