<?php
$formSource = "<form method='post'><table id='tableDeck'><tr class='headTR'><td>First Name:</td><td>Second Name:</td><td>Email:</td><td>Exam Score:</td></tr></table>".
    "<button name='add' class='btn' onclick='addRow(); return false;'>+</button> Sort by: <select name='sortCriteria'><option value='firstName'>First Name</option>".
    "<option value='lastName'>Last Name</option><option value='mail'>Email</option><option value='score'>Exam Score</option></select>".
    " Order: <select name='order'><option value='descending'>Descending</option><option value='ascending'>Ascending</option></select>".
    "<input class='subBtn' type='submit' name='submit' value='Submit'></form>";
echo $formSource;
echo "<style>table{border: 1px solid black; min-width: 800px; margin: 0px 0px 10px; border-collapse: collapse;
	border-spacing: 0;} td{width: 25%;}".
    " .btn{background-color: #164283; border: 2px outline silver; width: 30px; height: 30px; color: white; font-weight: bold;}".
    ".subBtn{background-color: #164283; border: 2px outline silver; height: 30px; color: white; font-weight: bold;}".
    ".headTR{background-color: #59ff00; border: 1px solid black;} .errorLog{color: dodgerblue; font-weight: bold; font-size: 18px;" .
    "text-shadow: 3px 3px #fdffaf;}</style>";


if(isset($_POST['submit']) && isset($_POST['fName']) &&
    isset($_POST['lName']) && isset($_POST['mail']) &&
    isset($_POST['score'])){
    //get inputs
    $firstNames = $_POST['fName'];
    $lastNames = $_POST['lName'];
    $emails = $_POST['mail'];
    $scores = $_POST['score'];
    $sortCriteria = htmlentities($_POST['sortCriteria']);
    $sortOrder = htmlentities($_POST['order']);
    //check for scripts
    $firstNames = validateData($firstNames);
    $lastNames = validateData($lastNames);
    $emails = validateData($emails);
    $scores = validateData($scores);
    //check input values and build a table
    $indexCount = count($firstNames);
    $foundInvalid = false;
    $sum = 0;
    $resultArray = [];
    //store the validated input in ass. array
    $validationErrors = false;
    $errorIndex = [];
    for($index = 0; $index<$indexCount; $index++){
        $allValid = true;
        $allValid = checkName($firstNames[$index], $lastNames[$index], $allValid);
        $allValid = checkEmail($emails[$index], $allValid);
        $allValid = checkScore($scores[$index], $allValid);
        if($allValid){
            $sum+=$scores[$index];
            $associativeArray = array();
            $associativeArray["firstName"] = $firstNames[$index];
            $associativeArray["lastName"] = $lastNames[$index];
            $associativeArray["email"] = $emails[$index];
            $associativeArray["score"] = $scores[$index];
            array_push($resultArray, $associativeArray);
        }else{
            $validationErrors = true;
            array_push($errorIndex, $index+1);
        }
    }

    //sort object
    if(count($resultArray)>1){
        $resultArray = sortArray($resultArray, $sortCriteria, $sortOrder);
    }

    $averageScore = 0;
    $resultTable = "<table class='resTable'><tr class='fstResultRow'><td>First Name</td><td>Last Name</td><td>Email</td><td>Exam Score</td></tr>";
    foreach($resultArray as $person){
        $resultTable = $resultTable."<tr><td>".$person["firstName"]."</td><td>".$person["lastName"]."</td>".
            "<td>".$person["email"]."</td><td>".$person["score"]."</td><tr/>";
        $averageScore += (int)$person["score"];
    }
    if(count($resultArray)>0){
        $averageScore /= count($resultArray);
    }
    $resultTable = $resultTable."<tr><td colspan='3' class='average'>Average Score:</td><td>".number_format($averageScore, 2)."</td></tr></table>";
    echo $resultTable;
    echo "<style>.resTable td{border: 1px solid black;} .resTable{border: 0px; border-collapse: collapse;
	border-spacing: 0;}.fstResultRow{font-weight: bold; background-color: dodgerblue; color: white; text-align: center;}".
        ".average{font-weight: bold;}</style>";

    if($validationErrors){
        echo "<span class='errorLog'>! Input errors found at row: ".join($errorIndex, ",")."</span>";
    }
}

