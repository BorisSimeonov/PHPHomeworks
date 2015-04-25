<form method="get">
    <p>Enter tags:</p>
    <input name="inLine" type="text"/>
    <input name="submitBtn" type="submit" value="Submit"/>
</form>
<?php
    if(isset($_GET['submitBtn']) && strlen(htmlentities($_GET['inLine']))>0){
       $arr = explode(', ', htmlentities($_GET['inLine']));
        $newArr = array_count_values($arr);
        array_multisort($newArr,SORT_DESC,SORT_NUMERIC);
        while($element = current($newArr)) {
            echo key($newArr)." : ".current($newArr).'<br>';
            next($newArr);
        }
    }
?>