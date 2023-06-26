<?php

function calcularResistencia($banda1, $banda2, $banda3, $banda4)
{
    $colores = array(
        'negro' => 0,
        'marron' => 1,
        'rojo' => 2,
        'naranja' => 3,
        'amarillo' => 4,
        'verde' => 5,
        'azul' => 6,
        'violeta' => 7,
        'gris' => 8,
        'blanco' => 9
    );

    $multiplicadores = array(
        'negro' => 1,
        'marron' => 10,
        'rojo' => 100,
        'naranja' => 1000,
        'amarillo' => 10000,
        'verde' => 100000,
        'azul' => 1000000,
        'violeta' => 10000000,
        'gris' => 100000000,
        'blanco' => 1000000000
    );

    $tolerancias = array(
        'marron' => 1,
        'rojo' => 2,
        'verde' => 0.5,
        'azul' => 0.25,
        'violeta' => 0.1,
        'gris' => 0.05,
        'oro' => 5,
        'plata' => 10
    );

    if (!isset($colores[$banda1]) || !isset($colores[$banda2]) || !isset($multiplicadores[$banda3]) || !isset($tolerancias[$banda4])) {
        return "Error: Bandas inválidas.";
    }

    $valor1 = $colores[$banda1];
    $valor2 = $colores[$banda2];
    $multiplicador = $multiplicadores[$banda3];
    $tolerancia = $tolerancias[$banda4];

    $valor = ($valor1 * 10 + $valor2) * $multiplicador;

    return array(
        'valor' => $valor,
        'tolerancia' => $tolerancia
    );
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $banda1 = $_POST['banda1'];
    $banda2 = $_POST['banda2'];
    $banda3 = $_POST['banda3'];
    $banda4 = $_POST['banda4'];

    $resistencia = calcularResistencia($banda1, $banda2, $banda3, $banda4);

    if (is_array($resistencia)) {
        echo '<div class="resultado">';
        echo 'El Valor de la resistencia es ' . $resistencia['valor'] . ' ohms<br>';
        echo 'La Tolerancia es: +/- ' . $resistencia['tolerancia'] . '%';
        echo '</div>';
    } else {
        echo '<div class="error">' . $resistencia . '</div>';
    }
}
?>
