<?php
class ConexionBD
{
    private $bd;

    public function __construct()
    {
        try {
            $this->bd = new PDO("mysql:host=localhost;dbname=reservas", "root", "");
            $this->bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->bd->exec("set names utf8");
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    public function getConexion()
    {
        return $this->bd;
    }
}



