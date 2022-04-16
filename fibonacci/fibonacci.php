<?php

if (PHP_SAPI != 'cli')
    exit(500);

function fibonacci(int $cuantos)
{
    if ($cuantos < 0) {
        echo "La cantidad debe ser mayor a cero" . PHP_EOL;
        exit(404);
    }
    
    $resultado = [0];
    
    for ($i = 1; $i < $cuantos; $i++) {
        if ($i == 1) {
            $resultado[] = '1';
            continue;
        }
        $resultado[] = $resultado[$i-1] + $resultado[$i-2];
    }
    
    return $resultado;
}

if ($argc != 2) {
    if ($argc > 2) {
        echo "Solo un parámetro está permitido" . PHP_EOL;
    } else {
        echo "Falta el parámetro indicando la cantidad de números a calcular" . PHP_EOL;
    }
    exit(404);
}
if (!is_numeric($argv[1])) {
    echo "El segundo parámetro debe ser un número" . PHP_EOL;
    exit(404);
}
print_r(fibonacci($argv[1]));