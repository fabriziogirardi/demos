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

print_r(fibonacci($argv[1]));