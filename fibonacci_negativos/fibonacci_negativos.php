<?php

if (PHP_SAPI != 'cli')
    exit(500);

if ($argc != 2) {
    echo "Solo se debe ingresar el nombre del script y la cantidad de números a obtener" . PHP_EOL;
    exit(404);
}

if (!is_numeric($argv[1])) {
    echo "La cantidad debe ser un número" . PHP_EOL;
    exit(404);
}


function fibonacciNegativos(int $cantidad) {
    $resultado = [0];
    
    $total_absoluto = abs($cantidad);
    
    for ($i = 1; $i < $total_absoluto; $i++) {
        if ($i == 1) {
            $resultado[-$i] = '1';
            $resultado[$i] = '1';
            continue;
        }
        $resultado[$i] = $resultado[$i-1] + $resultado[$i-2];
        $resultado[-$i] = ((-1)**($i+1)) * $resultado[$i];
    }
    
    ksort($resultado);
    return $resultado;
}


print_r(fibonacciNegativos($argv[1]));