<!DOCTYPE html>
<html>
<?php session_start(); ?>
<head lang="en">
    <meta charset="UTF-8">
    <title>HTML5 Tags Counter</title>
</head>
<body>
<form method="get">
    <p>Enter HTML tags </p>
    <input name="tagInput" type="text" required="required"/>
    <input type="submit" name="submit"/>
</form>
</body>
</html>

<?php
//just some of the HTML tags
$htmlFiveTags = array('body', 'head', 'span', 'menu', 'meta', '!DOCTYPE', 'a', 'br', 'button', 'col', 'table',
'td', 'tr', 'th', 'legend', 'div', 'colgroup', 'em', 'b', 'i', 'form', 'legend', 'textarea', 'title', 'meta',
'ul', 'ol', 'li', 'html', 'iframe', 'img', 'input', 'thead', 'tfoot', 'sub', 'style');

if (!isset($_SESSION['tags'])) {
    $_SESSION['tags'] = array();
}
if (!isset($_SESSION['counter'])) {
    $_SESSION['counter'] = 0;
}
if (!isset($_SESSION['highScore'])) {
    $_SESSION['highScore'] = 0;
}


if((isset ($_GET['submit'])) && $_GET['submit'] !== ""){
    $string = $_GET['tagInput'];
    if(in_array($string, $htmlFiveTags)){
        if(!(in_array($string, $_SESSION['tags']))){
            $_SESSION['tags'][$_SESSION['counter']] = $string;
            $_SESSION['counter'] = (int)$_SESSION['counter'] + 1;
        }
        echo "<h1>Valid HTML Tag!</h1><h2>Score ".$_SESSION['counter']."</h2><p>Highscore: ".$_SESSION['highScore']."</p>";
    }else{
        $_SESSION['highScore'] = max($_SESSION['highScore'], $_SESSION['counter']);
        $_SESSION['counter'] = 0;
        $_SESSION['tags'] = array();
        echo "<h1>Invalid HTML Tag!</h1><h2>Score ".$_SESSION['counter']."</h2><p>Highscore: ".$_SESSION['highScore']."</p>";
    }
}
?>