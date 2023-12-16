<?php
// guardar_evento.php
require_once "../modelos/database.php";

$conexionBD = new ConexionBD();
$bd = $conexionBD->getConexion();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombreCliente = $_POST['nombreCliente'];
    $telfCliente = $_POST['telfCliente'];
    $asistentes = $_POST['asistentes'];
    $tipo = $_POST['tipo'];
    $fechaReserva = $_POST['fechaReserva'];
    $tituloEvento = $_POST['tituloEvento'];

    try {
        $stmt = $bd->prepare("INSERT INTO reservas (nombreCliente, telfCliente, asistentes, tipo, fechaReserva, tituloEvento) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bindParam(1, $nombreCliente);
        $stmt->bindParam(2, $telfCliente);
        $stmt->bindParam(3, $asistentes);
        $stmt->bindParam(4, $tipo);
        $stmt->bindParam(5, $fechaReserva);
        $stmt->bindParam(6, $tituloEvento);
        $stmt->execute();

        $response = [
            'success' => true,
            'message' => 'Evento guardado exitosamente en la base de datos.'
        ];
        echo json_encode($response);
    } catch (PDOException $e) {
        $response = [
            'success' => false,
            'message' => 'Error al guardar el evento en la base de datos: ' . $e->getMessage()
        ];
        echo json_encode($response);
    }
} else {
    $response = [
        'success' => false,
        'message' => 'Solicitud no válida.'
    ];
    echo json_encode($response);
}
?>
