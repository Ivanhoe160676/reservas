<?php
header('Content-Type: application/json');

// Realiza la lógica de obtención de reservas desde la base de datos
$conexion = new mysqli("localhost", "root", "", "restaurante");
if ($conexion->connect_error) {
    die(json_encode(array('error' => 'Conexión fallida: ' . $conexion->connect_error)));
}

$resultado = $conexion->query("SELECT * FROM reservas");
$reservas = array();

while ($fila = $resultado->fetch_assoc()) {
    $reservas[] = array(
        'title' => 'Reserva',
        'start' => $fila['fecha'] . ' ' . $fila['hora'],
        'end' => $fila['fecha'] . ' ' . $fila['hora']
    );
}

echo json_encode($reservas);
$conexion->close();
?>
