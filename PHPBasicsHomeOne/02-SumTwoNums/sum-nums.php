<?php
      $numOne = 1.567808;
      $numTwo = 0.356;
//    $numOne = 1;
//    $numTwo = 2;
    $result = number_format((float)($numOne + $numTwo), 2, '.', '');
    echo "\$firstNumber + \$secondNumber = $numOne + $numTwo = $result";
?>