function validateData($array){
    $newArray = [];
    foreach($array as $line){
        array_push($newArray, htmlentities(trim($line)));
    }
    return $newArray;
}
function checkName($fNames, $lNames, $currentBool){
    $checked = $currentBool;
    if(!preg_match("/^[a-zA-Z]+$/",$fNames) || strlen($fNames)<2 ||
        !preg_match("/^[a-zA-Z]+$/",$lNames) || strlen($lNames)<2){
        $checked = false;
    }
    return $checked;
}
function checkEmail($mail, $currentBool){
    $checked = $currentBool;
    if(!preg_match('/^[a-z0-9]{1,}((\.{1}|\_{1})[a-z0-9]+)?@{1}[a-z]+(\.{1}[a-z]+)?\.{1}[a-z]{2,3}$/i',$mail) || strlen($mail)<8){
        $checked = false;
    }
    return $checked;
}
function checkScore($score, $currentBool){
    $checked=$currentBool;
    if(!is_numeric($score)||($score>400||$score<0)||((int)$score != $score)){
        $checked = false;
    }
    return $checked;
}
function sortArray($array, $criteria, $order){
    if($criteria === "score")
    {
        if($order==="descending"){
            function cmp($a, $b)
            {
                return $b['score'] - $a['score'];
            }

            usort($array, "cmp");
            return $array;
        }elseif($order==="ascending"){
            function cmp($a, $b)
            {
                return $a['score'] - $b['score'];
            }

            usort($array, "cmp");
            return $array;
        }
    }else{
        if($criteria==="firstName"){
            if($order === "descending"){
                function cmp($a, $b)
                {
                    return strcmp($b["firstName"], $a["firstName"]);
                }
                usort($array, "cmp");
                return $array;
            }else{
                function cmp($a, $b)
                {
                    return strcmp($a["firstName"], $b["firstName"]);
                }
                usort($array, "cmp");
                return $array;
            }
        }elseif($criteria === "lastName"){
            if($order === "descending"){
                function cmp($a, $b)
                {
                    return strcmp($b["lastName"], $a["lastName"]);
                }
                usort($array, "cmp");
                return $array;
            }else{
                function cmp($a, $b)
                {
                    return strcmp($a["lastName"], $b["lastName"]);
                }
                usort($array, "cmp");
                return $array;
            }
        }elseif($criteria === "mail"){
            if($order === "descending"){
                function cmp($a, $b)
                {
                    return strcmp($b["email"], $a["email"]);
                }
                usort($array, "cmp");
                return $array;
            }else{
                function cmp($a, $b)
                {
                    return strcmp($a["email"], $b["email"]);
                }
                usort($array, "cmp");
                return $array;
            }
        }else{
            return $array;
        }
    }
}
?>

<script type="text/javascript">
    var count = -1;
    function addRow(){
        count++;
        var table = document.createElement("tr");
        table.setAttribute("id","row"+count);
        table.innerHTML = "<td class='inDeck'><input type='text' name='fName[]' required='true'/><td class='inDeck'><input type='text' name='lName[]' required='true'/>"+
        "<td class='inDeck'><input type='text' name='mail[]' required='true'/><td class='inScore'><input type='number' name='score[]' required='true' value='0'/> "+
        "<button class='btn' name='remm' onclick='removeRow("+count+"); return false;'>-</button></td>";
        document.getElementById("tableDeck").appendChild(table);
    }

    function removeRow(id){
        if(count>=0){
            var elem = document.getElementById("row"+id);
            elem.parentNode.removeChild(elem);
        }
    }
</script>