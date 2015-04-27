<?php
echo "<form method='post'><textarea name='inField'></textarea></textarea><br/><input class='subInp' type='submit' name='submit' value='Build The Table'/></form>";
echo "<style>table{background-color: white;} body{background-color: #abad5d;} " .
    ".firstRow{background-color: #172a58; color: white;} td{padding: 4px 20px;} ".
    ".grey>td{background-color: #b5b5b5;}.white{background-color: white;}".
    "button{color:white; border-color: 1px solid #172a58; background-color: orange;".
    " padding: 4px 10px; font-weight: bold;} a{color: black;} textarea{min-width: 700px; min-height: 150px;}".
    ".subInp{ margin-top: 5px;background-color: #172a58; border: 1px solid white; color: white; font-weight: bold; padding: 5px 30px;}</style>";

if(isset($_POST['submit'])){
    $bufferText = htmlentities($_POST['inField']);
    $seminarRawArray = [];
    preg_match_all('/[A-Z0-9](.*)+\.{3}/', $bufferText, $seminarRawArray);
    $seminarRawArray = $seminarRawArray[0];
    $resultString = "<table><tr class='firstRow'><td>Seminar Name</td><td>Date</td><td>Participate</td></tr>";
    $colCounter = 0;
    foreach($seminarRawArray as $inLine){
        //get the lectors
        $lectorLine = "";
        preg_match_all('/\-{1}[a-zA-Z\s]{4,}\-{1}/', $inLine, $lectorLine);
        $lectorLine = $lectorLine[0][0];
        $lectorLine = preg_replace('/[^a-z\s]+/i', "", $lectorLine);
        //get the dates
        $dateLine = "";
        preg_match_all('/[0-9]{2}\-[0-9]{2}\-[0-9]{4}\s+[0-9]{2}\:[0-9]{2}/',$inLine, $dateLine);
        $dateLine = $dateLine[0][0];
        //get text and subject
        $textLine = preg_replace('/\-{1}[a-zA-Z\s]{4,}\-{1}[0-9]{2}\-[0-9]{2}\-[0-9]{4}\s+[0-9]{2}\:[0-9]{2}(.*?)/', '', $inLine);
        $subjectLine = [];
        $subjectLine = preg_replace('/(.*?)\-{1}(.*)+/', '$1', $inLine);
        //get color of the row
        $color = "";
        if($colCounter%2 === 0){
            $color = "class='grey'";
        }else{
            $color = "class='white'";
        }
        $colCounter++;
        //print the data
        $resultString.="<tr $color><td title='Lecturer: $lectorLine\nDetails: $textLine\n'>".
            "<a href='' onclick='return false'>$subjectLine</a></td><td>$dateLine</td><td>".
            "<button class='sign' onclick='return false'>SIGN UP</button></td></tr>";
    }
    $resultString.="</table>";
    echo $resultString;
}