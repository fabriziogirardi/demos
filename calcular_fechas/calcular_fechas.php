<?php

/**
 * calcularFechas
 * @param array $args
 * @return array|void
 */
function calcularFechas(array $args)
{
    if (count($args) < 4) {
        echo "El script no fue llamado correctamente." . PHP_EOL;
        echo "Por favor introduzca 2 fechas con el formato dia/mes/año en números." . PHP_EOL;
        echo "Por ejemplo 02/04/1988 para referirse al 2 de abril de 1988" . PHP_EOL;
        echo "----" . PHP_EOL;
        echo "También debe poner que día de la semana desea obtener como tercer parámetro" . PHP_EOL;
        echo "Utilizando un número del 0 (domingo) al 6 (sábado)." . PHP_EOL;
        exit(404);
    }
    
    $fecha1 = DateTime::createFromFormat('d/m/Y', $args[1]);
    $fecha2 = DateTime::createFromFormat('d/m/Y', $args[2]);
    
    if (!$fecha1 || !$fecha2) {
        echo "La/s siguiente/s fechas no es/son válida/s" . PHP_EOL;
        if (!$fecha1)
            echo $args[1] . PHP_EOL;
        if (!$fecha2)
            echo $args[2] . PHP_EOL;
        exit(404);
    }
    
    if ($fecha1 >= $fecha2) {
        echo "La fecha 1 no puede ser mayor o igual a la fecha 2" . PHP_EOL;
        exit(404);
    }
    
    if (isset($args[3]) && (!is_numeric($args[3]) || $args[3] < 0 || $args[3] > 6)) {
        echo "El parámetro de día debe ser un número entre 0 y 6" . PHP_EOL;
        exit(404);
    }
    
    $diasValidos = [
        0 => 'sunday',
        1 => 'monday',
        2 => 'tuesday',
        3 => 'wednesday',
        4 => 'thursday',
        5 => 'friday',
        6 => 'saturday',
        7 => 'sunday'
    ];
    
    $diasCalculados = [];
    
    $fecha1->modify($diasValidos[$args[3]]);
    $diasCalculados[] = $fecha1->format('d/m/Y');
    
    while ($fecha1 < $fecha2) {
        $fecha1->modify('+1 week');
        $diasCalculados[] = $fecha1->format('d/m/Y');
    }
    
    return $diasCalculados;
}

print_r(calcularFechas($argv));