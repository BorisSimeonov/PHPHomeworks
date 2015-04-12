<?php
$form = "<section>".
    "<form action='form-data.php' method='post'>".
"<input type='text' name='name' placeholder='name'><br>".
"<input type='text' name='age' placeholder='Age'><br>".
"<input type='radio' name='radioGr' value='Male' checked/>Male<br />".
"<input type='radio' name='radioGr' value='Female' />Female<br />".
"<button type='submit'>Submit</button></form></section>";
echo $form;
$result = "";

if(isset($_POST['name']) && isset($_POST['age'])){
    if($_POST['name']!="" && $_POST['age']!=""){
    $result = "My name is ".$_POST['name'].". I am ".$_POST['age']." years old. I am ".$_POST['radioGr'].".";
    echo $result;
    }
}
?>
