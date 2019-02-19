<?php

/*Valores dos coeficientes da equação
*Obs.: Considere que já foram previamente calculados
* Fórmula: ax² + bx + c = 0
* Aplicada no exemplo: 1x² +(-2x) + (-3) = 0
*/

$a = 1;
$b = -2;
$c = -3;

function secondDegreeEquation($a, $b, $c){
    //Equação para encontrar o valor de Delta
    $delta = ($b*$b)-((4*$a)*$c);

    //Equação para encontrar os valores dos coeficientes armazenados em $x1 e $x2 respectivamente
    $x1 = (-$b + sqrt($delta))/(2*$a);
    $x2 = (-$b - sqrt($delta))/(2*$a);
    return [
        "coeficiente_x1" => $x1, 
        "coeficiente_x2" => $x2
    ];
}

$resultado = secondDegreeEquation($a, $b, $c);

echo '<pre>';
var_dump($resultado);
echo '</pre>';
