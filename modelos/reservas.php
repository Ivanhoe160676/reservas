<?php

class Reservas
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function crearReserva($nombreCliente, $telfCliente, $asistentes, $tipo, $fechaReserva, $tituloEvento)
    {
        try {
            $stmt = $this->conexion->prepare("INSERT INTO reservas (nombreCliente, telfCliente, asistentes, tipo, fechaReserva, tituloEvento) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bindParam(1, $nombreCliente);
            $stmt->bindParam(2, $telfCliente);
            $stmt->bindParam(3, $asistentes);
            $stmt->bindParam(4, $tipo);
            $stmt->bindParam(5, $fechaReserva);
            $stmt->bindParam(6, $tituloEvento);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            throw new Exception("Error al crear reserva: " . $e->getMessage());
        }
    }

    public function obtenerReservas()
    {
        try {
            $stmt = $this->conexion->prepare("SELECT * FROM reservas");
            $stmt->execute();
            $reservas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $reservas;
        } catch (PDOException $e) {
            throw new Exception("Error al obtener reservas: " . $e->getMessage());
        }
    }
}

