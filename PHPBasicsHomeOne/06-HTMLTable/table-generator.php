<?php
$inArray = Array("Gosho","0882-321-423",24,"Hadji Dimitar");
//$inArray = Array("Pesho","0884-888-888",67,"Suhata reka");

// styles for the table
$styles =  "<table><style>td{border: solid 1px black;padding: 5px 10px}".
    "table{border-spacing: 0px}.name{background-color: orange;".
    "font-weight: bold}.value{text-align: right;}</style>";
echo $styles;

for($idx = 0; $idx<count($inArray); $idx++){
    $rowName = "";
    switch($idx){
        case 0:
            $rowName = "Name";
            break;
        case 1:
            $rowName = "Phone number";
            break;
        case 2:
            $rowName = "Age";
            break;
        default:
            $rowName = "Address";
            break;
    };
    echo "<tr><td class='name'>$rowName</td><td class='value'>$inArray[$idx]</td></tr>";
}
echo "</table>"
?>