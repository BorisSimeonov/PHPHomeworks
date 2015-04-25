<form method="get">
    <p>Enter tags:</p>
    <input name="inLine" type="text"/>
    <input name="submitBtn" type="submit" value="Submit"/>
</form>
<?php
    if(isset($_GET['submitBtn']) &&
        strlen($_GET['inLine'])>0){
        $inLineValue = $_GET['inLine'];
        $arr = explode(', ', $inLineValue);
        $counter = 0;
        foreach($arr as $key){
            echo "$counter : $key<br>";
            $counter++;
        }
    }
?>