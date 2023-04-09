<?php
for ($i=1000; $i <= 60000; $i = $i+50) { 
    $quotient = (($i - ($i % 1000)) / 1000);

    if($quotient >= 10){
        $quotient = (($quotient - ($quotient % 10)) / 10);
        $quotient *= 10;
    }
    $exp = 1000  * $quotient; 
    $price = $i;
    $supply = floor(($price/11) * 10);
    $vat = $price - $supply;
    $fee = $price * 0.0363;
    $profit = $supply - $exp - $fee;
    $avg = (int)$price/$quotient;

    if($supply >= $exp ){
        echo "---------------------------|".PHP_EOL;
        echo "| EXP: ".$exp."            |".PHP_EOL;
        echo "| 가격: ".$price."         |".PHP_EOL;
        echo "| 공급가: ".$supply."      |".PHP_EOL;
        echo "| 부가세: ".$vat."         |".PHP_EOL;
        echo "| 수수료: ".$fee."         |".PHP_EOL;
        echo "| 수수료/4: ".($fee/4)."         |".PHP_EOL;
        echo "| 수익: ".$profit."        |".PHP_EOL;
        echo "| 1000EXP/1000원: ".$avg."        |".PHP_EOL;
        echo "---------------------------|".PHP_EOL;
        echo "<br>".PHP_EOL;
    }
    
}
?>